<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: normal;

        }

        .line-height{
            line-height: 0.5;
        }

        .fw-semibold {
            font-weight: 600;
        }

        /* .w-50 {
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



        .fs-5{
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
        } */

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

        tbody tr:nth-child(odd) {background-color: #f2f2f2;}

        /* tbody tr:first-child td{
            border: none
        } */
    </style>
</head>

<body style="color: #495057;">
    <div style="position: relative; width: 800px;">
        <div style="width: 85%; height:40px; background-color: #000000">
            &nbsp;
        </div>

        <div style="padding: 25px 35px">
            <div>
                <img src="{{ uploadedFile(getSetting('frontend_logo')) }}" alt="{{ config('app.name') }}" width="150px" />
            </div>

            <div style=" position: relative; margin-top: 20px">
                <div style="position:absolute; left: 0; ">
                    <div>
                        <span>Floor 14, 25 Cabot Square, London</span> <br>
                        <span>E14 4QZ</span> <br>
                        <span>United Kingdom</span> <br>
                        <span>info@immersivebrands.com</span> <br>
                        <span>+44 0203 005 3217</span>
                    </div>
                </div>
                <div style="position:absolute; left: 40%;">
                    <div><span class="fw-semibold">Quote No.</span> {{$quote->invoice}}</div>
                    <div><span class="fw-semibold">Quotation Date:</span> {{now()->parse($quote->created_at)->format('F d, Y')}}</div>
                    <div><span class="fw-semibold">Valid Until:</span> {{now()->parse($quote->created_at)->addDays(30)->format('F d, Y')}}</div>
                </div>
            </div>

            <div style=" position: relative; margin-top: 160px">
                <div style="position:absolute; left: 0;">
                    <div class="fw-semibold fs-5" style="border-bottom: 1px solid #dee2e6; width: 250px;">
                        BILL TO
                    </div>
                    <div  style="margin-top: 5px">
                        <p>
                            <span class="fw-semibold" >Emran Hoque</span><br />
                            <span >Immersive Brands</span><br />
                            <span >Floor 14</span><br />
                            <span >25 Cabot Square</span><br />
                            <span >London</span><br />
                            <span >E14 4QZ</span><br />
                            <span >United Kingdom</span>
                        </p>
                    </div>
                </div>
                <div style="position:absolute; left: 40%;">
                    <div class="fw-semibold fs-5" style="border-bottom: 1px solid #dee2e6; width: 250px;">
                        SHIP TO
                    </div>
                    <div style="margin-top: 5px">
                        <span class="fw-semibold" >{{ $quote->user?->name }}</span> <br>
                        <span >{{ $quote->user?->company_name }}</span> <br>
                        {{-- <span >{{ $quote->user?->delivery_address->location }}</span> <br> --}}
                        <span >Postcode: {{ $quote->user?->delivery_address->postcode }} </span><br>
                        <span >{{ $quote->user?->delivery_address->country }}</span> <br>
                        <span >{{ $quote->user?->telephone }}</span>
                    </div>
                </div>
            </div>

            <div style="width: 680px;">
                <table class="table" style="width: 680px; margin-top: 260px;">
                    <thead>
                        <th width="30%" style="text-align:left; padding: 10px 0px">Item Name</th>
                        <th width="10%" style="text-align:left; padding: 10px 0px">Quantity</th>
                        <th width="10%" style="text-align:left; padding: 10px 0px">SKU</th>
                        <th width="15%" style="text-align:left; padding: 10px 0px">Unit Price</th>
                        <th width="15%" style="text-align:left; padding: 10px 0px">Setup Price</th>
                        <th width="10%" style="text-align:left; padding: 10px 0px">Vat</th>
                        <th width="15%" style="text-align:left; padding: 10px 0px">Total Net</th>
                    </thead>
                    <tbody>
                        @foreach ($quote->items as $item)
                        <tr>
                            <td style="text-align:left; padding: 10px 0px">{{ $item->product?->name }}</td>
                            <td style="text-align:left; padding: 10px 0px">{{ $item->quantity }}</td>
                            <td style="text-align:left; padding: 10px 0px">{{ $item->product?->sku_number }}</td>
                            <td style="text-align:left; padding: 10px 0px">{{ $item->product?->unit_price }}</td>
                            <td style="text-align:left; padding: 10px 0px">{{ $item->product?->setup_price }}</td>
                            <td style="text-align:left; padding: 10px 0px">{{ $item->vat_percentage }}%</td>
                            <td style="text-align:left; padding: 10px 0px">{{ convertAmount($item->total) }}</td>
                        </tr>
                        @endforeach
                    </tbody>


                </table>

                <div style="position:relative;">
                    <div style="margin-top: 20px; position:absolute; left:0">
                        <div>
                            <div class="fw-semibold">Account Details</div>
                            <div><span class="fw-semibold">Name: </span>IMMERSIVE BRANDS LTD</div>
                            <div><span class="fw-semibold">Account No: </span>47870479</div>
                            <div><span class="fw-semibold">Sort Code: </span>23-05-80</div>
                            <div><span class="fw-semibold">VAT Registration Number: </span>434 2299 96</div>
                        </div>
                    </div>

                    <div style="margin-top: 20px; position:absolute; right:0">
                        <div style="position: relative; width:250px; height: 35px; background-color: #9E9E9E; color: white; margin-left: auto">
                            <div style="position: absolute; padding-left: 10px;">
                                Subtotal
                            </div>
                            <div style="position: absolute; right: 0; padding-right: 10px;">
                                {{ convertAmount($quote->items->sum('subtotal')) }}
                            </div>
                        </div>

                        <div style="position: relative; width:250px; margin-top: 15px; height: 35px; background-color: #9E9E9E; color: white; margin-left: auto">
                            <div style="position: absolute; padding-left: 10px;">
                                Vat (20%)
                            </div>
                            <div style="position: absolute; right: 0; padding-right: 10px;">
                                {{ convertAmount(($quote->items->sum('subtotal') * 20) / 100) }}
                            </div>
                        </div>

                        <div style="position: relative; width:250px; margin-top: 15px; height: 35px; background-color: #000000; color: white; margin-left: auto">
                            <div style="position: absolute; padding-left: 10px;">
                                Total
                            </div>
                            <div style="position: absolute; right: 0; padding-right: 10px;">
                                {{ convertAmount($quote->items->sum('total')) }}
                            </div>
                        </div>

                        <div style="position: relative; width:250px; margin-top: 15px; height: 35px; background-color: #9E9E9E; color: white; margin-left: auto">
                            <div style="position: absolute; padding-left: 10px;">
                                Paid Till Date
                            </div>
                            <div style="position: absolute; right: 0; padding-right: 10px;">
                                {{ convertAmount($quote->paid_amount) }}
                            </div>
                        </div>

                        <div style="position: relative; width:250px; margin-top: 15px; height: 35px; background-color: #000000; color: white; margin-left: auto">
                            <div style="position: absolute; padding-left: 10px;">
                                Due Amount
                            </div>
                            <div style="position: absolute; right: 0; padding-right: 10px;">
                                {{ convertAmount( ($quote->items->sum('total')) - ($quote->paid_amount)) }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>




        </div>

        <div style="writing-mode: vertical-rl;
        transform: rotate(270deg); position: absolute; right: -10; top: 7%; font-size: 2.5rem; font-weight: 600; color: #343a40">
            INVOICE
        </div>

        <div style="position: absolute; bottom: 5%; left: 45%;">
            <span class="fs-5 fw-medium" style="">Thank You!</span> <br>
        </div>

        <div style="position: absolute; bottom: 0; right:0; margin-top: 20px">
            <div style="width: 700px; height:40px; background-color: #000000">
                &nbsp;
            </div>
        </div>
    </div>
</body>

</html>
