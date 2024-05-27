@extends('layouts.frontend.guest')

@section('title', 'Place Order')

<style>
    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    .text-start {
        text-align: left;
    }

    .text-center {
        text-align: center;
    }

    .text-end {
        text-align: right;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-center {
        justify-content: center;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .align-items-center {
        align-items: center;
    }

    .fw-medium {
        font-weight: 500;
    }

    .border-none {
        border: none;
    }

    body {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: normal;
    }

    .wrapper {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        border: 1px solid gray;
    }

    .heading {
        display: flex;
        margin-bottom: 30px;
        /* flex-direction: column; */
        overflow: hidden;
        justify-content: space-between;
    }

    .heading-one,
    .heading-two {
        width: 100%;
    }

    @media only screen and (min-width: 576px) {
        .heading {
            flex-direction: row;

        }
        .heading-one,
        .heading-two {
            width: 50%;
            /* float: left;
            display: inline-block; */
        }
        .table {
            text-align: center;
        }
    }

    .heading_logo_info {
        width: 50%;
    }

    .heading-info {
        list-style: none;
        margin-top: 20px;
    }

    .heading-info li {
        margin-bottom: 10px;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table {
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 3px;
        font-size: 12px;
    }

    .table th {
        border-bottom: 3px solid #9E9E9E;
    }

    .table td {
        border-bottom: 2px solid #9E9E9E;
    }

    .enableBlur {
        filter: blur(3px);
        pointer-events: none;
    }

    /* .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
        background-color: #9E9E9E !important;
    } */

    .nav-pills .nav-link{
        margin-right: 10px;
        background-color: #000000 !important;
        color: #ffffff;
    }

    .nav-link-gray{
        display: block;
        padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
        font-size: var(--bs-nav-link-font-size);
        font-weight: var(--bs-nav-link-font-weight);
        color: var(--bs-nav-link-color);
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
        margin-right: 10px;
        background-color: #9E9E9E !important;
        color: #ffffff;
        border: 0;
        border-radius: var(--bs-nav-pills-border-radius);
    }

    .pointer-none{
        pointer-events: none;
    }

    .nav {
        --bs-nav-link-hover-color: #ffffff !important;
        padding-left: 10px !important;
    }

    .nav-pills .nav-link.md-screen.active{
        background-color: white !important;
        color: black !important;
        border: 1px solid black;
    }

    .nav-pills .nav-link.active > div{
        background-color: white !important;
    }

    @media only screen and (max-width: 1200px) {
        #header {
            max-width: 970px !important;
            width: 100%;
        }

        #invoice-text{
            left: 133px !important;
        }

        #artwork-text{
            left: 265px !important;
        }

        #proof-text{
            left: 412px !important;
        }

        #order-processing-text{
            left: 515px !important;
        }

        #out-for-delivery-text{
            left: 660px !important;
        }

        #order-fullfilled-text{
            left: 790px !important;
        }
    }


    @media only screen and (max-width: 992px) {
        #header {
            max-width: 730px !important;
            width: 100%;
        }

        #order-text{
            font-size: 14px !important;
        }

        #invoice-text{
            left: 103px !important;
            font-size: 14px !important;
        }

        #artwork-text{
            left: 201px !important;
            font-size: 14px !important;
        }

        #proof-text{
            left: 311px !important;
            font-size: 14px !important;
        }

        #order-processing-text{
            left: 380px !important;
            font-size: 14px !important;
        }

        #out-for-delivery-text{
            left: 493px !important;
            font-size: 14px !important;
        }

        #order-fullfilled-text{
            left: 595px !important;
            font-size: 14px !important;
        }
    }

    @media only screen and (max-width: 768px) {
        #header {
            max-width: 550px !important;
            width: 100%;
        }
    }


</style>

