<?php

namespace App\Http\Requests\Admin;

use App\Helpers\QuoteStage;
use App\Helpers\QuoteStatus;
use App\Models\QuoteItems;
use App\Models\Quote;
use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer'                          => ['required','integer','exists:users,id'],
            'reference'                             => ['nullable','string','max:255'],
            'title'                             => ['nullable','string','max:255'],
            'isOrder'                           => ['nullable'],
            'is_draft'                          => ['required'],
            'items'                             => ['nullable','array'],
            'items.*.product'                   => ['nullable'],
            'items.*.product_name'              => ['nullable'],
            'items.*.product_description'       => ['nullable'],
            'items.*.unit_price'                => ['nullable','numeric'],
            'items.*.qty'                       => ['nullable','integer'],
            'items.*.subtotal'                  => ['nullable','numeric'],
            'items.*.setup_price'               => ['nullable','numeric'],
            'items.*.discount'                  => ['nullable','numeric'],
            'items.*.vat'                       => ['nullable','in:yes,no'],
            'items.*.vat_percentage'            => ['nullable','numeric'],
            'items.*.total'                     => ['nullable','numeric'],
            'shipping'                          => ['nullable', 'numeric']
        ];
    }

    /**
     * Update or store current requested data
     *
     */
    public function saved(?Quote $quote = null) : object
    {
        $total_discount = 0;
        $is_draft = $this->is_draft == 'true';

        $data = [
            'user_id'     => $this->customer,
            'admin_id'    => auth()->id(),
            'referance'   => $this->reference,
            'order_title' => $this->title,
            'draft'       => $is_draft
        ];
        if($this->isMethod('POST')) {
            $quote = Quote::query()->create($data);
        }
        else {
            $quote->update($data);
        }

        if($this->isOrder != null){
            $quote->status = QuoteStatus::APPROVED;
            $quote->stage  = QuoteStage::ORDER;
        }

        foreach ($this->items as $item) {
            if(isset($item['product']) && $item['product'] != null){
                $quoteItem = QuoteItems::find(isset($item['id']) ? $item['id'] : 0);

                $setup_price = $item['setup_price'] ?? 0;
                $subtotal   = $item['unit_price'] * $item['qty'] + $setup_price;
                $discount   = $subtotal * ($item['discount'] / 100);
                $vat_amount = $item['vat'] == 'yes' ? ($subtotal * ($item['vat_percentage'] / 100)) : 0;
                $total      = ($subtotal - $discount) + $vat_amount;

                $input = [
                    'product_name'=> $item['product_name'] ?? null,
                    'product_description' => $item['product_description'] ?? null,
                    'product_id'  => !str_contains($item['product'], '__string') ? $item['product'] : null,
                    'unit_price'  => $item['unit_price'],
                    'setup_price' => $setup_price,
                    'quantity'    => $item['qty'],
                    'vat'         => $item['vat'],
                    'vat_percentage'  => $item['vat_percentage'],
                    'vat_amount'    => $vat_amount,
                    'discount'    => $item['discount'],
                    'discount_amount' => $discount,
                    'subtotal'    => $subtotal,
                    'total'       => $total
                ];

                $total_discount += $discount;

                $quoteItem ? $quoteItem->update($input) : $quote->items()->updateOrCreate($input);
            }
        }

        $quote->total_discount = $total_discount;
        $quote->save();

        $quote->shipping_amount = $this->shipping;
        $quote->save();

        if($this->isMethod('POST')) {
            $quote->update(['invoice' => generate_invoice($quote->id)]);
        }
        return $quote;
    }
}
