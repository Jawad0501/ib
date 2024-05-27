<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\QuoteStage;
use App\Helpers\QuoteStatus;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovalProofStatusMail;

class ApprovalProofController extends Controller
{
    public $order;
    public function __construct()
    {
        $this->order = Quote::query();
    }

    /**
     * Show check page
     *
     * @param  string $invoice
     */
    public function index($invoice)
    {
        try {
            $order = $this->order->where('invoice', decrypt($invoice))->firstOrFail();
            return view('frontend.approval', compact('order'));
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
            'approval_status' => ['required','string','in:'.QuoteStatus::APPROVED.','.QuoteStatus::REJECT],
            'po'              => [$request->approval_status == 'approved'? 'required' : ''],
            'reject_reason'   => ['nullable','required_if:status,reject','string']
        ]);

        // $order = $this->order->where('invoice', decrypt($invoice))->status(QuoteStatus::PROCESSING)->stage(QuoteStage::ORDER)->firstOrFail();
        $order = $this->order->where('invoice', decrypt($invoice))->firstOrFail();

        if($order) {
            $order->status = $request->approval_status;
            if ($request->approval_status !== QuoteStatus::REJECT) {
                $order->order_number = $request->po;
                $order->stage  = QuoteStage::ORDER;
            }
            $order->reject_reason = $request->reject_reason;
            $order->save();
        }


        Mail::to(config('mail.from.address'))->send(new ApprovalProofStatusMail($order, $request->approval_status, $request->reject_reason));


        session()->flash('message', 'Approval proof status submitted successfully.');

        return back();
    }
}
