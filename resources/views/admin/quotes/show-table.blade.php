<x-admin.show-table>
    <tr>
        <th width="15%">@lang('Customer name')</th>
        <td>{{ $quote->user?->name }}</td>
    </tr>
    <tr>
        <th>@lang('Invoice')</th>
        <td>{{ $quote->invoice }}</td>
    </tr>
    <tr>
        <th>@lang('Reference')</th>
        <td>{{ $quote->referance }}</td>
    </tr>
    <tr>
        <th>@lang('Order Title')</th>
        <td>{{ $quote->order_title }}</td>
    </tr>
    <tr>
        <th>@lang('Status')</th>
        <td>{{ ucfirst($quote->status) }}</td>
    </tr>
    <tr>
        <th>@lang('Created By')</th>
        <td>{{ ucfirst($quote->admin->name) }}</td>
    </tr>
    @if ($quote->status == 'reject')
        <tr>
            <th>@lang('Reject reason')</th>
            <td>{{ $quote->reject_reason }}</td>
        </tr>
    @endif
    @if ($quote->artwork !== null)
        <tr>
            <th>@lang('Artwork')</th>
            <td>
                <a href="{{ uploadedFile($quote->artwork) }}" download class="fw-bold">Download</a>
            </td>
        </tr>
    @endif
    @if ($quote->progress !== null)
    <tr>
        <th>@lang('Progress')</th>
        <td><span class="badge bg-primary">{{ ucfirst($quote->progress) }}</span></td>
    </tr>
    @endif

    @if ($quote->approval_file !== null)
        <tr>
            <th>@lang('Approval file')</th>
            <td>
                <a href="{{ uploadedFile($quote->approval_file) }}" download class="fw-bold">Download</a>
            </td>
        </tr>
    @endif


    <tr>
        <th>@lang('PO Number')</th>
        <td>
            {{$quote->order_number}}
        </td>
    </tr>
</x-admin.show-table>

<hr class="my-3"/>

<x-admin.show-table :items="['SL','product','unit_price','setup_price','qty','vat','vat_percentage','subtotal','total']">
    @php
        $grand = 0;
        foreach ($quote->items as $item) {
            $grand = $grand + $item->total;
        }
    @endphp

    @foreach ($quote->items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->product?->name ? $item->product?->name : $item->product_name }}</td>
            <td>{{ convertAmount($item->unit_price) }}</td>
            <td>{{ convertAmount($item->setup_price) }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->vat }}</td>
            <td>{{ $item->vat_percentage }} %</td>
            <td>{{ convertAmount($item->subtotal) }}</td>
            <td>{{ convertAmount($item->total) }}</td>
        </tr>
    @endforeach
        <tr style="border: 0px">
            <td style="border: 0px"></td>
            <td style="border: 0px"></td>
            <td style="border: 0px"></td>
            <td style="border: 0px"></td>
            <td style="border: 0px"></td>
            <td style="border: 0px"></td>
            <td style="border: 0px"></td>
            <td style="border: 0px">Grand Total</td>
            <td style="border: 0px">{{ convertAmount($grand) }}</td>
        </tr>
</x-admin.show-table>
