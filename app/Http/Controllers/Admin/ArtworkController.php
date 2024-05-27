<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\QuoteStage;
use App\Helpers\QuoteStatus;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use App\Mail\ArtworkSentMail;
use Illuminate\Support\Facades\Mail;

class ArtworkController extends Controller
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
            $quotes = Quote::query()->where('stage', QuoteStage::ORDER)->with('user:id,name,company_name')->withSum('items', 'subtotal')->withSum('items', 'total');
            return $this->datatableInitilize($quotes)
                        // ->filter(fn($q) => $q->stage(QuoteStage::QUOTE)->status(QuoteStatus::PENDING), true)
                        ->editColumn('invoice', function ($data){
                            if($data->seen) {
                                return $data->invoice;
                            }
                            else {
                                return '<strong>'.$data->invoice.'</strong>';
                            }
                        })
                        ->editColumn('created_at', function($data){
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
                        ->rawColumns(['invoice', 'created_at', 'user.company_name'])
                        ->toJson();
        }
        return view('admin.artwork.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $artwork
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Quote $artwork)
    {
        $this->authorize('show_artwork');
        return view('admin.artwork.show', compact('artwork'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $artwork
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Quote $artwork)
    {
        $this->authorize('edit_artwork');
        $status = [QuoteStatus::PENDING,QuoteStatus::APPROVED,QuoteStatus::PROCESSING,QuoteStatus::OUTOFDELIVERY,QuoteStatus::FULFILLED,QuoteStatus::REJECT];
        return view('admin.artwork.form', compact('artwork','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $artwork
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Quote $artwork)
    {
        $this->authorize('edit_artwork');

        $request->validate([
            'artwork' => ['nullable','file','mimes:pdf,docx,zip,png,jpg','max:10240']
        ]);



        $given_artwork = $request->hasFile('artwork') ? fileUpload($request->file('artwork'), 'quote', $artwork->artwork) : $artwork->artwork;
        // $stage = in_array($request->status, [QuoteStatus::PENDING, QuoteStatus::REJECT]) ? QuoteStage::ORDER : QuoteStage::PROOF;


        $artwork->update([
            'artwork' => $given_artwork,
            'seen'          => true
        ]);

        Mail::to($artwork->user?->email)->send(new ArtworkSentMail($artwork));

        return response()->json(['message' => 'Submitted successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
