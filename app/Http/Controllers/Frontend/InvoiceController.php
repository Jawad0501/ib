<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\QuoteStage;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\AskInvoiceMail;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendInvoiceMail;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $quotes = Quote::query()->withSum('items', 'total')->where('user_id', auth()->id())->stage(QuoteStage::ORDER)->paginate(10);

        return view('frontend.invoice.index', compact('quotes'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $quote = Quote::query()->where('id', decrypt($id))->where('user_id', auth()->id())->stage(QuoteStage::ORDER)->firstOrFail();
        return view('frontend.quotes.show', compact('quote'));
    }

    /**
     * edit
     */
    public function edit($id){
        $quote = Quote::query()->with('items')->where('id', decrypt($id))->where('user_id', auth()->id())->stage(QuoteStage::ORDER)->firstOrFail();
        return view('mail.invoice-new', compact('quote'));
    }

    public function downloadInvoice($id){
        $quote = Quote::query()->with('items')->where('id', decrypt($id))->first();
        $pdf = PDF::loadView('mail.invoice-download', compact('quote'));
        return $pdf->download('Invoice-'.$quote->invoice.'.pdf');
    }

    public function askForInvoiceMail(Request $request){
        $quote = Quote::query()->where('id', $request->quote['id'])->firstOrFail();
        Mail::to(config('mail.from.address'))->send(new AskInvoiceMail($quote));
        return response()->json(['message' => 'Invoice Request Sent']);
    }

    public function sendInvoice($invoice){
        $quote = Quote::query()->where('invoice', decrypt($invoice))->firstOrFail();

        $pdf = PDF::loadView('mail.invoice-download', compact('quote'));
        Storage::put('/pdf/invoice.pdf', $pdf->output());

        Mail::to($quote->user?->email)->send(new SendInvoiceMail($quote));

        return redirect()->back();
    }
}

