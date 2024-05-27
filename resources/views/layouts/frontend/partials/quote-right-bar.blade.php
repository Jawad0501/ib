<aside class="right-bar bg-white">
    <div>
        <div class="right-bar-header">
            <div class="d-flex align-items-center">
                <div class="avatar">
                    <img src="{{ uploadedFile( auth()->user()->avatar ) }}" class="rounded-circle" width="48px" alt="{{ auth()->user()->name }}" />
                </div>
                <div class="ms-3">
                    <p class="mb-0 fs-16 fw-semibold">{{ Str::words(auth()->user()->designation, 2, '...') }}</p>
                    <p class="mb-0 fs-14">{{ auth()->user()->name }}</p>
                </div>
            </div>
            {{-- <div class="notify">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.53 15.3801H2.79999V7.4701C2.79999 3.6801 5.86999 0.600098 9.66999 0.600098C13.46 0.600098 16.54 3.6701 16.54 7.4701V15.3801H16.53Z" stroke="#333333" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M0.599976 15.3801H18.73" stroke="#333333" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.68 17.3701C11.68 18.4801 10.78 19.3901 9.65995 19.3901C8.53995 19.3901 7.63995 18.4901 7.63995 17.3701" stroke="#333333" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div> --}}
        </div>
        <div class="right-bar-body">
            <div class="row gy-4">
                <div class="col-12">
                    <p class="mb-0 fs-14">Account Manager</p>
                    <p class="mb-0 fs-16 fw-semibold">
                        {{-- {{ auth()->user()->quotes()->whereNotNull('account_type')->latest()->first()->admin?->name }} --}}
                        Emran Hoque
                    </p>
                </div>
                <div class="col-12">
                    <p class="mb-0 fs-14">Contact Details</p>
                    <p class="mb-0 fs-16 fw-semibold">
                        <a href="mailto:{{ getSetting('email') }}" class="text-black">{{ getSetting('email') }}</a>
                    </p>
                    <p class="mb-0 fs-16 fw-semibold">
                        <a href="tel:{{ getSetting('phone') }}" class="text-black">{{ getSetting('phone') }}</a>
                    </p>
                </div>
                <div class="col-12">
                    <p class="mb-0 fs-14">Account Type</p>
                    <p class="mb-0 fs-16 fw-semibold">{{ auth()->user()->quotes()->whereNotNull('account_type')->latest()->value('account_type') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="right-bar-body d-none d-xl-block" style=" padding: 0px 30px">
        <div class="row gy-4 d-flex flex-column align-items-center mt-2">
            <a href="{{route('order-quote', [encrypt($quote->id), 1, 'quote'])}}" id="editBtn" class="w-100" style="all:unset">
                <div class="button">
                        <span>Order</span>
                </div>
            </a>
            <a href="{{ route('invoice.download', encrypt($quote->id)) }}" class="w-100 mt-3"  style="all:unset">
                <div class="button">
                    <span>Download</span>
                </div>
            </a>
        </div>
    </div>
    <div class="right-bar-footer d-none d-xl-block" style="padding-left: 30px">
        <div class="right-bar-footer-con">
            <div class="row gy-3 mt-2">
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
                            <span class="fs-6 fw-medium">{{ convertAmount($quote->shipping_amount) }}</span>
                        </div>

                        <div class="mb-2 fs-4 p-3 rounded-3 fw-semibold right-bar-footer-card-button">
                            {{ convertAmount($quote->items->sum('total') + $quote->shipping_amount) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

<style>
    .rounded-bg{
        background-color: blue;
        width: 30px;
        height: 30px;
        border-radius: 100%;
        margin-right: 5px;
    }

    .invisible-input{
        border: none;
        max-width: 150px;
        width: 100%;
        outline: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: transparent;
    }

    @media (min-width: 1201px) {
        .right-bar {
            background-color: transparent;
        }
    }


    .quote-right-bar-header .search-bar{
        border: 1px solid gray;
        padding: 10px 10px;
        display: flex;
        align-items: center;
        border-radius: 30px;
    }

    .right-bar .quote-right-bar-header {
        padding: 20px 0px;
        width: 100%;
    }

    .right-bar-body .button{
        background-color: black;
        color:white;
        padding: 20px 10px;
        text-align: center;
        border-radius: 15px;
        cursor: pointer;
    }

    .right-bar .right-bar-footer-card{
        border-radius: 30px;
        background-color: #dbdbdb;
    }

    .right-bar .right-bar-footer-card-button{
        background-color: #ffffff;
        color: #000000;
    }

</style>
