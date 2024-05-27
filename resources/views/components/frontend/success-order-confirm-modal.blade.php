@props([
    'title',
    'description' => null,
    'button' => null,
    'size' => 'lg',
])

<div class="modal fade" id="successOrderConfirmModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-{{ $size}}">
        <div class="modal-content py-5">
            <div class="modal-header" style="border: none">
                <div class="title text-center w-100">
                    <h5 class="heading">{{ ucfirst($title) }}</h5>
                    <div id="invoice_no" class="info my-3 fs-4">

                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="200" fill="green" height="200" viewBox="0 0 512 512">
                    <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"/>
                </svg>
            </div>

            <div class="fs-3 fw-semibold text-center mt-5">
                Congrats! Order Successful.
            </div>

            <div class="btn btn-dark w-25 mx-auto mt-3 py-2">
                <a href="{{route('order.index')}}" style="all: unset">
                    View In My Orders >
                </a>
            </div>
            <div class="absolute-button"  data-bs-dismiss="modal">
                <button type="button" class="btn-close btn-close-white" aria-label="Close"></button>
            </div>
        </div>

    </div>
</div>

<style>
    .title{
        padding: 10px 30px;
    }
    .title .heading{
        font-size: 45px;
        font-weight: 500;
    }
    .title .info{
        font-weight: 400;
    }
    .absolute-button{
        position: absolute;
        top: -4%;
        left: -3%;
        width: 60px;
        height: 60px;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #000000;
        font-size: 20px;
        font-weight: 700;
    }
    .modal-info{
        border-radius: 15px;
        background-color: #000000;
        text-align: center;
        max-width: 500px;
        width: 100%;
        padding: 20px;
        color: #ffffff;
        margin: 10px 40px;
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
</style>

<script>
    function changePage(){
        console.log('hello');
    }
</script>


