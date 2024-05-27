<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\QuoteStage;
use App\Helpers\QuoteStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuoteRequest;
use App\Http\Responses\QuotesResponse;
use App\Mail\OrderQuoteMail;
use App\Models\Quote;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Mail\OrderApprovalMail;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->authorize('show_quote');
        if(request()->ajax()) {
            $quotes = Quote::query()->where('draft', false)->with(['user:id,name,company_name', 'admin:id,name'])->withSum('items', 'subtotal')->withSum('items', 'total');
            return $this->datatableInitilize($quotes)->filter(fn($q) => $q->stage(), true)->editColumn('created_at', fn($data) => $data->created_at->format('d-m-Y H:i A'))->toJson();
        }
        return view('admin.quotes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \App\Http\Responses\QuotesResponse
     */
    public function create()
    {
        $this->authorize('create_quote');
        return new QuotesResponse();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\QuoteRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(QuoteRequest $request)
    {
        $this->authorize('create_quote');
        $quote = $request->saved();

        $pdf = PDF::loadView('mail.quotation', compact('quote'));
        Storage::put('/pdf/quote.pdf', $pdf->output());

        if($quote->draft == false){
            try {
                Mail::to($quote->user?->email)->send(new OrderQuoteMail($quote));
            } catch (\Exception $e) {
                //throw $e;
            }
            return response()->json(['message' => translate('added_message', ['text' => 'quotes'])]);
        }
        else{
            return response()->json(['message' => translate('added_message', ['text' => 'quotes'])]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Quote $quote)
    {
        $this->authorize('show_quote');
        return view('admin.quotes.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \App\Http\Responses\QuotesResponse
     */
    public function edit(Quote $quote)
    {
        $this->authorize('edit_quote');
        $quote->load('items','user:id');
        return new QuotesResponse($quote);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuoteRequest $request, Quote $quote)
    {
        if($request->from_edit_draft == 'false'){
            $this->authorize('edit_quote');
            $request->saved($quote);
            return response()->json(['message' => translate('updated_message', ['text' => 'Quotes'])]);
        }
        else{
            $this->authorize('edit_quote');
            $request->saved($quote);
            try {
                Mail::to($quote->user?->email)->send(new OrderQuoteMail($quote));
            } catch (\Exception $e) {
                //throw $e;
            }
            return response()->json(['message' => translate('updated_message', ['text' => 'Quotes'])]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        $this->authorize('delete_quote');
        $quote->delete();
        return response()->json(['message' => translate('deleted_message', ['text' => 'Quotes'])]);
    }

    /**
     * showDrafts
     */
    public function showDrafts()
    {
        $this->authorize('show_quote');
        if(request()->ajax()) {
            $quotes = Quote::query()->where('draft', true)->with(['user:id,name,company_name', 'admin:id,name'])->withSum('items', 'subtotal')->withSum('items', 'total');
            return $this->datatableInitilize($quotes)->filter(fn($q) => $q->stage(), true)->editColumn('created_at', fn($data) => $data->created_at->format('d-m-Y H:i A'))->toJson();
        }
        return view('admin.quotes.drafts');
    }

    /**
     * approveQuote
     */
    public function approveQuote($quote)
    {
        $quote = Quote::where('id', $quote)->first();
        return view('admin.quotes.approval-confirmation', compact('quote'));
    }

    /**
     * confirmApproval
     */
    public function confirmApproval(Request $request, $quote)
    {
        $quote = Quote::where('id', $quote)->first();
        $quote->status = QuoteStatus::APPROVED;
        $quote->stage = QuoteStage::ORDER;
        $quote->order_number = $request->po;
        $quote->update();

        try {
            Mail::to($quote->user?->email)->send(new OrderApprovalMail($quote, false));
        } catch (\Exception $e) {
            //throw $e;
        }
        return response()->json(['message' => 'Order Approved Succesfully']);
    }

    /**
     * downloadQuote
     */
    public function downloadQuote($quote)
    {
        $quote = Quote::query()->where('id', $quote)->with('items')->first();
        $pdf = PDF::loadView('mail.quotation', compact('quote'));
        return $pdf->download("quote-{$quote->invoice}.pdf");
    }
}
