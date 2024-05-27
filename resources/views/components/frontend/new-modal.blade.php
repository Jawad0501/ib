@props([
    'title',
    'description' => null,
    'button' => null,
    'size' => 'md',
    'quote' => null,
    'modal_page' => null,
    'type' => null
])

<div class="modal fade" id="modal" tabindex="-1">

    <div class="modal-dialog modal-{{ $size}}" id="page1">
        <div class="modal-content" style="margin-top: 100px;">
            <div class=" modal-page d-flex justify-content-center align-items-center page-number-div top-value-1"  >
                <div class="number active">
                    1
                </div>
                <div class="line">

                </div>
                <div class="number" onclick="changeModalPage(this, 1)">
                    2
                </div>
                <div class="line">

                </div>
            </div>

            <div class="modal-header" style="border: none">
                <div class="title">
                    <h5 class="fw-semibold fs-22">{{ ucfirst($title) }}</h5>
                    <div class="fw-medium fs-16">
                        Quote #{{$quote->invoice}} &nbsp; | &nbsp; {{date('d-m-y', strtotime($quote->created_at))}} &nbsp; | &nbsp; {{date('H:i', strtotime($quote->created_at))}}
                    </div>
                </div>
            </div>
            <div class="modal-info">
                Choose the items you wish to approve for production:
            </div>
            <form {{ $attributes->merge(['method' => 'post', 'id' => 'submit']) }}>
                {{-- @csrf --}}
                <input type="hidden" id="token" value="{{csrf_token()}}">

                <div class="modal-body quote-order-details">
                    {{ $slot }}
                </div>

                @if ($button !== null)
                    <div class="modal-footer quote-order-details" style="border: none" title="Please Select an Item First">
                        <a id="confirmButton" onclick="changeModalPage(this, 1)" class="btn btn-dark disabled py-2 px-5"  >
                            Confirm & Place Order
                        </a>
                    </div>
                @endif
            </form>
            <div class="absolute-button" data-bs-dismiss="modal">
                <button type="button" class="btn-close btn-close-white" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="modal-dialog modal-{{ $size}}" id="page2" style="display: none;">
        <div class="modal-content" style="margin-top: 100px;">
            <div class=" modal-page d-flex justify-content-center align-items-center page-number-div top-value-2" >
                <div class="number" onclick="changeModalPage(this, 2)" >
                    1
                </div>
                <div class="line">

                </div>
                <div class="number active">
                    2
                </div>
                <div class="line">

                </div>
            </div>
            <div class="modal-header" style="border: none">
                <div class="title">
                    <h5 class="fw-semibold fs-22">{{ ucfirst($title) }}</h5>
                    <div class="fw-medium fs-16">
                        Quote #{{$quote->invoice}} &nbsp; | &nbsp; {{date('d-m-y', strtotime($quote->created_at))}} &nbsp; | &nbsp; {{date('H:i', strtotime($quote->created_at))}}
                    </div>
                </div>
            </div>
            <div class="modal-info">
                Enter details to process your order:
            </div>
            <form {{ $attributes->merge(['method' => 'post', ]) }}>
                @csrf

                <div class="modal-body quote-order-details">
                    <div>
                        <label class="field" for="email">
                            <div class="label">Email:</div>
                            <input id="email" type="email" class="input" value="{{auth()->user()->email}}">
                        </label>
                    </div>

                    <div>
                        <label class="field" for="telephone">
                            <div class="label">Telephone:</div>
                            <input id="telephone" type="text" class="input" value="{{auth()->user()->telephone}}">
                        </label>
                    </div>

                    <div>
                        <label class="field" for="address">
                            <div class="label">Delivery Address:</div>
                            <input id="address" type="text" class="input" value="{{auth()->user()->delivery_address->address_line_1 .', '.auth()->user()->delivery_address->address_line_2.', '.auth()->user()->delivery_address->city.', '.auth()->user()->delivery_address->state .', '. auth()->user()->delivery_address->country .', PO: '. auth()->user()->delivery_address->postcode}}">
                        </label>
                    </div>
                </div>

                @if ($button !== null)
                    <div class="modal-footer quote-order-details" style="border: none">
                        <x-frontend.submit-button :label="$button" buttonType="button" onclick="saveOrder('{{$type}}')" />
                    </div>
                @endif
            </form>
            <div class="absolute-button" data-bs-dismiss="modal">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>

</div>

<style>
    .modal-page{
        margin: 10px 0px;
    }

    .modal-page .number.active{
        background-color: #000000;
    }

    .modal-page .number{
        width: 40px;
        height: 40px;
        border-radius: 100%;
        background-color: #d3d3d3;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
    }

    .modal-page .line{
        width: 80px;
        height: 0px;
        border: 2px solid #d3d3d3;
    }

    .modal-page .line:last-child{
        display: none;
    }

    .title{
        padding: 10px 30px;
    }

    .absolute-button{
        position: absolute;
        top: -4%;
        left: -2%;
        width: 60px;
        height: 60px;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #000000;
        font-size: 20px;
        font-weight: 500;
    }

    .modal-info{
        border-radius: 15px;
        background-color: #000000;
        text-align: center;
        max-width: 500px;
        width: 100%;
        padding: 10px;
        color: #ffffff;
        margin: 10px 40px;
    }

    @media (max-width: 991px){
        .modal-info{
            max-width: 300px;
        }
    }

    .quote-order-details{
        padding: 10px 40px;
    }

    .quote-order-details .field{
        width: 100%;
    }

    .quote-order-details .label{
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .quote-order-details .input{
        width: 100%;
        padding: 15px;
        border-radius: 15px;
        border: 1px solid #d3d3d3;
        margin-bottom: 25px;
    }

    .page-number-div{
        position: absolute;
        left: 40%;
    }

    .top-value-1{
        top: -15%;
    }

    .top-value-2{
        top: -10%;
    }

    @media (max-width: 991px) {
        .page-number-div {
            position: absolute;
            left: 30%;
        }

        .top-value-1{
            top: -11%;
        }

        .top-value-2{
            top: -9%;
        }
    }
</style>


