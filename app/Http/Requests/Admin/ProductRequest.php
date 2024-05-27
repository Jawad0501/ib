<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'          => ['required','string','max:255',$this->isMethod('POST') ? 'unique:products,name' : 'unique:products,name,'.$this->route('product')->id],
            'description'   => ['nullable', 'string','max:255'],
            'sku_number'    => ['required','string','max:255',$this->isMethod('POST') ? 'unique:products,sku_number' : 'unique:products,sku_number,'.$this->route('product')->id],
            'ur_code'       => ['nullable','string','max:255'],
            'unit_price'    => ['required','numeric'],
            'setup_price'   => ['nullable','numeric'],
            'vat'           => ['required','in:yes,no'],
            'vat_percentage'    => ['nullable','integer'],
            'save_product'  => ['nullable'],
        ];
    }

    /**
     * Update or store current requested data
     *
     */
    public function saved(?Product $product = null) : bool
    {
        $input = $this->validated();

        $this->isMethod('POST') ? Product::create($input) : $product->update($input);

        return true;
    }
}
