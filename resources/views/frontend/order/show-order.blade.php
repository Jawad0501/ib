@extends('layouts.frontend.new-app')

@section('title', $quote->invoice)

@section('content')
    @include('layouts.frontend.partials.aside')
    <button class="d-none" id="successModalOpener" data-bs-toggle="modal"
        data-bs-target="#successOrderConfirmModal">MODAL</button>
    <div class="quote-detail ">
        <div class="fs-22 fw-semibold">{{ $quote->order_title }}</div>
        <div class="fw-medium">
            Quote #{{ $quote->invoice }} &nbsp; | &nbsp; {{ date('d-m-y', strtotime($quote->created_at)) }} &nbsp; | &nbsp;
            {{ date('H:i', strtotime($quote->created_at)) }}
        </div>
        <div class="button">Items in this Order:</div>
        <div class="row gy-3">
            @foreach ($quote->items as $item)
                <div class="col-12">
                    <div class="border bg-white p-3 p-lg-4 rounded-4">
                        <div class="row gy-4 gy-lg-0 align-items-center">
                            <div class="col-12 col-lg-5">
                                <p class="mb-0 fw-medium">
                                    <a href="javascript:void(0)"
                                        class="text-dark">{{ $item->product?->name ? $item->product?->name : $item->product_name }}</a>
                                </p>
                                <div class="d-flex align-items-center gap-2 mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2">
                                        </rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>
                                    <span>{{ $item->quantity }}</span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5">
                                <div class="d-md-flex justify-content-between gap-2">
                                    <p class="mb-md-0 mb-3">
                                        <strong
                                            class="border border-2 rounded-3 border-light p-1 text-center unit-price-label"
                                            title="Unit Price" style="font-size:10px;">Unit</strong>
                                        <span class="ms-1">{{ convertAmount($item->unit_price) }}</span>
                                    </p>
                                    <p class="mb-md-0 mb-3">
                                        <strong class="border border-2 rounded-3 border-light p-1 text-center"
                                            title="Sub Total" style="font-size:10px;">SubTotal</strong>
                                        <span class="ms-1">{{ convertAmount($item->subtotal) }}</span>
                                    </p>
                                    <p class="mb-md-0 mb-3">
                                        <strong class="border border-2 rounded-3 border-light p-1 text-center"
                                            style="font-size:10px;">Vat</strong>
                                        <span class="ms-1">{{ convertAmount($item->vat_amount) }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2 text-lg-end">
                                <button type="button" class="btn btn-light">{{ convertAmount($item->total) }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="quote-detail">
        <div class="fs-22 fs-medium py-4 px-2">
            Order Details
        </div>

        <div class="px-2">
            <div class="row">
                @if ($quote->artwork !== null)
                    <div class="col-6 py-3">
                        <div class="fw-medium fs-16 py-2">Artwork File</div>
                        <a href="{{ uploadedFile($quote->artwork) }}" download
                            style="all:unset; cursor:pointer">{{ $quote->artwork }}</a>
                    </div>
                @endif
                @if ($quote->approval_file !== null)
                    <div class="col-6 py-3">
                        <div class="fw-medium fs-16 py-2">Approval File</div>
                        <a href="{{ uploadedFile($quote->approval_file) }}" download
                            style="all:unset; cursor:pointer">{{ $quote->approval_file }}</a>
                    </div>
                @endif
            </div>

            <div class="row ">
                <div class="col-md-6  col-sm-12 col-xl-12 col-xxl-6 py-3">
                    <div class="fw-medium fs-16 py-2">Email</div>
                    <div class="fs-14">
                        {{ $quote->user->email }}
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xl-12 col-xxl-6 py-3">
                    <div class="fw-medium fs-16 py-2">Telephone</div>
                    <div class="fs-14">
                        {{ $quote->user->telephone }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 py-3">
                    <div class="fw-medium fs-16 py-2">Delivery Address</div>
                    <div class="fs-14">
                        {{ 'PO: ' . $quote->user->delivery_address->postcode }} <br>
                        {{ $quote->user->delivery_address->address_line_1 . ', ' . $quote->user->delivery_address->address_line_2 . ', ' . $quote->user->delivery_address->city . ', ' . $quote->user->delivery_address->state . ', ' . $quote->user->delivery_address->country }}
                    </div>
                </div>
            </div>
        </div>

        <div class="d-block d-xl-none">
            <div class="w-100 bg-dark text-white mt-5 rounded-4">
                <div class="right-bar-footer-con">
                    <div class="row gy-3">
                        <div class="right-bar-footer-card text-center py-4 px-5 ">
                            <div class="right-bar-footer-card-header mb-3 fs-4 fw-semibold">
                                Quote Total
                            </div>

                            <div class="right-bar-footer-card-body">
                                <div class="mb-2">
                                    <div class="fs-5 fw-semibold">Sub Total</div>
                                    <span class="fs-6 fw-medium">{{ convertAmount($quote->items->sum('subtotal')) }}</span>
                                </div>

                                <div class="mb-2">
                                    <div class="fs-5 fw-semibold">Vat</div>
                                    <span class="fs-6 fw-medium">{{ convertAmount($quote->items->sum('vat_amount')) }}</span>
                                </div>

                                <div class="mb-4">
                                    <div class="fs-5 fw-semibold">Shipping</div>
                                    <span class="fs-6 fw-medium">{{ convertAmount($quote->shipping_charge) }}</span>
                                </div>

                                <div class="mb-2 fs-4 p-3 rounded-3 fw-semibold right-bar-footer-card-button">
                                    {{ convertAmount($quote->items->sum('total') + $quote->shipping_charge) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-block d-sm-flex justify-sm-content-center">
                <div class="w-100">
                    <a href="{{ route('order-quote', [encrypt($quote->id), 1, 'order']) }}" id="editBtn" class=""
                        style="all:unset">
                        <div class="button mx-auto mx-sm-0">
                            <span>Re-Order</span>
                        </div>
                    </a>
                </div>

                <div class="w-100">
                    <a href="{{ route('invoice.download', encrypt($quote->id)) }}" class="w-100" style="all:unset">
                        <div class="button float-sm-end  mx-auto mx-sm-0">
                            <span>Download</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.frontend.partials.order-right-bar')
    @include('components.frontend.success-order-confirm-modal', ['title' => $quote->order_title])
@endsection

<style>
    .quote-detail {
        background-color: #fbfcfc;
        border-radius: 15px;
        margin: 20px 30px;
        padding: 20px 50px;
        box-shadow: 0px 0px 1px 1px #ffffff
    }

    .quote-detail .button {
        background-color: black;
        color: white;
        border-radius: 15px;
        max-width: 200px;
        width: 100%;
        text-align: center;
        padding: 10px;
        margin: 20px 0px;
    }
</style>