@section('content')

    {{-- <x-frontend.page-title title="Place order" /> --}}

    <section id="header" style=" background-size: cover;
    background-color: black;
    max-width: 1140px;
    width: 100%;
    margin: 30px auto;
    background-position: center; border-radius: 10px;">
        <div class="py-5 px-3">
            <div class="row align-items-center">
                <div class="col-6 text-start">
                    <img src="{{url('storage/setting/order-status-logo.png')}}" width="180px" alt="">
                </div>

                <div class="col-6 text-end">
                    <div class="d-flex align-items-center justify-content-end me-2">
                        <div class="text-white fw-medium fs-16 me-3">Immersive Brands Limited</div>
                        <div>
                            <a href="{{route('login')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1.1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end container-->
    </section>

    <section>

    </section>

    <div class="text-center fw-semibold fs-5" style="margin-top: 80px; margin-bottom: 20px">
        <span>Order Status</span>
    </div>

    <!-- START CATEGORY -->
    <section id="body" class="section">
        <div class="container">
            <!--end row-->
            <div class="row">

                @if (session()->has('message'))
                    <div id="session_message" class="col-md-8 mx-auto">
                        <div class="alert alert-success d-flex justify-content-between align-items-center" style="margin-bottom: 80px;">
                            <div>
                                {{ session()->get('message') }}
                            </div>
                            <div onclick="hideSessionMsg()" style="cursor:pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif

                <ul class="nav nav-pills mb-3 d-md-flex d-none align-items-center justify-content-center position-relative mb-5" id="pills-tab" role="tablist">
                    <div class="w-100 position-relative" style="margin-left:5%">
                        <li>
                            <div style="width:90%; top:45%; border-top: 6px solid black" class="position-absolute">&nbsp;</div>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if($active == 'order') active @endif rounded-circle position-absolute" style="width: 50px; height:50px; top: -23px" id="pills-order-tab" data-bs-toggle="pill" data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order" aria-selected="true" onclick="activeText('order')">
                                <div id="order-active" style="border-radius: 100%; background-color: black; width: 20px; height: 20px">

                                </div>
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-circle position-absolute" style="width: 50px; height:50px; left:15%; top: -23px" id="pills-invoice-tab" data-bs-toggle="pill" data-bs-target="#pills-invoice" type="button" role="tab" aria-controls="pills-invoice" aria-selected="true" onclick="activeText('invoice')">
                                <div id="invoice-active" style="border-radius: 100%; background-color: black; width: 20px; height: 20px;">

                                </div>
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if($active == 'artwork') active @endif rounded-circle position-absolute" style="width: 50px; height:50px; left:30%; top: -23px" id="pills-artwork-tab" data-bs-toggle="pill" data-bs-target="#pills-artwork" type="button" role="tab" aria-controls="pills-artwork" aria-selected="true" onclick="activeText('artwork')">
                                <div id="artwork-active" style="border-radius: 100%; background-color: black; width: 20px; height: 20px">

                                </div>
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if($active == 'proof') active @endif rounded-circle position-absolute" style="width: 50px; height:50px; left:45%; top: -23px" id="pills-proof-tab" data-bs-toggle="pill" data-bs-target="#pills-proof" type="button" role="tab" aria-controls="pills-proof" aria-selected="true" onclick="activeText('proof')">
                                <div id="proof-active" style="border-radius: 100%; background-color: black; width: 20px; height: 20px">

                                </div>
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if($active == 'processing') active @endif  rounded-circle position-absolute" style="width: 50px; height:50px; left:60%; top: -23px" id="pills-order-processing-tab" data-bs-toggle="pill" data-bs-target="#pills-order-processing" type="button" role="tab" aria-controls="pills-order-processing" aria-selected="true" onclick="activeText('order-processing')">
                                <div id="order-processing-active" style="border-radius: 100%; background-color: black; width: 20px; height: 20px">

                                </div>
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if($active == 'delivery') active @endif  rounded-circle position-absolute" style="width: 50px; height:50px; left:75%; top: -23px" id="pills-out-for-delivery-tab" data-bs-toggle="pill" data-bs-target="#pills-out-for-delivery" type="button" role="tab" aria-controls="pills-out-for-delivery" aria-selected="true" onclick="activeText('out-for-delivery')">
                                <div id="out-of-delivery-active" style="border-radius: 100%; background-color: black; width: 20px; height: 20px">

                                </div>
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if($active == 'completed') active @endif rounded-circle position-absolute" style="width: 50px; height:50px; left:90%; top: -23px" id="pills-order-fullfilled-tab" data-bs-toggle="pill" data-bs-target="#pills-order-fullfilled" type="button" role="tab" aria-controls="pills-order-fullfilled" aria-selected="true" onclick="activeText('order-fullfilled')">
                                <div id="order-fullfilled-active" style="border-radius: 100%; background-color: black; width: 20px; height: 20px">

                                </div>
                            </button>
                        </li>
                    </div>
                    <div class="w-100 position-relative" style="margin-left:5%; margin-bottom: 20px">
                        <span id="order-text" class="text-black"  style="position: absolute; top:30px; left: 4px">
                            Order
                        </span>
                        <span id="invoice-text" class="text-muted" style="position: absolute; top:30px; left: 160px">
                            Invoice
                        </span>
                        <span id="artwork-text" class="text-muted" style="position: absolute; top:30px; left: 320px">
                            Artwork
                        </span>
                        <span id="proof-text" class="text-muted" style="position: absolute; top:30px; left: 488px">
                            Proof
                        </span>
                        <span id="order-processing-text" class="text-muted" style="position: absolute; top:30px; left: 620px">
                            In Production
                        </span>
                        <span id="out-for-delivery-text" class="text-muted" style="position: absolute; top:30px; left: 788px">
                            Dispatched
                        </span>
                        <span id="order-fullfilled-text" class="text-muted" style="position: absolute; top:30px; left: 945px">
                            Completed
                        </span>
                    </div>
                </ul>

                {{-- <ul class="nav nav-pills mb-3 d-lg-flex d-none" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-quote-tab" data-bs-toggle="pill" data-bs-target="#pills-quote" type="button" role="tab" aria-controls="pills-quote" aria-selected="true">
                            @if($quote->stage == 'quote')
                            Quote
                            @else
                            Invoice
                            @endif
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        @if($quote->stage == 'order')
                        <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill" data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order" aria-selected="false">Order</button>
                        @else
                        <button class="nav-link-gray" id="pills-order-tab" data-bs-toggle="pill" data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order" aria-selected="false">Order</button>
                        @endif
                    </li>
                    <li class="nav-item" role="presentation">
                        @if($quote->artwork != null)
                        <button class="nav-link" id="pills-artwork-tab" data-bs-toggle="pill" data-bs-target="#pills-artwork" type="button" role="tab" aria-controls="pills-artwork" aria-selected="false">Artwork</button>
                        @else
                        <button class="nav-link-gray" id="pills-artwork-tab" data-bs-toggle="pill" data-bs-target="#pills-artwork" type="button" role="tab" aria-controls="pills-artwork" aria-selected="false">Artwork</button>
                        @endif
                    </li>
                    <li class="nav-item" role="presentation">
                        @if($quote->approval_file != null)
                        <button class="nav-link" id="pills-proof-tab" data-bs-toggle="pill" data-bs-target="#pills-proof" type="button" role="tab" aria-controls="pills-proof" aria-selected="false">Proof</button>
                        @else
                        <button class="nav-link-gray" id="pills-proof-tab" data-bs-toggle="pill" data-bs-target="#pills-proof" type="button" role="tab" aria-controls="pills-proof" aria-selected="false">Proof</button>
                        @endif
                    </li>
                    <li class="nav-item" role="presentation">
                        @if( $quote->status == 'processing' || $quote->status == 'out of delivery' || $quote->status == 'fulfilled')
                        <button class="nav-link" id="pills-order-processing-tab" data-bs-toggle="pill" data-bs-target="#pills-order-processing" type="button" role="tab" aria-controls="pills-order-processing" aria-selected="false">Order Processing</button>
                        @else
                        <button class="nav-link-gray pointer-none" id="pills-order-processing-tab" data-bs-toggle="pill" data-bs-target="#pills-order-processing" type="button" role="tab" aria-controls="pills-order-processing" aria-selected="false">Order Processing</button>
                        @endif

                    </li>
                    <li class="nav-item" role="presentation">
                        @if( $quote->status == 'out of delivery' || $quote->status == 'fulfilled')
                        <button class="nav-link" id="pills-out-for-delivery-tab" data-bs-toggle="pill" data-bs-target="#pills-out-for-delivery" type="button" role="tab" aria-controls="pills-out-for-delivery" aria-selected="false">Out For Delivery</button>
                        @else
                        <button class="nav-link-gray pointer-none" id="pills-out-for-delivery-tab" data-bs-toggle="pill" data-bs-target="#pills-out-for-delivery" type="button" role="tab" aria-controls="pills-out-for-delivery" aria-selected="false">Out For Delivery</button>
                        @endif
                    </li>
                    <li class="nav-item" role="presentation">
                         @if( $quote->status == 'fulfilled')
                        <button class="nav-link" id="pills-order-fullfilled-tab" data-bs-toggle="pill" data-bs-target="#pills-order-fullfilled" type="button" role="tab" aria-controls="pills-order-fullfilled" aria-selected="false">Order Fullfilled</button>
                        @else
                        <button class="nav-link-gray pointer-none" id="pills-order-fullfilled-tab" data-bs-toggle="pill" data-bs-target="#pills-order-fullfilled" type="button" role="tab" aria-controls="pills-order-fullfilled" aria-selected="false">Order Fullfilled</button>
                        @endif
                    </li>
                  </ul> --}}

                  <ul class="nav nav-pills mb-3 d-md-none" id="pills-tab" role="tablist">
                    <div class="row">
                        <div class="col-4">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link md-screen @if($active == 'order') active @endif w-100" id="pills-order-tab" data-bs-toggle="pill" data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order" aria-selected="false">Order</button>
                            </li>
                        </div>
                        <div class="col-4">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link md-screen w-100" id="pills-invoice-tab" data-bs-toggle="pill" data-bs-target="#pills-invoice" type="button" role="tab" aria-controls="pills-invoice" aria-selected="false">Invoice</button>
                            </li>
                        </div>
                        <div class="col-4">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link md-screen @if($active == 'artwork') active @endif w-100" id="pills-artwork-tab" data-bs-toggle="pill" data-bs-target="#pills-artwork" type="button" role="tab" aria-controls="pills-artwork" aria-selected="false">Artwork</button>
                            </li>
                        </div>
                        <div class="col-6 ">
                            <li class="nav-item  mt-3" role="presentation">
                                <button class="nav-link md-screen @if($active == 'proof') active @endif w-100" id="pills-proof-tab" data-bs-toggle="pill" data-bs-target="#pills-proof" type="button" role="tab" aria-controls="pills-proof" aria-selected="false">Proof</button>
                            </li>
                        </div>
                        <div class="col-6 ">
                            <li class="nav-item mt-3" role="presentation">
                                <button class="nav-link md-screen @if($active == 'processing') active @endif w-100" id="pills-order-processing-tab" data-bs-toggle="pill" data-bs-target="#pills-order-processing" type="button" role="tab" aria-controls="pills-order-processing" aria-selected="false">In Production</button>
                            </li>
                        </div>

                        <div class="col-6 ">
                            <li class="nav-item mt-3" role="presentation">
                                <button class="nav-link md-screen @if($active == 'delivery') active @endif w-100" id="pills-out-for-delivery-tab" data-bs-toggle="pill" data-bs-target="#pills-out-for-delivery" type="button" role="tab" aria-controls="pills-out-for-delivery" aria-selected="false">Dispatched</button>
                            </li>
                        </div>

                        <div class="col-6 ">
                            <li class="nav-item mt-3" role="presentation">
                               <button class="nav-link md-screen @if($active == 'completed') active @endif w-100" id="pills-order-fullfilled-tab" data-bs-toggle="pill" data-bs-target="#pills-order-fullfilled" type="button" role="tab" aria-controls="pills-order-fullfilled" aria-selected="false">Completed</button>
                           </li>
                        </div>
                    </div>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade @if($active == 'order') show active @endif " id="pills-order" role="tabpanel" aria-labelledby="pills-order-tab" style="position:relative;">
                        <div class="w-sm-100 position-absolute top-50 start-50 translate-middle @if($quote->stage == 'order') @else d-none @endif" id="order_success" style="z-index:99;">
                            <span class="fs-4 fw-bold">Order Placed Successfully!</span>
                        </div>
                        <div id="order_tab_details" class="@if($quote->stage == 'order') enableBlur @endif" style="background-color: #fbfcfc;border-radius: 15px;margin: 20px 0px;
                        padding: 20px 50px; box-shadow: 0px 0px 1px 1px #ffffff;">
                            <div class="modal-header" style="border: none; margin-bottom:20px;">
                                <div class="title">
                                    <h5 class="fw-semibold fs-22">{{ ucfirst($quote->order_title) }}</h5>
                                    <div class="fw-medium fs-16">
                                        Quote #{{$quote->invoice}} &nbsp; | &nbsp; {{date('d-m-y', strtotime($quote->created_at))}} &nbsp; | &nbsp; {{date('H:i', strtotime($quote->created_at))}}
                                    </div>
                                </div>
                            </div>

                            <div class="modal-info" style="border-radius: 15px;background-color: #000000;text-align: center;
                            max-width: 300px;width: 100%;padding: 10px 5px;color: #ffffff; margin: 20px 0px;">
                                Choose the items you wish to order:
                            </div>

                            <div class="row gy-3">
                                <input type="hidden" name="quote_id" id="quote_id" value="{{ $quote->id }}" >
                                <input type="hidden" name="token" id="token" value="{{csrf_token()}}">
                                @foreach ($quote->items as $item)
                                <div class="d-flex align-items-center pe-5">
                                    <div class="me-3">
                                        <input class="form-check-input" type="checkbox" name="items[]" value="{{ $item->id }}" data-subtotal="{{$item->total}}"  onchange="getFormValues(this)" id="items[{{ $item->id }}]">
                                    </div>
                                    <div class="col-12">
                                        <div class="border bg-white p-3 p-lg-4 rounded-4">
                                            <div class="row gy-4 gy-lg-0 align-items-center">
                                                <div class="col-12 col-lg-5">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <p class="mb-0 fw-medium">
                                                                <a href="#" class="text-dark">{{ $item->product?->name }}</a>
                                                            </p>
                                                            <div class="d-flex align-items-center gap-2 mt-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                                                <span>{{ $item->quantity }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-5">
                                                    <div class="d-md-flex justify-md-content-between gap-2">
                                                        <p class="mb-md-0 mb-2">
                                                            <strong class="border border-2 rounded-3 border-light p-1 text-center unit-price-label" title="Unit Price" style="font-size:10px;">Unit</strong>
                                                            <span class="ms-1">{{ convertAmount($item->unit_price) }}</span>
                                                        </p>
                                                        <p class="mb-md-0 mb-2">
                                                            <strong class="border border-2 rounded-3 border-light p-1 text-center" title="Sub Total" style="font-size:10px;">SubTotal</strong>
                                                            <span class="ms-1">{{ convertAmount($item->subtotal) }}</span>
                                                        </p>
                                                        <p class="mb-md-0 mb-2">
                                                            <strong class="border border-2 rounded-3 border-light p-1 text-center" style="font-size:10px;">Vat</strong>
                                                            <span class="ms-1">{{ convertAmount($item->vat_percentage) }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2 text-lg-end">
                                                    <button type="button" class="btn btn-light">{{ convertAmount($item->total) }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>

                            <div class="row gx-2 d-none" id="total_amount_field">
                                <div class="col-6 col-md-10 text-end mt-4 fs-22 fw-semibold ">Total Amount (With 20% Vat) :</div>
                                <div class="col-6 col-md-2 text-center mt-5 mt-md-3">
                                    <button type="button" class="btn btn-light me-4 " style="width:130px" >
                                    <span>£</span>
                                    <span id="amount"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="modal-footer quote-order-details" style="border: none; margin-top: 20px">
                                <button id="confirmButton" class="btn btn-dark disabled py-2 px-5" onclick="saveOrder()">Place Order</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-invoice" role="tabpanel" aria-labelledby="pills-invoice-tab">
                        <div style="background-color: #fbfcfc;border-radius: 15px;margin: 20px 0px;
                        padding: 20px 50px; box-shadow: 0px 0px 1px 1px #ffffff; text-align: center; font-size: 16px; font-weight: 500">
                            @if($quote->stage != 'order')
                            Invoice is Outstanding!
                            @elseif($quote->stage == 'order')
                                @if($quote->invoice_status == 'unpaid')
                                    Invoice is Due! <br>
                                @elseif($quote->invoice_status == 'paid')
                                    Invoice is Paid! <br>
                                @endif
                                <button class="btn btn-dark py-1 mt-3" id="askForInvoiceBtn" onclick="askForInvoice({{$quote}})">Ask For Invoice</button>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade @if($active == 'artwork') show active @endif" id="pills-artwork" role="tabpanel" aria-labelledby="pills-artwork-tab">
                        <div style="background-color: #fbfcfc;border-radius: 15px;margin: 20px 0px;
                        padding: 20px 50px; box-shadow: 0px 0px 1px 1px #ffffff;">
                        @if($quote->artwork == null)
                            <form action="{{ route('placeorder.store', encrypt($quote->invoice)) }}" class="needs-validation" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="invoice">
                                <div class="row gy-3">
                                    {{-- <div class="col-12">
                                        <p class="">
                                            <a href="mailto:{{ getSetting('email') }}" class="btn btn-primary">Email artwork</a>
                                        </p>
                                    </div> --}}

                                    <x-frontend.form-group label="Upload artwork" for="artwork" type="file" column="col-12" />

                                    @if($quote->referance == null)
                                        <x-frontend.form-group label="referance" column="col-12" placeholder="Enter referance" column="col-12" />
                                    @endif

                                    <div class="col-4"></div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <button class="btn btn-dark py-2 px-5 float-end" type="submit">Submit Artwork</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="text-center mb-5">
                                Artwork Found
                            </div>

                            <div>
                                <object data="{{ uploadedFile($quote->artwork) }}" width="100%" height="700px">
                                    <p>
                                        Your web browser doesn't have a PDF plugin. Instead you can
                                        <a href="{{ uploadedFile($quote->artwork) }}" download>click here to download the PDF file.</a>
                                    </p>
                                </object>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="tab-pane fade @if($active == 'proof') show active @endif" id="pills-proof" role="tabpanel" aria-labelledby="pills-proof-tab">
                        @if($quote->status == 'approved' || $quote->status == 'processing' || $quote->status == 'out of delivery' || $quote->status == 'fulfilled')
                        <div style="background-color: #fbfcfc;border-radius: 15px;margin: 20px 0px;
                        padding: 20px 50px; box-shadow: 0px 0px 1px 1px #ffffff;">
                            <div class="text-center">
                                Your Order Was Approved
                            </div>
                        </div>
                        @endif

                        <div style="background-color: #fbfcfc;border-radius: 15px;margin: 20px 0px;
                        padding: 20px 50px; box-shadow: 0px 0px 1px 1px #ffffff;">

                            @if($quote->approval_file != null)
                                <div style="margin-bottom: 10px;">
                                    Attached Approval File
                                </div>
                                <div>
                                    <object data="{{ uploadedFile($quote->approval_file) }}" width="100%" height="700px">
                                        <p>
                                            Your web browser doesn't have a PDF plugin. Instead you can
                                            <a href="{{ uploadedFile($quote->approval_file) }}" download>click here to download the PDF file.</a>
                                        </p>
                                    </object>
                                </div>
                            @else
                                <div class="d-flex justify-content-center align-items-center">
                                    No Approval File Was Attached!
                                </div>
                            @endif
                        </div>

                        @if($quote->status == 'pending')
                            @if($quote->approval_file != null)
                            <div style="background-color: #fbfcfc;border-radius: 15px;margin: 20px 0px;
                            padding: 20px 50px; box-shadow: 0px 0px 1px 1px #ffffff;">
                                <form action="{{ route('approval.store', request()->route('invoice')) }}" class="needs-validation" method="POST">
                                    @csrf
                                    <input type="hidden" name="invoice">
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <label for="approval_status" class="form-label">Approval Status</label>
                                            <select class="form-select @error('approval_status') is-invalid  @enderror" name="approval_status" id="approval_status" onchange="showRejectReasonField()">
                                                @foreach ([\App\Helpers\QuoteStatus::APPROVED,\App\Helpers\QuoteStatus::REJECT] as $status)
                                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                                @endforeach
                                            </select>
                                            @error('approval_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div id="po_field" class="mt-4">
                                                <label for="po" class="form-group">Enter PO Number</label>
                                                <input type="text" id="po" name="po" class="form-control">
                                                @error('po')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 d-none" id="reject_reason_field">
                                            <label for="reject_reason" class="form-label mb-2">Reject reason</label>
                                            <textarea class="form-control @error('reject_reason') is-invalid  @enderror" name="reject_reason" id="reject_reason" placeholder="Please write reason for rejection"></textarea>
                                            @error('reject_reason')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        @endif
                    </div>
                    <div class="tab-pane fade @if($active == 'processing') show active @endif" id="pills-order-processing" role="tabpanel" aria-labelledby="pills-order-processing-tab">
                        <div style="background-color: #fbfcfc;border-radius: 15px;margin: 20px 0px;
                        padding: 20px 50px; box-shadow: 0px 0px 1px 1px #ffffff;">
                            <div class="text-center">
                                {{-- @if($quote->status == 'processing' || $quote->status == 'out of delivery' || $quote->status == 'fulfilled')
                                Your Order Is In Production!
                                @else
                                Hang in there!
                                Your Order was approved and you will be notified via email if it goes for production!

                                Thank you for your patience.
                                @endif --}}
                                @if($quote->status == 'pending')
                                    <div>Your order is still pending!</div>
                                    @if($quote->stage == 'quote')
                                    <div>Please place an order for further business.</div>
                                    @endif
                                @elseif($quote->status == 'approved')
                                    <div>Hang in there!</div>
                                    <div>Your Order was approved and you will be notified via email if it goes for production!</div>
                                @elseif($quote->status == 'processing')
                                    <div>Your Order Is In Production!</div>
                                @elseif($quote->status == 'out of delivery')
                                    <div>Your Order Is In Production!</div>
                                @else
                                    <div>Your Order Is In Production!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if($active == 'delivery') show active @endif" id="pills-out-for-delivery" role="tabpanel" aria-labelledby="pills-out-for-delivery-tab">
                        <div style="background-color: #fbfcfc;border-radius: 15px;margin: 20px 0px;
                        padding: 20px 50px; box-shadow: 0px 0px 1px 1px #ffffff;">
                            <div class="text-center">
                                {{-- @if($quote->status == 'pending' || $quote->status == 'approved' || $quote->status == 'processing')
                                @if($quote->status == 'out of delivery' || $quote->status == 'fulfilled')
                                Your Order Is Dispatched!
                                @else
                                Hang on tight!
                                Your Order is in production. You will be notified via email if it is dispatched for delivery.

                                Thank you for your patience.
                                @endif --}}
                                @if($quote->status == 'pending')
                                    <div>Your order is still pending!</div>
                                    @if($quote->stage == 'quote')
                                    <div>Please place an order for further business.</div>
                                    @endif
                                @elseif($quote->status == 'approved')
                                    <div>Hang in there!</div>
                                    <div>Your Order was approved and you will be notified via email if it goes for production!</div>
                                @elseif($quote->status == 'processing')
                                    <div>Hang on tight!</div>
                                    <div>Your Order is in production. You will be notified via email if it is dispatched for delivery.</div>
                                @elseif($quote->status == 'out of delivery')
                                    <div>Your Order Is Dispatched!</div>
                                @else
                                    <div>Your Order Is Dispatched!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if($active == 'completed') show active @endif" id="pills-order-fullfilled" role="tabpanel" aria-labelledby="pills-order-fullfilled-tab">
                        <div style="background-color: #fbfcfc;border-radius: 15px;margin: 20px 0px;
                        padding: 20px 50px; box-shadow: 0px 0px 1px 1px #ffffff;">
                            <div class="text-center">
                                {{-- @if($quote->status == 'fulfilled')
                                Your Order Is Completed!
                                @else
                                Your order is just around the corner. You will be notified via email once its completed.

                                Thank you for your patience.
                                @endif --}}
                                @if($quote->status == 'pending')
                                    <div>Your order is still pending!</div>
                                    @if($quote->stage == 'quote')
                                    <div>Please place an order for further business.</div>
                                    @endif
                                @elseif($quote->status == 'approved')
                                    <div>Hang in there!</div>
                                    <div>Your Order was approved and you will be notified via email if it goes for production!</div>
                                @elseif($quote->status == 'processing')
                                    <div>Hang on tight!</div>
                                    <div>Your Order is in production. You will be notified via email if it is dispatched for delivery.</div>
                                @elseif($quote->status == 'out of delivery')
                                    <div>Your order is just around the corner. You will be notified via email once its completed.</div>
                                @else
                                    <div>Your Order Is Completed!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </section>

    <script>

        let items = [];
        let total = 0;
        let quote_id = document.getElementById('quote_id').value;
        let csrfToken = document.getElementById('token').value;

        function activeText(text){
            if(text == 'order'){
                if(document.getElementById('order-text').classList.contains('text-muted')){
                    document.getElementById('order-text').classList.remove('text-muted')
                    document.getElementById('order-text').classList.add('text-black')
                }
            }
            else{
                if(document.getElementById('order-text').classList.contains('text-muted')){

                }
                else{
                    document.getElementById('order-text').classList.remove('text-black')
                    document.getElementById('order-text').classList.add('text-muted')
                }
            }

            if(text == 'invoice'){
                if(document.getElementById('invoice-text').classList.contains('text-muted')){
                    document.getElementById('invoice-text').classList.remove('text-muted')
                    document.getElementById('invoice-text').classList.add('text-black')
                }
            }
            else{
                if(document.getElementById('invoice-text').classList.contains('text-muted')){

                }
                else{
                    document.getElementById('invoice-text').classList.remove('text-black')
                    document.getElementById('invoice-text').classList.add('text-muted')
                }
            }

            if(text == 'artwork'){
                if(document.getElementById('artwork-text').classList.contains('text-muted')){
                    document.getElementById('artwork-text').classList.remove('text-muted')
                    document.getElementById('artwork-text').classList.add('text-black')
                }
            }
            else{
                if(document.getElementById('artwork-text').classList.contains('text-muted')){

                }
                else{
                    document.getElementById('artwork-text').classList.remove('text-black')
                    document.getElementById('artwork-text').classList.add('text-muted')
                }
            }

            if(text == 'proof'){
                if(document.getElementById('proof-text').classList.contains('text-muted')){
                    document.getElementById('proof-text').classList.remove('text-muted')
                    document.getElementById('proof-text').classList.add('text-black')
                }
            }
            else{
                if(document.getElementById('proof-text').classList.contains('text-muted')){

                }
                else{
                    document.getElementById('proof-text').classList.remove('text-black')
                    document.getElementById('proof-text').classList.add('text-muted')
                }
            }

            if(text == 'order-processing'){
                if(document.getElementById('order-processing-text').classList.contains('text-muted')){
                    document.getElementById('order-processing-text').classList.remove('text-muted')
                    document.getElementById('order-processing-text').classList.add('text-black')
                }
            }
            else{
                if(document.getElementById('order-processing-text').classList.contains('text-muted')){

                }
                else{
                    document.getElementById('order-processing-text').classList.remove('text-black')
                    document.getElementById('order-processing-text').classList.add('text-muted')
                }
            }


            if(text == 'out-for-delivery'){
                if(document.getElementById('out-for-delivery-text').classList.contains('text-muted')){
                    document.getElementById('out-for-delivery-text').classList.remove('text-muted')
                    document.getElementById('out-for-delivery-text').classList.add('text-black')
                }
            }
            else{
                if(document.getElementById('out-for-delivery-text').classList.contains('text-muted')){

                }
                else{
                    document.getElementById('out-for-delivery-text').classList.remove('text-black')
                    document.getElementById('out-for-delivery-text').classList.add('text-muted')
                }
            }


            if(text == 'order-fullfilled'){
                if(document.getElementById('order-fullfilled-text').classList.contains('text-muted')){
                    document.getElementById('order-fullfilled-text').classList.remove('text-muted')
                    document.getElementById('order-fullfilled-text').classList.add('text-black')
                }
            }
            else{
                if(document.getElementById('order-fullfilled-text').classList.contains('text-muted')){

                }
                else{
                    document.getElementById('order-fullfilled-text').classList.remove('text-black')
                    document.getElementById('order-fullfilled-text').classList.add('text-muted')
                }
            }
        }

        function getFormValues(element){
            if(items.includes(element.value)){
                var index = items.indexOf(element.value);
                if (index !== -1) {
                    items.splice(index, 1);
                }

                total = parseFloat(parseFloat(total) - parseFloat(element.getAttribute('data-subtotal'))).toFixed(2);
            }
            else{
                items.push(element.value);

                total = parseFloat(parseFloat(total) + parseFloat(element.getAttribute('data-subtotal'))).toFixed(2);
            }


            if(items.length <= 0){
                if(document.getElementById('confirmButton').classList.contains('disabled')){

                }
                else{
                    document.getElementById('confirmButton').classList.add('disabled')
                }

                if(document.getElementById('total_amount_field').classList.contains('d-none')){

                }
                else{
                    document.getElementById('total_amount_field').classList.add('d-none')
                }
            }
            else if(items.length > 0){
                if(document.getElementById('confirmButton').classList.contains('disabled')){
                    document.getElementById('confirmButton').classList.remove('disabled')
                }
                else{

                }

                if(document.getElementById('total_amount_field').classList.contains('d-none')){
                    document.getElementById('total_amount_field').classList.remove('d-none')

                }
                else{

                }

                document.getElementById('amount').innerHTML = `${total}`

            }
        }

        function saveOrder(){


            if(quote_id == null){

            }
            else if(items.length <= 0){

            }
            else{
                document.getElementById('confirmButton').innerHTML = 'Placing Order...'

                var url = "{{ route('quote.store') }}";
                fetch(url, {
                    method:'POST',
                    credentials: "same-origin",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body:JSON.stringify({
                        id: quote_id,
                        items: items
                    }),
                })
                .then(res=>res.clone().json())
                .then( json => {
                    console.log(json)
                    document.getElementById('order_success').classList.remove('d-none');
                    document.getElementById('order_tab_details').classList.add('enableBlur');
                })

            }
        }

        function hideSessionMsg(){
            let element = document.getElementById('session_message');
            element.classList.add('d-none');
        }

        function askForInvoice(quote){

            var url = "{{ route('invoice.message') }}";
            document.getElementById('askForInvoiceBtn').innerHTML = 'Sending Request...';
            fetch(url, {
                method:'POST',
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body:JSON.stringify({
                    quote: quote,
                }),
            })
            .then(res=>res.clone().json())
            .then( json => {
                document.getElementById('askForInvoiceBtn').disabled = true;
                document.getElementById('askForInvoiceBtn').innerHTML = 'Invoice Request Sent';
            })
        }

        function showRejectReasonField(){
            let value = event.target.value;
            let reject_reason_field = document.getElementById('reject_reason_field');
            let po = document.getElementById('po_field');
            if(value == 'reject'){
                if(reject_reason_field.classList.contains('d-none')){
                    reject_reason_field.classList.remove('d-none')
                }
                else{

                }

                if(po.classList.contains('d-none')){

                }
                else{
                    po.classList.add('d-none')
                }
            }
            else{
                if(reject_reason_field.classList.contains('d-none')){

                }
                else{
                    reject_reason_field.classList.add('d-none')
                }

                if(po.classList.contains('d-none')){
                    po.classList.remove('d-none')
                }
                else{

                }
            }
        }
    </script>
@endsection
