<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\QuoteStage;
use App\Http\Controllers\Controller;
use App\Mail\SendInvoiceMail;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $this->authorize('show_quote');
        if(request()->ajax()) {
            $proofs = Quote::query()->with('user:id,name,company_name');
            return $this->datatableInitilize($proofs)->filter(function($q) use($request) {
                if($request->status != ""){
                    $q->stage(QuoteStage::ORDER)->where('invoice_status', $request->status);
                }
                else{
                    $q->stage(QuoteStage::ORDER);
                }

                if($request->vat_status != ""){
                    $q->stage(QuoteStage::ORDER)->where('vat_status', $request->vat_status);
                }
                else{
                    $q->stage(QuoteStage::ORDER);
                }
            }, true)->editColumn('created_at', fn($data) => $data->created_at->format('d-m-Y H:i A'))->toJson();
        }
        return view('admin.invoice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $invoice
     * @return \Illuminate\Contracts\View\View
     */
    public function show($invoice)
    {
        $quote = Quote::where('id', $invoice)->first();
        $this->authorize('show_quote');
        return view('admin.invoice.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $invoice
     */
    public function edit(Quote $invoice)
    {
        $this->authorize('edit_invoice');
        return view('admin.invoice.form', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $invoice
     */
    public function update(Request $request, Quote $invoice)
    {
        $this->authorize('edit_invoice');

        $invoice->update(['account_type' => $request->account_type]);

        $quote = $invoice;

        $pdf = PDF::loadView('mail.invoice-download', compact('quote'));
        Storage::put('/pdf/invoice.pdf', $pdf->output());

        Mail::to($invoice->user?->email)->send(new SendInvoiceMail($invoice));

        return response()->json(['message' => 'Invoice send successfully']);
    }

    public function showChangeInvoiceStatusForm($invoice){

        $selected_invoice = Quote::where('invoice', $invoice)->first();
        $total_amount = 0;
        foreach($selected_invoice->items as $item){
            $total_amount = $item->total + $total_amount;
        }
        if($selected_invoice->invoice_status == 'partially paid'){
            $total_amount = $total_amount - $selected_invoice->paid_amount;
        }
        return view('admin.invoice.changeInvoiceStatus', compact('invoice', 'total_amount'));
    }

    public function updateInvoiceStatus(Request $request, $invoice){
        $invoice = Quote::where('invoice', $invoice)->first();
P
        if($request->invoice_status == 'Paid'){
            $total_amount = 0;
            $invoice->invoice_status = 'paid';
            foreach($invoice->items as $item){
                $total_amount = $total_amount + $item->total;
            }
            $invoice->paid_amount = $total_amount;
            $invoice->save();
        }
        elseif($request->invoice_status == 'Partially Paid'){
            $invoice->invoice_status = 'partially paid';
            $invoice->paid_amount = $request->paid_amount;
            $invoice->save();
        }

        return response()->json(['message' => 'Invoice status updated']);
    }

    public function downloadInvoice($id){
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        if($route == 'admin.invoice.index'){
            $quote = Quote::query()->with('items')->where('id', $id)->first();
            $pdf = PDF::loadView('mail.invoice-download', compact('quote'));
            return $pdf->download('Invoice-'.$quote->invoice.'.pdf');
        }
        else{
            $quote = Quote::query()->with('items')->where('id', decrypt($id))->first();
            $pdf = PDF::loadView('mail.invoice-download', compact('quote'));
            return $pdf->download('Invoice-'.$quote->invoice.'.pdf');
        }
    }

    public function filterStatus($status){
        $invoices = Quote::query()->where('invoice_status', $status)->with('user:id,name,company_name');
        return $this->datatableInitilize($invoices)->filter(fn($q) => $q->stage(QuoteStage::ORDER), true)->editColumn('created_at', fn($data) => $data->created_at->format('d-m-Y H:i A'))->toJson();
    }

    public function showChangeVatStatusForm($invoice){
        $selected_invoice = Quote::where('invoice', $invoice)->first();

        return view('admin.invoice.changeVatStatus', compact('invoice', 'selected_invoice'));
    }

    public function updateVatStatus(Request $request, $invoice){

        $invoice = Quote::where('invoice', $invoice)->first();
        $invoice->vat_status = strtolower($request->VAT_status);
        $invoice->save();

        return response()->json(['message' => 'Invoice VAT status updated']);
    }
}
