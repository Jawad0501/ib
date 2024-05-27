<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteItems;
use Illuminate\Support\Facades\DB;

class QuoteItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = DB::table('products')->latest()->get(['id', 'name']);
        $customProducts  = DB::table('quote_items')->whereNotNull('product_name')->distinct('product_name')->get(['product_name','product_description','unit_price','setup_price']);
        return view('admin.quotes.item', compact('products', 'customProducts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuoteItems  $quoteItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(QuoteItems $quoteItem)
    {
        $quoteItem->delete();
        return response()->json(['message' => translate('deleted_message', ['text' => 'Item'])]);
    }
}
