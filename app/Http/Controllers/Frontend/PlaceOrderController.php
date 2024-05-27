<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\QuoteStage;
use App\Helpers\QuoteStatus;
use App\Http\Controllers\Controller;
use App\Mail\ArtworkSubmitMail;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PlaceOrderController extends Controller
{
    public $quote;
    public function __construct()
    {
        $this->quote = Quote::query();
    }

    /**
     * Show check page
     *
     * @param  string $invoice
     */
    public function index($invoice, $active)
    {
        try {
            $quote = $this->quote->where('invoice', decrypt($invoice))->firstOrFail();
            return view('frontend.placeorder', compact('quote', 'active'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * store
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $invoice
     */
    public function store(Request $request, $invoice)
    {

        $request->validate([
            'artwork'   => ['nullable','file','mimes:pdf,docx,zip,csv,png,jpg','max:10240'],
            'referance' => ['nullable','string','max:255'],
        ], [
            'artwork.max' => 'The artwork must not be greater than 10mb'
        ]);


        $quote = Quote::where('invoice', decrypt($invoice))->first();
        if($request->has('referance')){
            $quote->update([
                'referance' => $request->referance,
            ]);
        }

        if($request->hasFile('artwork')){
            $quote->update([
                'artwork'   => fileUpload($request->file('artwork'), 'quote')
            ]);
        }

        // $quote->update([
        //     'referance' => $request->referance,
        //     'artwork'   => $request->hasFile('artwork') ? fileUpload($request->file('artwork'), 'quote') : null
        // ]);

        Mail::to(config('mail.from.address'))->send(new ArtworkSubmitMail($quote));

        session()->flash('message', 'Artwork submitted successfully, Thank you.');
        return redirect()->back();
    }
}
