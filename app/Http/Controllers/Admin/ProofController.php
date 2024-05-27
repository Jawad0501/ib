<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\QuoteStage;
use App\Helpers\QuoteStatus;
use App\Http\Controllers\Controller;
use App\Mail\ApprovalProofSentMail;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProofController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->authorize('show_artwork');
        if(request()->ajax()) {
            $quotes = Quote::query()->with('user:id,name,company_name')->withSum('items', 'subtotal')->withSum('items', 'total');
            return $this->datatableInitilize($quotes)
                        // ->filter(fn($q) => $q->stage(QuoteStage::QUOTE)->status(QuoteStatus::PENDING), true)
                        ->editColumn('created_at', function($data){
                            if($data->seen) {
                                return $data->created_at->format('d-m-Y H:i A');
                            }
                            else {
                                return '<strong>'.$data->created_at->format('d-m-Y H:i A').'</strong>';
                            }
                        })
                        ->rawColumns(['created_at'])
                        ->toJson();
        }
        return view('admin.proof.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $proof
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Quote $proof)
    {
        $this->authorize('show_artwork');
        return view('admin.proof.show', compact('proof'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $proof
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Quote $proof)
    {
        $this->authorize('edit_artwork');
        $status = [QuoteStatus::PENDING,QuoteStatus::APPROVED,QuoteStatus::PROCESSING,QuoteStatus::OUTOFDELIVERY,QuoteStatus::FULFILLED,QuoteStatus::REJECT];
        return view('admin.proof.form', compact('proof','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $proof
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Quote $proof)
    {
        $this->authorize('edit_artwork');

        $request->validate([
            'approval_file' => ['nullable','file','mimes:pdf,docx,zip,png,jpg','max:10240']
        ]);



        $approval_file = $request->hasFile('approval_file') ? fileUpload($request->file('approval_file'), 'quote', $proof->approval_file) : $proof->approval_file;
        // $stage = in_array($request->status, [QuoteStatus::PENDING, QuoteStatus::REJECT]) ? QuoteStage::ORDER : QuoteStage::PROOF;


        $proof->update([
            'approval_file' => $approval_file,
            'seen'          => true
        ]);

        Mail::to($proof->user?->email)->send(new ApprovalProofSentMail($proof));

        return response()->json(['message' => 'Submitted successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote  $proof
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Quote $proof)
    {
        $this->authorize('delete_artwork');
        $proof->delete();
        return response()->json(['message' => translate('deleted_message', ['text' => 'Proof'])]);
    }
}
