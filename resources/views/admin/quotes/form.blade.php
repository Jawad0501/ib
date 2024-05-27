@extends('layouts.admin.app')

@php
    $url = url()->previous();
    $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

    if($route == 'admin.quotes.index'){
        $title = isset($quote) ? 'Update Quote' : 'Add New Quote';
    }
    else{
        $title = 'Edit Draft';
    }
@endphp

@section('title', $title)

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
    <style>
        .input-group .position-relative {
            width: 85%;
        }
        .input-group .btn {
            width: 5%;
        }
        .add-btn {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection

@section('content')
    <x-admin.page :title="$title">

        @can('show_quote')
            <x-slot name="header">
                <x-admin.page-button :href="route('admin.quotes.index')" title="Back to quotes" icon="back" />
                @isset($quote)
                    <x-admin.page-button :href="route('admin.quotes.show', $quote->id)" title="Quote Details" icon="show" />
                @endisset
            </x-slot>
        @endcan

        <form
            id="submit"
            action="{{ isset($quote) ? route('admin.quotes.update', $quote->id) : route('admin.quotes.store') }}"
            data-redirect="{{ route('admin.quotes.index') }}"
        >
            @csrf
            @isset($quote)
                @method('PUT')
            @endisset
            <div class="row gy-1">

                <div class="col-12 mb-1">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="isOrder" name="isOrder">
                        <label class="form-check-label" for="isOrder">Process Order</label>
                    </div>
                </div>

                <x-admin.form-group label="company" id="customer" name="customer" isType="custom" column="col-xl-6">
                    <div class="input-group">
                        <select class="form-select select2 w-75" id="customer" name="customer">
                            <option value="">Select Company</option>
                            @foreach ($data->customers as $customer)
                                <option value="{{ $customer->id }}" @isset($quote) @selected($quote->user_id === $customer->id) @endisset>{{ $customer->company_name }}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('admin.user.create', ['add_from_inside' => true]) }}" class="btn btn-primary add-btn" id="addBtn">
                            <i class="ti ti-circle-plus"></i>
                        </a>
                    </div>
                </x-admin.form-group>

                <x-admin.form-group label="reference" column="col-xl-6" placeholder="Enter reference" :value="$quote->referance ?? null" />
                <x-admin.form-group label="title" column="col-12" placeholder="Enter title" :value="$quote->order_title ?? null" />

                <div class="col-12">
                    <div id="quotes-items">
                        @isset($quote)
                            @foreach ($quote->items as $item)
                                @include('admin.quotes.item', [
                                    'products' => $data->products,
                                    'customProducts' => $data->customProducts,
                                    'item'     => $item
                                ])
                            @endforeach
                        @else
                            @include('admin.quotes.item', ['products' => $data->products, 'customProducts' => $data->customProducts])
                        @endisset
                    </div>

                    <div class="mt-1">
                        <a href="{{ route('admin.quote-item.index') }}" class="btn btn-primary" id="addItem">Add Item</a>
                    </div>

                    <hr class="mt-3 mb-2 mx-n4"/>

                    <div class="row p-0 p-sm-2">
                        <div class="col-md-6 mb-md-0 mb-3">

                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <div class="invoice-calculations">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="w-px-100" style="width: 100px">Subtotal:</span>
                                    <span class="fw-semibold" id="subtotals">{{ convertAmount(isset($quote) ? $quote->items->sum('subtotal') : 0) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="w-px-100">Discount(-):</span>
                                    <span class="fw-semibold" id="discounts">{{ convertAmount(isset($quote) ? $quote->total_discount : 0) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    {{-- <span class="w-px-100">Vat (<span id="vat_per">20%</span>):</span> --}}
                                    <span class="w-px-100">Vat:</span>
                                    <span class="fw-semibold" id="vats">{{ convertAmount(isset($quote) ? $quote->items->sum('vat_amount') : 0) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="w-px-100">Shipping:</span>
                                    <span class="fw-semibold">
                                        <input id="shippings" name="shipping" type="number" class="col-6 float-end text-end" placeholder="£ 0.00" value="{{ $quote->shipping_amount ?? 0 }}" />
                                    </span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="w-px-100">Total:</span>
                                    <span class="fw-semibold" id="totals">{{ convertAmount(isset($quote) ? ($quote->items->sum('total') + $quote->shipping_amount) : 0) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- <div class="col-12 text-end mt-4">
                    <div class="row">
                        <div class="col-6">
                            <x-admin.submit-button :text="'Save Draft'" />
                        </div>
                        <div class="col-6">
                            <x-admin.submit-button :text="isset($quote) ? 'Update' : 'Submit'" />
                        </div>
                    </div>
                </div> --}}
                <input type="hidden" id="is_draft" name="is_draft" value="false">
                <input type="hidden" id="from_edit_draft" name="from_edit_draft" value="false">


                <div class="d-flex justify-content-end">
                    {{-- <button type="button" class="btn btn-primary me-sm-3 me-1" onclick="draftQuote(@if(isset($quote)) {{$quote}} @else null @endif, '{{csrf_token()}}')">Save As Draft</button> --}}
                    @if($route == 'admin.quotes.index')
                        @if(isset($quote))
                            <x-admin.submit-button :text="'Update'" onclick="notSaveDraft()" />

                        @else
                            <x-admin.submit-draft-button :text="'Save Draft'" onclick="saveDraft()"/>
                            <x-admin.submit-button :text="'Submit'" onclick="notSaveDraft()" />

                        @endif
                    @else
                    <x-admin.submit-draft-button :text="'Save Draft'" onclick="saveDraft()"/>
                    <x-admin.submit-button text="Order" onclick="fromEditDraft()" />
                    @endif
                </div>
            </div>
        </form>
    </x-admin.page>

    {{-- <script>
        function draftQuote(quote, token){
            let url = "{{route('admin.draft-quote')}}"
            fetch(url, {
                method: 'POST',
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body:JSON.stringify({
                    quote: quote,
                }),
            })
            .then(res=>res.clone().json())
            .then( json => {
                console.log(json)
            })
        }
    </script> --}}

    <script>
        function saveDraft(){
            document.getElementById('is_draft').value="true"
        }

        function notSaveDraft(){
            document.getElementById('is_draft').value="false"
        }

        function fromEditDraft(){
            document.getElementById('is_draft').value="false"
            document.getElementById('from_edit_draft').value="true"
        }
    </script>

@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script>
        window.products = @json($data->products);
        window.customProducts = @json($data->customProducts);
    </script>
@endsection
