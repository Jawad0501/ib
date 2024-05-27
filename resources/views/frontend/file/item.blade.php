@php($key = rand())

@isset ($item)
    <input type="hidden" name="items[{{ $key }}][id]">
@endisset

<div class="repeater-wrapper pt-0 pt-md-2" data-repeater-item="{{ $key }}" style="">
    <div class="d-flex border rounded position-relative pe-0">
        <div class="row w-100 p-2 gy-2">

            {{-- <input type="text" name="items[{{ $key }}][product_name]"> --}}
            <x-frontend.form-group label="product_name" for="items[{{ $key }}][product_name]" placeholder="Enter Product Name" column="col-lg-6" />
            <x-frontend.form-group label="qty" type="number" for="items[{{ $key }}][qty]" placeholder="Enter quantity" column="col-lg-6" />

        </div>
        <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
            <a href="javascript:void(0)" id="removeItem">
                {{-- <i class="ti ti-x cursor-pointer"></i> --}}
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
            </a>
        </div>
    </div>
</div>
