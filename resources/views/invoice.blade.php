<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
        .fw-medium  {
            font-weight: 500;
        }
        .border-none  {
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
        .heading {
            display: flex;
            margin-bottom: 30px;
            flex-direction: column;
        }
        .heading-one,
        .heading-two {
            width: 100%;
        }
        @media only screen and (min-width: 576px) {
            .heading {
                flex-direction: row;
            }
            .heading-one,
            .heading-two {
                width: 50%;
            }

            .table {
                text-align: center;
            }
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
            border-bottom: 3px solid #9e9e9e;
        }
        .table td {
            border-bottom: 2px solid #9e9e9e;
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
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .footer-one,
        .footer-two {
            width: 100%;
        }

        @media only screen and (min-width: 576px) {
            .footer {
                flex-direction: row;
            }
            .table-footer-content {
                margin-left: 100px;
            }
            .footer-one,
            .footer-two {
                width: 50%;
            }
            td:nth-of-type(2) {
                text-align: left;
            }
        }

        /* @media only screen and (max-width: 760px)  {

            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr { border: 1px solid #ccc; }

            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
            }

            td:nth-of-type(1):before { content: "Qty"; }
            td:nth-of-type(2):before { content: "Item Name"; }
            td:nth-of-type(3):before { content: "SKU"; }
            td:nth-of-type(4):before { content: "Total Net	"; }
            td:nth-of-type(5):before { content: "Vat"; }
        } */

    </style>
</head>
@php
    $quote = \App\Models\Quote::find(7);
@endphp
<body>
    <div class="wrapper">
        <div class="heading">
            <div class="heading-one">
                <img src="{{ asset('/') }}assets/images/logo-dark.png" alt="" srcset="">
                <br/>
                <ul class="heading-info">
                    <li>
                        <strong>Invoice To:</strong>
                        <p>
                            Emran Hoq<br/>
                            Immersive Brands<br/>
                            Floor 14<br/>
                            25 Cabot Square<br/>
                            London<br/>
                            E14 4QZ<br/>
                            United Kingdom
                        </p>
                    </li>
                    <li>
                        <strong>Customer Telephone:</strong> 07827444313
                    </li>
                    <li>
                        <strong>Customer Mobile number:</strong>
                    </li>
                </ul>
            </div>

            <div class="heading-two">
                <h1>Quote No :546966</h1>
                <h3>Quotes are valid for 30 days.</h3>
                <ul class="heading-info">
                    <li>
                        <strong>Customer:</strong> Emran Hoq
                    </li>
                    <li>
                        <strong>Company: </strong>Immersive Brands
                    </li>
                    <li>
                        <strong>Date: </strong>28 Apr 2023 10:00
                    </li>
                </ul>
                <ul class="heading-info">
                    <li>
                        <strong>Delivery Address :</strong>
                        <p>
                            <span>Emran Hoq</span>
                            <span>Immersive Brands</span>
                            <span>Floor 14</span>
                            <span>25 Cabot Square</span>
                            <span>London</span>
                            <span>E14 4QZ</span>
                            <span>United Kingdom</span>
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
                        <div class="d-flex justify-content-between">
                            <h3>Subtotal</h3>
                            <h3>{{ convertAmount($quote->items->sum('subtotal')) }}</h3>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h3 class="fw-medium">VAT @ 20%</h3>
                            <h3 class="fw-medium">{{ convertAmount($quote->items->sum('total') - $quote->items->sum('subtotal')) }}</h3>
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
                <h2>PRINT INFORMATION</h2>
            </div>
        </div>

        <div class="footer">
            <div class="footer-one">
                <p>
                    The Tiny Box Company Ltd<br/>
                    Units 1 & 2, Bluebell Business Estate<br/>
                    Sheffield Park<br/>
                    Uckfield<br/>
                    East Sussex<br/>
                    TN22 3HQ<br/>
                    United Kingdom
                </p>
            </div>
            <div class="footer-two">
                <ul class="heading-info" style="margin-top: 0">
                    <li>
                        <strong>VAT number:</strong> 921090850
                    </li>
                    <li>
                        <strong>Telephone - 01825 723832</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
