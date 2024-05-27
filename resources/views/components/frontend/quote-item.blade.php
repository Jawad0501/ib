@props(['item', 'from'])

<div class="col-12">
    <div class="bg-white p-3 p-lg-4 rounded-4">
        <div class="d-flex flex-column flex-sm-row gap-3 align-items-sm-center justify-content-sm-between">
            <div>
                <p class="mb-0 fw-semibold">
                    {{-- <a href="{{ $from !== 'file' ? route("$from.show", encrypt($item->id)) : 'javascript:void(0)' }}" class="text-dark">{{ $item->order_title }}</a> --}}
                    @if ($from !== 'file' )
                        @if($from !== 'invoice')
                            @if($from === 'order')
                                <div class="d-flex fw-semibold">
                                    <a href="{{ route("$from.show", encrypt($item->id)) }}" class="text-dark me-2">
                                        {{ $item->order_title }}
                                    </a>

                                    @if($item->status == 'pending')
                                        <div style="color: #ffffff; background-color: rgb(0, 0, 0)" class="badge rounded-1 mb-0">
                                            <span>Pending</span>
                                        </div>
                                    @elseif($item->status == 'approved')
                                        <div style="color: #0000ff; background-color: rgba(0, 0, 255, 0.1)" class="badge rounded-1 mb-0">
                                            <span>Approved</span>
                                        </div>
                                    @elseif($item->status == 'processing')
                                        <div style="color: #ffa500; background-color: rgba(255, 165, 0, 0.1)" class="badge rounded-1">
                                            <span>In Production</span>
                                        </div>
                                    @elseif($item->status == 'out of delivery')
                                        <div style="color: #800080; background-color: rgba(128, 0, 128, 0.1)" class="badge rounded-1">
                                            <span>Dispatched</span>
                                        </div>
                                    @elseif($item->status == 'fulfilled')
                                        <div style="color: #00ff00; background-color: rgba(0, 255, 0, 0.1)" class="badge rounded-1">
                                            <span>Completed</span>
                                        </div>
                                    @elseif($item->status == 'reject')
                                        <div style="color: #ff0000; background-color: rgba(255, 0, 0, 0.1)" class="badge rounded-1">
                                            <span>Rejected</span>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <a href="{{ route("$from.show", encrypt($item->id)) }}" class="text-dark me-2">
                                    {{ $item->order_title }}
                                </a>
                            @endif
                        @else
                            <a href="{{ route('invoice.edit', encrypt($item->id)) }}" id="printBtn" class="text-dark">
                                {{ $item->order_title }}
                            </a>
                        @endif
                    @endif
                </p>
                <p class="mb-0" @if($from === 'order') style="line-height: 0.2" @endif>{{ $item->created_at->format('d-m-Y H:i') }}</p>
            </div>
            <div style="min-width:190px;" class="text-sm-end">
                @if ($from !== 'file' )
                    @if($from !== 'invoice')
                        <a href="{{ route("$from.show", encrypt($item->id)) }}" class="text-secondary p-1 shape-secondary rounded-1 fs-14 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="#3dd589"><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                            <span>Open</span>
                        </a>
                    @else
                        <a href="{{ route('invoice.edit', encrypt($item->id)) }}" id="printBtn" class="text-secondary p-1 shape-secondary rounded-1 fs-14 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="#3dd589"><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                            <span>Open</span>
                        </a>
                    @endif
                @endif
                @if ($from === 'invoice')
                    <a href="{{ route('invoice.download', encrypt($item->id)) }}"  class="text-info p-1 shape-info rounded-1 fs-14 me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#00cfe8"><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                        <span>Download</span>
                    </a>
                @endif
                @if($from !== 'invoice')
                    @if($from === 'quote')
                        <a href="{{ route('order-quote', ['id' => encrypt($item->id), 1, 'quote']) }}" id="addBtn" class="text-primary p-1 shape-primary rounded-1 fs-14">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="#00cfe8">
                                <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                            </svg>
                            <span>Order</span>
                        </a>
                    @elseif($from === 'order')
                        <a href="{{ route('order-quote', ['id' => encrypt($item->id), 1, 'order']) }}" id="addBtn" class="text-primary p-1 shape-primary rounded-1 fs-14">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="#00cfe8">
                                <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                            </svg>
                            <span>Re-Order</span>
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
