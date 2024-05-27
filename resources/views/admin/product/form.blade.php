<x-admin.modal
    :title="isset($product) ? 'Update product' : 'Add New product'"
    action="{{ isset($product) ? route('admin.product.update', $product->id) : route('admin.product.store') }}"
    :button="isset($product) ? 'Update' : 'Submit'"
    size="lg"
>
    @isset($product)
        @method('PUT')
    @endisset
    @if (request()->has('key'))
        <input type="hidden" name="product_key" value="{{ request()->get('key') }}">
    @endif


    <div class="col-12 mt-3" @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'admin.quotes.create') @else style="display: none" @endif>
        <div class="d-flex justify-content-between align-items-center">
            <div>
            </div>
            <div class="d-flex align-items-center">
                <input type="checkbox" id="save_product" name="save_product"  @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'admin.product.index') checked @else @endif style="margin-right:4px" />
                <label for="equal_office" >Save Product Data?</label>
            </div>
        </div>
    </div>


    <x-admin.form-group label="name" placeholder="Enter product name" :value="$product->name ?? ''" column="col-12" />
    <x-admin.form-group label="description" isType="textarea" placeholder="Enter description" :textarea_value="$product->description ?? ''" column="col-12" />
    <x-admin.form-group label="sku_number" placeholder="Enter product sku number" :value="$product->sku_number ?? ''" column="col-lg-6" />
    <x-admin.form-group label="ur_code" placeholder="Enter product ur code" :value="$product->ur_code ?? ''" column="col-lg-6" />
    <x-admin.form-group label="unit_price" placeholder="Enter product unit price" :value="$product->unit_price ?? ''" column="col-lg-6" />
    <x-admin.form-group label="setup_price" placeholder="Enter product setup price" :value="$product->setup_price ?? ''" column="col-lg-6" />
    <x-admin.form-group label="vat" isType="select" placeholder="Enter product vat" column="col-lg-6">
        <option value="yes" @isset($product) @selected($product->vat == 'yes') @endisset>Yes</option>
        <option value="no" @isset($product) @selected($product->vat == 'no') @endisset>No</option>
    </x-admin.form-group>
    <x-admin.form-group label="vat_percentage" question="count in %" :required="false" placeholder="Enter product vat amount" :value="$product->vat_percentage ?? 20" column="col-lg-6" />
</x-admin.modal>
