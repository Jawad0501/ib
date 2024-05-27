<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\QuoteStage;
use App\Helpers\QuoteStatus;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use stdClass;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        //change: latest('id')
        $orders = Quote::query()->with('items')->where('user_id', auth()->id())->stage(QuoteStage::ORDER)->paginate();

        // $data = new stdClass;
        // $statuses = [QuoteStatus::PENDING,QuoteStatus::APPROVED,QuoteStatus::PROCESSING,QuoteStatus::OUTOFDELIVERY,QuoteStatus::FULFILLED,QuoteStatus::REJECT,'all'];

        // $status = [];
        // foreach ($statuses as $value) {
        //     $status[$value] = Quote::query()->where('user_id', auth()->id())->when($value != 'all', fn($q) => $q->status($value))->stage(QuoteStage::ORDER)->count();
        // }
        return view('frontend.order.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $quote = Quote::query()->with('items')->where('id', decrypt($id))->where('user_id', auth()->id())->stage(QuoteStage::ORDER)->firstOrFail();
        return view('frontend.order.show-order', compact('quote'));
    }
}
