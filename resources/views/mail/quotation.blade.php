<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="http://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet"> --}}
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        .container {
            padding: 40px 20px;
        }

        .w-50 {
            width: 50%;
        }

        .w-100 {
            width: 100%;
        }

        .text-start {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-center {
            justify-content: center;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .fw-medium {
            font-weight: 500;
        }

        .fw-semibold {
            font-weight: 600;
        }

        .fs-5 {
            font-size: 1.15rem;
        }

        .border-none {
            border: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: normal;

        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .btn-place {
            padding: 8px 16px;
            background: #000;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
        }

        .btn-place:hover {
            color: #fff;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .page-break {
            page-break-after: always;
        }

        .page-break:last-child {
            page-break-after: auto !important;
        }
    </style>
</head>

<body style="color: #495057;">
    @php
        $page_break = 1;
        $items = $quote->items;
        $filteredItems = [];
        $last_item = false;
        $subtotal = 0;
        $total_vat = 0;
        $total = 0;
        $count = 1;
        $index = 0;
        foreach ($items as $item) {
            $subtotal += $item->subtotal;
            $total += $item->total;
            $total_vat += $item->vat_amount;
            $item['no'] = $count;
            $item['index_value'] = $index;
            $index = $index + 1;
            $count = $count + 1;
        }
    @endphp

    @for ($i = 0; $i < $page_break; $i++)
        @if ($i == 1 && $page_break == 1)
        @break
    @endif
    <div class="container page-break" style="height: 1000px">

        <div>
            <div style="position: relative; width: 100%; max-width: 800px; margin: auto; margin-bottom: 40px;">
                <div class="w-100" style="position: absolute; left: 50; top: 0">
                    <img src="{{ uploadedFile(getSetting('frontend_logo')) }}" width="200px" alt="">
                </div>
                <div style="position: absolute; right: 50; text-align: right; top: -10">
                    <div style="width:320px; font-weight: 600; font-size: 16px; color: black">Immersive Brands Ltd</div>
                    <div style="font-size: 12px;  color: gray; font-weight: 600">14th Floor</div>
                    <div style="font-size: 12px; color: gray; font-weight: 600">25 Cabot Square</div>
                    <div style="font-size: 12px; color: gray; font-weight: 600">London E14 4QZ</div>
                </div>
            </div>

            <div style="position: relative; width: 100%; max-width: 800px; margin: auto;">
                <div style="position: absolute; left: 50;   margin-top: 80px">
                    <div class="fw-semibold fs-4 text-black">No. {{ $quote->invoice }}</div>
                    <div class="fw-semibold" style="font-size: 12px;">Date: {{ date('d F Y', strtotime($quote->created_at)) }}</div>
                </div>
                <div style="position: absolute; right: 50; text-align: right; margin-top: 80px">
                    <span class="text-uppercase fw-medium text-black" style="font-size: 30px; letter-spacing: 2px;">Quotation</span>
                </div>
            </div>

            <div style="max-width: 800px; width: 100%; margin: auto; height: 100%;">
                <div style="position: relative;">
                    <div style="position: absolute; left:0; top:20%">
                        <div style="background-color:#9E9E9E; width: 207px; padding: 5px 0px; text-transform: uppercase; color: white; text-align: center;">
                            Invoice To
                        </div>
                        <div style="background-color:#f2f2f3; width:130px; padding-left: 57px; padding-right:20px; padding-top: 20px; padding-bottom:20px">
                            <div>
                                <div>
                                    <div style="font-size: 9px; font-weight: 600;  color: gray;">
                                        {{ $quote->user?->name }}
                                    </div>
                                    <div class="text-uppercase" style="color:black; font-weight:600; font-size:10px">
                                        {{ $quote->user?->company_name }}
                                    </div>
                                </div>

                                <div style="margin-top: 10px;">
                                    @if ($quote->user?->delivery_address != null)
                                        <div style="font-size: 9px; font-weight: 500">
                                            {{ $quote->user?->delivery_address->address_line_1 }},
                                            {{ $quote->user?->delivery_address->address_line_2 }}
                                        </div>
                                        <div style="font-size: 9px; font-weight: 500">{{ $quote->user?->delivery_address->city }}</div>
                                        <div style="font-size: 9px; font-weight: 500">{{ $quote->user?->delivery_address->state }}</div>
                                        <div style="font-size: 9px; font-weight: 500">{{ $quote->user?->delivery_address->country }}</div>
                                    @endif
                                </div>
                                <div style="margin-top: 10px;">
                                    <div style="font-size: 9px; font-weight: 600; text-transform: uppercase">
                                        This quote is valid for 28 days
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div style="margin-top: 200px;">
                                    <div class="text-uppercase" style="font-size: 10px; font-weight: 600; color: black;">Contact</div>
                                    <div style="font-size: 9px; font-weight: 500; margin-top: 5px">020 3005 3217
                                    </div>
                                    <div style="font-size: 9px; font-weight: 500; margin-top: 5px; margin-bottom: 10px;">
                                        info@immersivebrands.co.uk
                                    </div>
                                </div>
                                <div style="border-top: 6px solid gray; width: 30px; margin-top: 20px; margin-bottom: 10px"></div>
                                <div style="">
                                    <div style="font-size: 9px; font-weight: 500; color: black">
                                        Company Registration No.
                                    </div>
                                    <div style="font-size: 9px; font-weight: 500; color: black">
                                        14617141.
                                    </div>
                                </div>

                                <div style="">
                                    <div style="font-size: 9px; font-weight: 500; color: black; margin-top: 10px;">
                                        Regitered Office</div>
                                    <div style="font-size: 9px; font-weight: 500; color: black">14th Floor, 25 Cabot
                                        Square,</div>
                                    <div style="font-size: 9px; font-weight: 500; color: black">London, London, E14
                                        4QZ,</div>
                                    <div style="font-size: 9px; font-weight: 500; color: black">United Kingdom.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="position: absolute; right:0; left: 27%; top:20%;">
                        <div>
                            <table style="border-spacing: 0px !important;">
                                <thead style="background-color: #9E9E9E; ">
                                    <td style="padding: 5px 0px; text-align:center; text-transform: uppercase; color: white;">
                                        No.
                                    </td>
                                    <td style="padding: 5px 0px; text-transform: uppercase; color: white;">
                                        Description
                                    </td>
                                    <td style="padding: 5px 0px; text-align:center; text-transform: uppercase; color: white;">
                                        QTY
                                    </td>
                                    <td style="padding: 5px 0px; text-align:center; text-transform: uppercase; color: white;">
                                        Unit
                                    </td>
                                    <td style="padding: 5px 0px; text-align:center; text-transform: uppercase; color: white;">
                                        Price
                                    </td>
                                </thead>
                                <tbody>
                                    {{-- @php
                                        $subtotal = 0;
                                        $total = 0;
                                        $count = 1;
                                        foreach($items as $item){
                                            $subtotal = $subtotal + $item->subtotal;
                                            $total = $total + $item->total;
                                            $item['no'] = $count;
                                            $count = $count + 1;
                                        }
                                    @endphp --}}
                                    @php
                                        $temp_item = null;
                                    @endphp
                                    @foreach ($items as $key => $item)
                                        @if ($item->no / (8 * ($i + 1)) == 1)
                                            @php
                                                $page_break = $page_break + 1;
                                            @endphp
                                            @foreach ($items as $key => $remove_item)
                                                @if ($remove_item->no >= $item->no)
                                                    @php
                                                        $filteredItems[$key] = $remove_item;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @break
                                    @else
                                        @php
                                            $temp_item = $item;
                                        @endphp
                                    @endif

                                    <tr>
                                        <td style="width: 50px; text-align:center; font-size: 12px; font-weight: 600; color: black">
                                            {{ $item->no }}
                                        </td>
                                        <td style="width: 200px; border-bottom: 2px solid #f2f2f3">
                                            <div style="font-size: 12px; font-weight: 600; color: black; margin-top: 10px">
                                                {{ $item->product?->name ?? $item->product_name }}
                                            </div>
                                            <div style="font-size: 10px; font-weight: 500; margin-top: 10px;">
                                                {{ $item->product?->description ?? $item->product_description }}
                                            </div>
                                        </td>
                                        <td style="width: 100px; text-align:center; font-size: 11px; font-weight: 500; border-bottom: 2px solid #f2f2f3">
                                            {{ $item->quantity }}
                                        </td>
                                        <td style="width: 100px; text-align:center; font-size: 11px; font-weight: 500; border-bottom: 2px solid #f2f2f3">
                                            {{ $item->unit_price }}
                                        </td>
                                        <td style="width: 100px; text-align:center; font-size: 11px; font-weight: 500; border-bottom: 2px solid #f2f2f3">
                                            {{ $item->subtotal }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($temp_item->no == count($quote->items))
                        <div style="position: relative; width:270px; margin-left:auto; margin-bottom: 20px;">
                            <div style="position: absolute; left:0; color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-left: 13px;  margin-top: 5px;">
                                Sub Total
                            </div>
                            <div style="position: absolute; right:0; color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-right: 30px;  margin-top: 5px;">
                                {{ convertAmount($subtotal) }}
                            </div>
                        </div>
                        <div style="position: relative; width:270px; margin-left:auto; margin-bottom: 20px; border-bottom:  2px solid #f2f2f3; padding: 5px 0px">
                            <div style="position: absolute; left:0; color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-left: 13px; margin-top: 10px;">
                                Discount
                            </div>
                            <div style="position: absolute; right:0; color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-right: 30px;margin-top: 10px; ">
                                {{ convertAmount($quote->total_discount) }}
                            </div>
                        </div>
                        <div style="position: relative; width:270px; margin-left:auto; margin-bottom: 20px; border-bottom:  2px solid #f2f2f3; padding: 5px 0px">
                            <div style="position: absolute; left:0; color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-left: 13px; margin-top: 10px;">
                                Shipping
                            </div>
                            <div style="position: absolute; right:0; color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-right: 30px; margin-top: 10px;">
                                {{ convertAmount($quote->shipping_amount) }}
                            </div>
                        </div>
                        <div style="position: relative; width:270px; margin-left:auto;; margin-bottom: 20px; border-bottom:  2px solid #f2f2f3; padding: 5px 0px">
                            <div style="position: absolute; left:0; color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-left: 13px; margin-top: 10px;">
                                VAT (20%)
                            </div>
                            <div style="position: absolute; right:0; color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-right: 30px; margin-top: 10px;">
                                {{ convertAmount($total_vat) }}
                            </div>
                        </div>
                        <div style="position: relative; width:270px; margin-left:auto; margin-bottom: 20px; border-bottom:  2px solid #f2f2f3; padding: 5px 0px">
                            <div style="position: absolute; left:0; color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-left: 13px; margin-top: 10px;">
                                Grand Total
                            </div>
                            <div style="position: absolute; right:0; color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-right: 30px; margin-top: 10px;">
                                {{ convertAmount($total + $quote->shipping_amount) }}
                            </div>
                        </div>
                        <div style="position: relative; width:270px; margin-left:auto; margin-bottom: 20px; border-bottom:  2px solid #f2f2f3; padding: 5px 0px">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @php
        $items = (object) $filteredItems;
    @endphp
</div>
@endfor
</body>

</html>
