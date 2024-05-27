<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
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

        .border-none {
            border: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: normal;
        }

        .wrapper {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        .heading_logo_info {
            width: 50%;
        }

        .heading-info {
            list-style: none;
            margin-top: 20px;
        }

        .heading-info li {
            margin-bottom: 10px;
        }

        .table-content,
        .print-info {
            border: 3px solid #000;
            padding: 10px;
            margin-bottom: 20px;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 3px;
            font-size: 12px;
        }

        .table th {
            border-bottom: 3px solid #9E9E9E;
        }

        .table td {
            border-bottom: 2px solid #9E9E9E;
        }

        .table-footer {
            max-width: 400px;
            margin-left: auto;
            border-bottom: 2px solid;
        }

        .table-footer-content {
            padding: 4px 10px;
        }

        .print-info {
            margin-bottom: 20px;
        }

        .footer {

            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .footer-one,
        .footer-two {
            width: 100%;
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
    </style>
</head>

<body>
    <div class="wrapper" id="GFG">
        <div class="heading">
            <div class=""  style="float: left; width: 35%;">
                <img src="{{ uploadedFile(getSetting('frontend_logo')) }}" alt="{{ config('app.name') }}" width="150px" />
                <br />
                <ul class="heading-info">
                    <li>
                        <strong>Invoice To:</strong>
                        <p>
                            Emran Hoque<br />
                            Immersive Brands<br />
                            Floor 14<br />
                            25 Cabot Square<br />
                            London<br />
                            E14 4QZ<br />
                            United Kingdom
                        </p>
                    </li>
                    <li>
                        <strong>Customer Telephone:</strong> {{ $quote->user?->telephone }}
                    </li>
                    {{-- <li>
                        <strong>Customer Mobile number:</strong>
                    </li> --}}
                </ul>
            </div>
            <div class="" style="margin-left: 15%; width: 75%;">
                <h2>Quote No: {{ $quote->invoice }}</h2>
                <h3>Quotes are valid for 30 days.</h3>
                <ul class="heading-info">
                    <li>
                        <strong>Customer:</strong> {{ $quote->user?->name }}
                    </li>
                    <li>
                        <strong>Company: </strong>{{ $quote->user?->company_name }}
                    </li>
                    <li>
                        <strong>Date: </strong> {{ $quote->created_at->format('d M Y H:i') }}
                    </li>
                </ul>
                <ul class="heading-info">
                    <li>
                        <strong>Delivery Address :</strong>
                        <p>
                            {{ $quote->user?->delivery_address->postcode }}<br />
                            {{ $quote->user?->delivery_address->location }}<br />
                            {{ $quote->user?->delivery_address->country }}<br />
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="table-content">
                <div class="table-responsive">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <th width="10%">Qty</th>
                                <th width="40%">Item Name</th>
                                <th width="10%">SKU</th>
                                <th width="15%">Total Net</th>
                                <th width="10%">Vat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quote->items as $item)
                                <tr>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->product?->name }}</td>
                                    <td>{{ $item->product?->sku_number }}</td>
                                    <td>{{ convertAmount($item->total) }}</td>
                                    <td>{{ $item->vat_percentage }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <div class="table-footer-content">
                        <div>
                            <h3 style="float: left; width: 35%;">Subtotal</h3>
                            <h3 style="margin-left: 15%">{{ convertAmount($quote->items->sum('subtotal')) }}</h3>
                        </div>
                        <div>
                            <h3 style="float: left; width: 35%;" class="fw-medium">VAT @ 20%</h3>
                            <h3 class="fw-medium">
                                {{ convertAmount($quote->items->sum('total') - $quote->items->sum('subtotal')) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="table-footer">
                    <div class="table-footer-content">
                        <div class="d-flex justify-content-between">
                            <h2>Total</h2>
                            <h3>{{ convertAmount($quote->items->sum('total')) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="table-footer" style="border-bottom: none">
                    <div class="table-footer-content">
                        <div class="d-flex justify-content-between">
                            <h3 class="fw-medium">Paid to date</h3>
                            <h3 class="fw-medium">£0.00</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="print-info">
                <h3>PRINT INFORMATION</h3>
            </div>
        </div>
        <div class="footer justify-content-center">
            {{-- <div class="footer-one">
                <p>
                    The Tiny Box Company Ltd<br/>
                    Units 1 & 2, Bluebell Business Estate<br/>
                    Sheffield Park<br/>
                    Uckfield<br/>
                    East Sussex<br/>
                    TN22 3HQ<br/>
                    United Kingdom
                </p>
            </div> --}}
            <div class="text-center">
                <ul class="heading-info" style="margin-top: 0">
                    <li>
                        <strong>VAT number:</strong> 921090850
                    </li>
                    <li>
                        <strong>Telephone - 01825 723832</strong>
                    </li>
                </ul>
                {{-- <div style="margin: 20px 0;">
                    <a href="{{ route('placeorder.index', encrypt($quote->invoice)) }}" class="btn-place">Place order now</a>
                </div> --}}
                <div style="">
                    <p><strong>{{ $quote->account_type }}</strong></p>
                </div>
            </div>
        </div>

        <div class="text-center d-none">
            <button onclick="window.print()" class="btn-place">Print</button>
        </div>

    </div>
</body>

</html>
