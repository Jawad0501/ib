@props([
    'title',
    'quotes',
    'from' => 'quote',
])
<button class="d-none" id="successModalOpener" data-bs-toggle="modal" data-bs-target="#successOrderConfirmModal">MODAL</button>

<div class="row gy-5">
    <div class="col-12">
        <div class="row gy-3">
            <div class="col-xxl-2">
                <h3 class="fs-3 fw-semibold mb-0">{{ $title }}</h3>
            </div>
            <div class="col-xxl-10">
                {{ $header ?? null }}
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row gy-3">
            @forelse ($quotes as $item)
                <x-frontend.quote-item :item="$item" :from="$from" />
                @include('components.frontend.success-order-confirm-modal', ['title' => $item->order_title])
            @empty
                <div class="col-12">
                    <div class="bg-white p-3 p-lg-4 rounded-4">
                        <p class="mb-0 text-center">Data not found!</p>
                    </div>
                </div>
            @endforelse

            <div class="col-12">
                {!! $quotes->withQueryString()->links() !!}
            </div>
        </div>
    </div>
</div>
