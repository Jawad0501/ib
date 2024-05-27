<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    /**
     * process
     *
     * @param  mixed $amount
     * @return string
     */
    public function process($amount)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => strtolower(getSetting('currency_text')),
                        'unit_amount' => round($amount, 2) * 100,
                        'product_data' => [
                            'name' => config('app.name'),
                            'description' => 'Payment  with Stripe',
                            // 'images' => [uploadedFile('assets/images/logoIcon/logo.png')],
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'cancel_url' => route('payment.callback', 'cancel'),
                'success_url' => route('payment.callback', 'success'),
            ]);
        } catch (\Exception $e) {
            $send['error'] = true;
            $send['message'] = $e->getMessage();
            return json_encode($send);
        }

        $send['session'] = $session;

        return json_encode($send);
    }


    /**
     * Payment callback
     *
     */
    public function callback($status)
    {
        if (!session()->has('track')) {
            return redirect()->to('/');
        }

        $payment = Payment::with('quote','quote.items','quote.items.product:id,name,sku_number')->where('trx', session()->get('track'))->first();

        $payment->status = $status;
        $payment->save();

        Mail::to(config('mail.from.address'))->send(new InvoiceMail($payment->quote));

        session()->forget('track');
        return view('frontend.payment_confirmation', compact('payment'));
    }
}
