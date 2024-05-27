<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->authorize('show_product');
        if(request()->ajax()) {
            return $this->datatableInitilize(Product::query()->select(['id','name','sku_number','ur_code','unit_price','setup_price','vat','vat_percentage']))->toJson();
        }
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->authorize('create_product');
        if(request()->has('product_get')) {
            return response()->json([
                'products' => DB::table('products')->latest('id')->get(['id','name','unit_price','setup_price','vat','vat_percentage'])
            ]);
        }
        return view('admin.product.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        if($request->save_product){
            $this->authorize('create_product');
            $request->saved();

            return response()->json([
                'save_product'  => true,
                'product_key'   => $request->product_key ?? null,
                'message'       => translate('added_message', ['text' => 'product'])
            ]);
        }
        else{
            return response()->json([
                'name'          => $request->name,
                'description'   => $request->description,
                'unit_price'    => $request->unit_price,
                'setup_price'   => $request->setup_price,
                'vat'           => $request->vat,
                'vat_percentage'    => $request->vat_percentage,
                'save_product'  => false,
                'product_key'   => $request->product_key ?? null,
                'message'       => translate('added_message', ['text' => 'product'])
            ]);;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        $this->authorize('edit_product');
        return view('admin.product.form', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('edit_product');
        $request->saved($product);

        return response()->json(['message' => translate('updated_message', ['text' => 'Product'])]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete_product');
        $product->delete();

        return response()->json(['message' => translate('deleted_message', ['text' => 'Product'])]);
    }
}
