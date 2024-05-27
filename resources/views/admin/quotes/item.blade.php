@php($key = rand())

<div class="repeater-wrapper pt-0 pt-md-2" data-repeater-item="{{ $key }}" style="">
    <div class="d-flex border rounded position-relative pe-0">
        <div class="row w-100 p-2 gy-2">

            <x-admin.form-group label="product" for="items[{{ $key }}][product]" isType="custom" column="col-lg-4">
                <div class="input-group">
                    <select class="form-select select2 w-75" id="items[{{ $key }}][product]" name="items[{{ $key }}][product]">
                        <option value="">Select product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" @selected(isset($item) && $item->product_id == $product->id)>{{ $product->name }}</option>
                        @endforeach
                        @foreach ($customProducts as $product)
                            <option value="{{ $product->product_name }}__string" @selected(isset($item) && $item->product_name == $product->product_name)>{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('admin.product.create', ['key' => $key]) }}" class="btn btn-primary add-btn" id="addBtn">
                        <i class="ti ti-circle-plus"></i>
                    </a>
                </div>
            </x-admin.form-group>

            @isset ($item)
                <input type="hidden" name="items[{{ $key }}][id]" value="{{ $item->id }}">
            @endisset
            <input type="hidden" name="items[{{ $key }}][product_name]" value="{{ $item->product_name ?? '' }}">
            <input type="hidden" name="items[{{ $key }}][product_description]" value="{{ $item->product_description ?? '' }}">

            <x-admin.form-group label="unit_price" for="items[{{ $key }}][unit_price]" :value="$item->unit_price ?? 0" placeholder="Enter unit price" column="col-lg-2" invalid="items.{{ $key }}.unit_price" />
            <x-admin.form-group label="qty" type="number" for="items[{{ $key }}][qty]" :value="$item->quantity ?? 1" type="number" placeholder="Enter qty" column="col-lg-2" invalid="items.{{ $key }}.quantity" />
            <x-admin.form-group label="setup_price" for="items[{{ $key }}][setup_price]" :value="$item->setup_price ?? 0" placeholder="Enter setup price" column="col-lg-2" invalid="items.{{ $key }}.setup_price" />
            <x-admin.form-group label="subtotal" for="items[{{ $key }}][subtotal]" :value="$item->subtotal ?? 0" placeholder="Enter subtotal" column="col-lg-2" class="total_subtotal" readonly question="unit price * qty + setup price" invalid="items.{{ $key }}.subtotal" />

            {{-- <input type="text" id="items[{{ $key }}][subtotal_without_discount]" name="items[{{ $key }}][subtotal_without_discount]" class="total_subtotal_without_discount d-none" readonly  /> --}}

            <x-admin.form-group label="discount" question="count in %" for="items[{{ $key }}][discount]" :value="$item->discount ?? 0" placeholder="Enter discount" column="col-lg-2" invalid="items.{{ $key }}.discount" />
            <x-admin.form-group label="discount_amount" for="items[{{ $key }}][discount_amount]" :value="$item->discount_amount ?? 0" class="total_discount_amount" column="col-lg-2" invalid="items.{{ $key }}.discount_amount" />

            <x-admin.form-group label="VAT" isType="select" for="items[{{ $key }}][vat]" placeholder="Enter product vat" column="col-lg-2" invalid="items.{{ $key }}.vat">
                <option value="yes" @isset($item) @selected($item->vat === 'yes') @endisset>Yes</option>
                <option value="no" @isset($item) @selected($item->vat === 'no') @endisset>No</option>
            </x-admin.form-group>

            <x-admin.form-group label="vat_percentage" question="count in %" for="items[{{ $key }}][vat_percentage]" :value="$item->vat_percentage ?? 20" placeholder="Enter vat amount" column="col-lg-2" invalid="items.{{ $key }}.vat_percentage" />
            <x-admin.form-group label="vat_amount" for="items[{{ $key }}][vat_amount]" :value="$item->vat_amount ?? 0" placeholder="Enter vat amount" class="total_vat" column="col-lg-2" invalid="items.{{ $key }}.vat_amount" />
            <x-admin.form-group label="total" for="items[{{ $key }}][total]" :value="$item->total ?? 0" placeholder="Enter total" column="col-lg-2" readonly class="total_total" question="subtotal - discount + vat amount" invalid="items.{{ $key }}.total" />
        </div>
        <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
            <a href="{{ isset($item) ? route('admin.quote-item.destroy', $item->id) : 'javascript:void(0)' }}" id="removeItem">
                <i class="ti ti-x cursor-pointer"></i>
            </a>
        </div>
    </div>
</div>
