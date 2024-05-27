@extends('layouts.frontend.app')

@section('content')

    <x-frontend.page-title title="Cart" title2="Cart" title3="Your cart" />

    <!-- START CATEGORY -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h3 class="title">Your cart</h3>
                        <p class="text-muted">Confirm payment & place your order.</p>
                    </div>
                </div>
                <!--end col-->
            </div>

            <!--end row-->
            <div class="row">
                <div class="col-md-6 order-md-2 mb-4 mx-auto">
                    <ul class="list-group mb-3">
                        @foreach ($quote->items as $item)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{ $item->product?->name }}</h6>
                                    <small class="text-muted">SKU: {{ $item->product?->sku_number }}</small>
                                </div>
                                <span class="text-muted">{{ convertAmount($item->total) }}</span>
                            </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total ({{ getSetting('currency_text') }})</span>
                            <strong>{{ convertAmount($quote->items_sum_total) }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-center">
                            <form action="{{ route('checkout.store', encrypt($quote->invoice)) }}" method="POST">
                                @csrf

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Place order</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
