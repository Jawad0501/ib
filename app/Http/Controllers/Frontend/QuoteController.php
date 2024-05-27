<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\QuoteStage;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;

class QuoteController extends Controller
{
    public $quote;

    public function __construct()
    {
        $this->quote = Quote::query();
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $quotes = $this->quote->withSum('items', 'total');

        if(!empty($request->start_date) && !empty($request->end_date)) {
            $quotes = $quotes->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        if(!empty($request->status)) {
            $quotes = $quotes->status($request->status);
        }

        $quotes = $quotes->where('user_id', auth()->id())->stage()->latest('id')->paginate(5);

        return view('frontend.quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $quote = $this->quote->with('items')->where('user_id', auth()->id())->where('id', decrypt(request()->get('id')))->firstOrFail();
        return view('frontend.quotes.order', compact('quote'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $quote = $this->quote->where('id', $request->id)->first();

        if($quote->items()->count()  == count($request->items)){

            $quote->update([
                'user_id'        => $quote->user_id,
                'admin_id'       => $quote->admin_id,
                'stage'          => QuoteStage::ORDER,
                'artwork'        => $quote->artwork,
                'approval_file'  => $quote->approval_file,
                'seen'           => false,
                'order_title'    => $quote->order_title,
                'created_at'     => date('Y-m-d H:i:s', strtotime(Carbon::now())),
                'updated_at'     => date('Y-m-d H:i:s', strtotime(Carbon::now())),
            ]);
        }
        else{

            $quote->update([
                'user_id'        => $quote->user_id,
                'admin_id'       => $quote->admin_id,
                'stage'          => QuoteStage::ORDER,
                'artwork'        => $quote->artwork,
                'approval_file'  => $quote->approval_file,
                'seen'           => false,
                'order_title'    => $quote->order_title,
                'created_at'     => date('Y-m-d H:i:s', strtotime(Carbon::now())),
                'updated_at'     => date('Y-m-d H:i:s', strtotime(Carbon::now())),
            ]);

            $amount = 0;

            $quote_items = $quote->items()->get();
            $quote_item_ids = [];


            foreach($quote_items as $item){
                array_push($quote_item_ids, $item->id);
            }

            foreach($request->items as $reqItem){
                if(in_array($reqItem, $quote_item_ids)){
                    array_splice($quote_item_ids, array_search($reqItem, $quote_item_ids ), 1);
                }
            }

            if(count($quote_item_ids) > 0){
                foreach($quote_item_ids as $id){
                    $item = $quote->items()->where('id', $id)->first();
                    $item->delete();
                }
            }

            // foreach ($request->items as $reqItem) {
            //     $item = $quote->items()->where('id', $reqItem)->first();
            //     if($item) {
            //         $subtotal  = ($item->unit_price + $item->setup_price) * $item->quantity;
            //         $vatAmount = $subtotal * ($item->vat_percentage/100);
            //         $amount += ($subtotal + $vatAmount);
            //         $item->update([
            //             'quote_id'  => $quote->id,
            //         ]);
            //     }
            // }
        }

        // $quotes = Quote::query()->create([
        //     'user_id'        => auth()->id(),
        //     'admin_id'       => $quote->admin_id,
        //     'stage'          => QuoteStage::ORDER,
        //     'artwork'        => $quote->artwork,
        //     'approval_file'  => $quote->approval_file,
        //     'seen'           => false,
        //     'order_title'    => $quote->order_title.' by '.auth()->user()->name
        // ]);

        // $amount = 0;



        // foreach ($request->items as $reqItem) {
        //     $item = $quote->items()->where('id', $reqItem)->first();
        //     if($item) {
        //         $subtotal  = ($item->unit_price + $item->setup_price) * $item->quantity;
        //         $vatAmount = $subtotal * ($item->vat_percentage/100);
        //         $amount += ($subtotal + $vatAmount);
        //         $quotes->items()->create([
        //             'product_id'  => $item->product_id,
        //             'unit_price'  => $item->unit_price,
        //             'setup_price' => $item->setup_price,
        //             'quantity'    => $item->quantity,
        //             'vat'         => $item->vat,
        //             'vat_percentage'  => $item->vat_percentage,
        //             'subtotal'    => $subtotal,
        //             'total'       => $subtotal + $vatAmount
        //         ]);
        //     }
        // }


        Mail::to(config('mail.from.address'))->send(new OrderPlacedMail($quote));
        return response()->json(['message' => 'Your order was succesfully placed', 'invoice_no' => $quote->invoice]);

        // $new  = new PaymentController;
        // $data = $new->process($amount);
        // $data = json_decode($data);

        // if (isset($data->error)) {
        //     return response()->json(['message' => $data->message], 300);
        // }

        // $payment = Payment::create([
        //     'quote_id'    => $quote->id,
        //     'user_id'     => $quote->user_id,
        //     'amount'      => $amount,
        //     'grand_total' => $amount,
        //     'trx'         => getTrx()
        // ]);

        // $payment->btc_wallet = $data->session->id;
        // $payment->save();



        // $quotes->update(['invoice' => generate_invoice($quotes->id)]);

        // session()->put('track', $payment->trx);

        // return response()->json(['redirect' => $data->session->url]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $quote = Quote::query()->with('items')->where('id', decrypt($id))->where('user_id', auth()->id())->stage()->firstOrFail();
        return view('frontend.quotes.show-quote', compact('quote'));
    }

    public function showOrder($id, $page, $type){
        if($type == 'quote'){
            $quote = Quote::query()->with('items')->where('id', decrypt($id))->where('user_id', auth()->id())->stage()->firstOrFail();
        }
        else{
            $quote = Quote::query()->with('items')->where('id', decrypt($id))->where('user_id', auth()->id())->stage(QuoteStage::ORDER)->firstOrFail();
        }
        $modal_page = $page;

        return view('frontend.quotes.order-quote', compact('quote', 'modal_page', 'type'));
    }

    public function downloadQuote($id, $type){
        if($type == 'quote'){
            $quote = Quote::query()->with('items')->where('id', decrypt($id))->where('user_id', auth()->id())->stage(QuoteStage::QUOTE)->firstOrFail();
        }
        else{
            $quote = Quote::query()->with('items')->where('id', decrypt($id))->where('user_id', auth()->id())->stage(QuoteStage::ORDER)->firstOrFail();
        }
        return view('mail.invoice', compact('quote'));


    }

    public function reorderQuote(Request $request){

        $quote = $this->quote->where('id', $request->id)->first();

        $quotes = Quote::query()->create([
            'user_id'        => $quote->user_id,
            'admin_id'       => $quote->admin_id,
            'stage'          => QuoteStage::ORDER,
            'artwork'        => $quote->artwork,
            'approval_file'  => $quote->approval_file,
            'seen'           => false,
            'order_title'    => $quote->order_title
        ]);

        if($quotes->id < 10){
            $invoice = 'IB0000'.$quotes->id;
        }
        elseif($quotes->id < 100){
            $invoice = 'IB000'.$quotes->id;
        }
        elseif($quotes->id < 1000){
            $invoice = 'IB00'.$quotes->id;
        }
        elseif($quotes->id < 10000){
            $invoice = 'IB0'.$quotes->id;
        }
        else{
            $invoice = 'IB'.$quotes->id;
        }

        $quotes->update([
            'invoice'        => $invoice,
        ]);

        $amount = 0;

        foreach ($request->items as $reqItem) {
            $item = $quote->items()->where('id', $reqItem)->first();
            if($item) {
                $subtotal  = ($item->unit_price + $item->setup_price) * $item->quantity;
                $vatAmount = $subtotal * ($item->vat_percentage/100);
                $amount += ($subtotal + $vatAmount);
                $quotes->items()->create([
                    'product_id'  => $item->product_id,
                    'unit_price'  => $item->unit_price,
                    'setup_price' => $item->setup_price,
                    'quantity'    => $item->quantity,
                    'vat'         => $item->vat,
                    'vat_percentage'  => $item->vat_percentage,
                    'subtotal'    => $subtotal,
                    'total'       => $subtotal + $vatAmount
                ]);
            }
        }

        return response()->json(['message' => 'Your order was succesfully placed', 'invoice_no' => $invoice]);

    }

    public function rough(){
        return view('rough');
    }

}
