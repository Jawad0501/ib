<?php

namespace App\Http\Responses;

use App\Models\Quote;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use stdClass;

class QuotesResponse implements Responsable
{

    public function __construct(private ?Quote $quote = null){}

    /**
     * toResponse
     *
     * @param  mixed $request
     * @return \Illuminate\Contracts\View\View
     */
    public function toResponse($request)
    {
        $data = new stdClass;
        $data->customers = DB::table('users')->latest()->get(['id','name', 'company_name']);
        $data->products  = DB::table('products')->latest()->get(['id','name','unit_price','setup_price','vat','vat_percentage']);
        $data->customProducts  = DB::table('quote_items')->whereNotNull('product_name')->distinct('product_name')->get(['product_name','product_description','unit_price','setup_price']);
        return view('admin.quotes.form', [
            'data'   => $data,
            'quote' => $this->quote
        ]);
    }
}
