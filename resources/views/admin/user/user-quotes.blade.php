@extends('layouts.admin.app')

@section('title', 'Quotes History')

@section('content')
    <div class="bg-white">
        <div class="d-flex justify-content-between px-3 pt-2 pb-0" style="font-size: 1.285rem; color: #5e5873; font-weight:500">
            <div>
                Quotes History
            </div>

            <div class="d-flex">
                <x-admin.page-button :href="route('admin.user.files', $id)" title="Show User Files" icon="invoice" class="me-2" />
                <x-admin.page-button :href="route('admin.user.index')" title="Back To Customers" icon="back" />
            </div>
        </div>
        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;" class="py-4 px-3">
            <table id="table" class="table text-center" style="background-color:#f8f8f8">
                <thead class="text-uppercase">
                    <th>Sl No.</th>
                    <th>Invoice</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>SubTotal</th>
                    <th>Vat</th>
                    <th>Total</th>
                    {{-- <th>Action</th> --}}
                </thead>
                <tbody>
                    @foreach($quotes as $quote)
                        <tr id="quote_{{$quote->sl_no}}" onclick="toggleRow({{$quote->sl_no}})" class="table-row">
                            <td>{{$quote->sl_no}}</td>
                            <td>{{$quote->invoice}}</td>
                            <td>{{date('Y-m-d H:i', strtotime($quote->created_at))}}</td>
                            <td>
                                <span class="badge bg-primary text-capitalize">{{$quote->status}}</span>
                            </td>
                            <td>{{convertAmount($quote->items->sum('subtotal'))}}</td>
                            <td>20%</td>
                            <td>{{convertAmount($quote->items->sum('total'))}}</td>
                            {{-- <td>
                                <button class="btn btn-dark" onclick="expandRow({{$quote->sl_no}})">Details</button>
                            </td> --}}
                        </tr>
                        <tr id="hidden_quote_{{$quote->sl_no}}" class="d-none bg-white">
                            <td colspan="8" style="border-top-style: none !important;">
                                <table class="table table-bordered table-hover mb-2">
                                    <tr>
                                        <th>@lang('Order Title')</th>
                                        <td>{{ $quote->order_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Artwork')</th>
                                        @if($quote->artwork != null)
                                        <td>
                                            {{-- <a href="{{ uploadedFile($quote->artwork) }}" download id="showBtn">
                                                <button class="badge bg-primary">Download</button>
                                            </a> --}}
                                            <a href="{{ uploadedFile($quote->artwork) }}" download>
                                                <button class="badge bg-primary">Download</button>
                                            </a>
                                        </td>
                                        @else
                                        <td>No Artwork Attached</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th>@lang('Approval File')</th>
                                        @if($quote->approval_file != null)
                                        <td>
                                            <a href="{{ uploadedFile($quote->approval_file) }}" download >
                                                <button class="badge bg-primary">Download</button>
                                            </a>
                                        </td>
                                        @else
                                        <td>No Approval File Attached</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th>@lang('Invoice')</th>
                                        <td>
                                            <a href="{{ route('admin.invoice.download', encrypt($quote->id)) }}">
                                                <button class="badge bg-primary">Download</button>
                                            </a>
                                        </td>
                                    </tr>
                                    @if ($quote->status == 'reject')
                                        <tr>
                                            <th>@lang('Reject reason')</th>
                                            <td>{{ $quote->reject_reason }}</td>
                                        </tr>
                                    @endif
                                </table>
                                <hr>
                                <div class="mt-2">
                                    @php
                                        $grand = 0;
                                        foreach ($quote->items as $item) {
                                            $grand = $grand + $item->total;
                                        }
                                    @endphp
                                    <table class="table table-striped">
                                        <thead>
                                            <th>Product Name</th>
                                            <th>Unit Price</th>
                                            <th>Setup Price</th>
                                            <th>Quantity</th>
                                            <th>Vat</th>
                                            <th>Vat Amount</th>
                                            <th>Sub Total</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            @foreach($quote->items as $item)
                                                <tr>
                                                    <td>{{$item->product?->name ? $item->product?->name : $item->product_name}}</td>
                                                    <td>{{$item->unit_price}}</td>
                                                    <td>{{$item->setup_price}}</td>
                                                    <td>{{$item->quantity}}</td>
                                                    <td>{{$item->vat}}</td>
                                                    <td>{{$item->vat_percentage}}%</td>
                                                    <td>{{$item->subtotal}}</td>
                                                    <td>{{$item->total}}</td>
                                                </tr>
                                            @endforeach
                                                <tr style="border: 0px">
                                                    <td style="border: 0px"></td>
                                                    <td style="border: 0px"></td>
                                                    <td style="border: 0px"></td>
                                                    <td style="border: 0px"></td>
                                                    <td style="border: 0px"></td>
                                                    <td style="border: 0px"></td>
                                                    <td style="border: 0px">Grand Total</td>
                                                    <td style="border: 0px">{{ convertAmount($grand) }}</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>

        function toggleRow(quote_sl){
            let rows = document.querySelectorAll('.table-row');
            rows.forEach((row) => {
                if(row.id == `quote_${quote_sl}`){
                    let quote_row = document.getElementById(`hidden_${row.id}`)
                    let parent_quote_row = document.getElementById(`quote_${quote_sl}`)
                    let parent_row_tds = parent_quote_row.querySelectorAll('td')
                    parent_row_tds.forEach((node) => {
                        node.style.cssText = 'border-bottom-style: none !important'
                    })
                    parent_quote_row.style.cssText = 'border-bottom-style: none !important;'
                    quote_row.style.cssText = 'border-top-style: none !important;'
                    if(quote_row.classList.contains('d-none')){
                        quote_row.classList.remove('d-none')
                    }
                    else{
                        quote_row.classList.add('d-none')
                        parent_row_tds.forEach((node) => {
                            node.style.cssText = 'border-bottom-style: solid !important;'
                        })
                        quote_row.style.cssText = 'border-top-style: solid !important;'
                    }
                }
                else{
                    let quote_row = document.getElementById(`hidden_${row.id}`)
                    let parent_quote_row = document.getElementById(row.id)
                    let parent_row_tds = parent_quote_row.querySelectorAll('td')
                    parent_row_tds.forEach((node) => {
                        node.style.cssText = 'border-bottom-style: solid !important;'
                    })
                    parent_quote_row.style.cssText = 'border-bottom-style: solid !important;'
                    quote_row.style.cssText = 'border-top-style: solid !important;'
                    if(quote_row.classList.contains('d-none')){

                    }
                    else{
                        quote_row.classList.add('d-none')
                    }
                }
            })

        }

    </script>
@endsection
