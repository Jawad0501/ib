<x-frontend.modal :title="$quote->order_title" size="xl">
    <div class="row gy-3">
        @foreach ($quote->items as $item)
            <div class="col-12">
                <div class="border bg-white p-3 p-lg-4 rounded-4">
                    <div class="row gy-4 gy-lg-0 align-items-center">
                        <div class="col-12 col-lg-5">
                            <p class="mb-0 fw-semibold">
                                <a href="javascript:void(0)" class="text-dark">{{ $item->product?->name }}</a>
                            </p>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                <span>{{ $item->quantity }}</span>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="d-flex justify-content-between gap-2">
                                <p class="mb-0">
                                    <strong class="border border-2 rounded-3 border-light p-1 text-center">£</strong>
                                    <span class="ms-1">{{ convertAmount($item->unit_price, false) }}</span>
                                </p>
                                <p class="mb-0">
                                    <strong class="border border-2 rounded-3 border-light p-1 text-center">£</strong>
                                    <span class="ms-1">{{ convertAmount($item->subtotal, false) }}</span>
                                </p>
                                <p class="mb-0">
                                    <strong class="border border-2 rounded-3 border-light p-1 text-center">Vat</strong>
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
        @endforeach
    </div>
</x-frontend.modal>
