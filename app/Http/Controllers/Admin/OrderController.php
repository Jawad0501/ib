<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\QuoteStage;
use App\Helpers\QuoteStatus;
use App\Http\Controllers\Controller;
use App\Mail\OrderApprovedMail;
use App\Mail\OrderProcessingMail;
use App\Mail\OrderProcessingMailWithoutProof;
use App\Mail\OrderDeliveryMail;
use App\Mail\OrderCompletedMail;
use App\Mail\OrderRejectMail;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->authorize('show_order');
        if(request()->ajax()) {
            $proofs = Quote::query()->where('stage', QuoteStage::ORDER)->with('user:id,name,company_name')->withSum('items', 'subtotal')->withSum('items', 'total');
            return $this->datatableInitilize($proofs)
            ->editColumn('invoice', function ($data){
                if($data->seen) {
                    return $data->invoice;
                }
                else {
                    return '<strong>'.$data->invoice.'</strong>';
                }
            })
            ->editColumn('created_at', function ($data){
                if($data->seen) {
                    return $data->created_at->format('d-m-Y H:i A');
                }
                else {
                    return '<strong>'.$data->created_at->format('d-m-Y H:i A').'</strong>';
                }
            })
            ->editColumn('user.company_name', function ($data){
                if($data->seen) {
                    return $data->user?->company_name;
                }
                else {
                    return '<strong>'.$data->user?->company_name.'</strong>';
                }
            })
            ->rawColumns(['created_at', 'invoice', 'user.company_name'])
            ->toJson();
        }
        return view('admin.order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $order
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Quote $order)
    {
        $this->authorize('show_order');

        if($order->seen != true){
            $order->seen = true;
            $order->update();
        }

        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $order
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Quote $order)
    {
        $this->authorize('edit_order');
        $status = [QuoteStatus::APPROVED,QuoteStatus::PROCESSING,QuoteStatus::OUTOFDELIVERY,QuoteStatus::FULFILLED,QuoteStatus::REJECT];
        return view('admin.order.form', compact('order', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Quote $order)
    {
        $this->authorize('edit_order');
        $request->validate([
            'status' => ['required','string'],
            'po' => [$request->status=='approved'? 'required' : ''],
        ]);
        $order->update(['status' => $request->status]);

        if($request->status == 'approved'){
            $order->order_number = $request->po;
            $order->save();
            Mail::to($order->user?->email)->send(new OrderApprovedMail($order));
        }
        elseif($request->status == 'processing'){
            if($order->approval_file != null){
                Mail::to($order->user?->email)->send(new OrderProcessingMail($order));
            }
            else{
                Mail::to($order->user?->email)->send(new OrderProcessingMailWithoutProof($order));
            }

        }
        elseif($request->status == 'out of delivery'){
            Mail::to($order->user?->email)->send(new OrderDeliveryMail($order));
        }
        elseif($request->status == 'fulfilled'){
            Mail::to($order->user?->email)->send(new OrderCompletedMail($order));
        }
        elseif($request->status == 'reject'){
            Mail::to($order->user?->email)->send(new OrderRejectMail($order));
        }


        return response()->json(['message' => 'Progress status updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Quote $order)
    {
        $this->authorize('delete_order');
        $order->delete();
        return response()->json(['message' => translate('deleted_message', ['text' => 'Order'])]);
    }
}
