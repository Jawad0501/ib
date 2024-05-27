<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Quote;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    /**
     * Show check page
     *
     * @param  string $invoice
     */
    public function index($invoice)
    {
        try {
            $quote = Quote::query()->with('items','items.product:id,name,sku_number')->withSum('items', 'total')->where('invoice', decrypt($invoice))->firstOrFail();
            return view('frontend.checkout', compact('quote'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * store
     *
     * @param  mixed $request
     */
    public function store(Request $request)
    {
        $quote = Quote::query()->withSum('items', 'total')->where('invoice', decrypt($request->invoice))->firstOrFail(['id']);
        $amount = $quote->items_sum_total;

        $new  = new PaymentController;
        $data = $new->process($amount);
        $data = json_decode($data);

        if (isset($data->error)) {
            return response()->json(['message' => $data->message], 300);
        }

        $payment = Payment::create([
            'quote_id'    => $quote->id,
            'user_id'     => $quote->user_id,
            'amount'      => $amount,
            'grand_total' => $amount,
            'trx'         => getTrx()
        ]);

        $payment->btc_wallet = $data->session->id;
        $payment->save();

        // if(request()->ajax(){

        // })
        session()->put('track', $payment->trx);
        return redirect()->to($data->session->url);

        // return response()->json(['redirect' => $data->session->url]);
    }
}
