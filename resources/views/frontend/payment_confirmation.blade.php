@extends('layouts.frontend.app')

@section('title', 'Payment')

@section('content')
    <!---profile-down-sectin end-->
    <div class="bg-light rounded px-4 my-5">
        <div class="row">
            <div class="col-lg-1">
                <div class="text-center py-2 my-3 rounded bg-white ">
                    <h3 class="lh-1"><strong class="font-weight-bold">15%</strong>
                        OFF
                    </h3>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="py-4 ">
                    <p class="fs-5">Reminder: Last chance for 15% Off your latest Quote</p>
                    <h4>Order ‘Quote IB0038’ now and get 15% OFF!</h4>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="py-4">
                    <h5 class="bg-dark-color rounded text-white text-center py-3">Available till 23:59 PM</h5>
                    <h4 class="text-center ">14 : 46 : 23</h4>
                </div>
            </div>
        </div>
    </div>
    <!---profile-down-sectin end-->

    <div class="main-section rounded-3 cart p-5 my-5">
        <!----qoute-section start-->
        <div class="qoute-section">
            <div class="row text">
                <div class="col-lg-10">
                    @if ($payment->status === 'success')
                        <h4>Your Payment Successfully Completed</h4>
                    @else
                        <h4>Your payment has been canceled</h4>
                    @endif
                </div>
            </div>
            <hr />
        </div>
    </div>
@endsection
