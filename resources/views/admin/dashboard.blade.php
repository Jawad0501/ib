@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
@endsection

@section('content')
    <section id="">

        <div class="row gx-2 gy-2 mb-2">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="py-2 px-2 bg-primary rounded-2" style="box-shadow: 1px 1px 4px gray;">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded-3 text-center py-1" style="width: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 320 512">
                                <path d="M112 160.4c0-35.5 28.8-64.4 64.4-64.4c6.9 0 13.8 1.1 20.4 3.3l81.2 27.1c16.8 5.6 34.9-3.5 40.5-20.2s-3.5-34.9-20.2-40.5L217 38.6c-13.1-4.4-26.8-6.6-40.6-6.6C105.5 32 48 89.5 48 160.4V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H48v44.5c0 17.4-4.7 34.5-13.7 49.4L4.6 431.5c-5.9 9.9-6.1 22.2-.4 32.2S20.5 480 32 480H288c17.7 0 32-14.3 32-32s-14.3-32-32-32H88.5l.7-1.1C104.1 390 112 361.5 112 332.5V288H224c17.7 0 32-14.3 32-32s-14.3-32-32-32H112V160.4z"/>
                            </svg>
                        </div>
                        <div class="ms-1">
                            <div class="text-white">
                                {{ convertAmount($total_amount) }}
                            </div>
                            <div class="text-white">
                                Total Amount
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="py-2 px-2 bg-primary rounded-2" style="box-shadow: 1px 1px 4px gray;">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded-3 text-center py-1" style="width: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 320 512">
                                <path d="M112 160.4c0-35.5 28.8-64.4 64.4-64.4c6.9 0 13.8 1.1 20.4 3.3l81.2 27.1c16.8 5.6 34.9-3.5 40.5-20.2s-3.5-34.9-20.2-40.5L217 38.6c-13.1-4.4-26.8-6.6-40.6-6.6C105.5 32 48 89.5 48 160.4V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H48v44.5c0 17.4-4.7 34.5-13.7 49.4L4.6 431.5c-5.9 9.9-6.1 22.2-.4 32.2S20.5 480 32 480H288c17.7 0 32-14.3 32-32s-14.3-32-32-32H88.5l.7-1.1C104.1 390 112 361.5 112 332.5V288H224c17.7 0 32-14.3 32-32s-14.3-32-32-32H112V160.4z"/>
                            </svg>
                        </div>
                        <div class="ms-1">
                            <div class="text-white">
                                {{ convertAmount($total_paid) }}
                            </div>
                            <div class="text-white">
                                Total Paid
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="py-2 px-2 bg-primary rounded-2" style="box-shadow: 1px 1px 4px gray;">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded-3 text-center py-1" style="width: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 320 512">
                                <path d="M112 160.4c0-35.5 28.8-64.4 64.4-64.4c6.9 0 13.8 1.1 20.4 3.3l81.2 27.1c16.8 5.6 34.9-3.5 40.5-20.2s-3.5-34.9-20.2-40.5L217 38.6c-13.1-4.4-26.8-6.6-40.6-6.6C105.5 32 48 89.5 48 160.4V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H48v44.5c0 17.4-4.7 34.5-13.7 49.4L4.6 431.5c-5.9 9.9-6.1 22.2-.4 32.2S20.5 480 32 480H288c17.7 0 32-14.3 32-32s-14.3-32-32-32H88.5l.7-1.1C104.1 390 112 361.5 112 332.5V288H224c17.7 0 32-14.3 32-32s-14.3-32-32-32H112V160.4z"/>
                            </svg>
                        </div>
                        <div class="ms-1">
                            <div class="text-white">
                                {{ convertAmount($due_amount) }}
                            </div>
                            <div class="text-white">
                                Total Due
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-2 gy-2 mb-2">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="py-2 px-2 rounded-2" style="box-shadow: 1px 1px 4px gray;">
                    <div class="d-flex align-items-center">
                        <div class="text-center py-1" style="width: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 384 512">
                                <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm0 32v64H288V256H96zM240 416h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                            </svg>
                        </div>
                        <div class="ms-1">
                            <div class="fw-semibold fs-3" style="color: #000000">
                                {{count($paid_invoices)}}
                            </div>
                            <div class="fw-semibold fs-5" style="color: #000000">
                                Paid Invoices
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="py-2 px-2 rounded-2" style="box-shadow: 1px 1px 4px gray; ">
                    <div class="d-flex align-items-center">
                        <div class="text-center py-1" style="width: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 384 512">
                                <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm0 32v64H288V256H96zM240 416h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                            </svg>
                        </div>
                        <div class="ms-1">
                            <div class="fw-semibold fs-3" style="color: #000000">
                                {{count($unpaid_invoices)}}
                            </div>
                            <div class="fw-semibold fs-5" style="color: #000000">
                                Unpaid Invoices
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-12 col-sm-6 col-lg-3">
                <div class="py-2 px-2 rounded-2" style="box-shadow: 1px 1px 4px gray;">
                    <div class="d-flex align-items-center">
                        <div class="text-center py-1" style="width: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 384 512">
                                <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm0 32v64H288V256H96zM240 416h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                            </svg>
                        </div>
                        <div class="ms-1">
                            <div class="fw-semibold fs-3" style="color:#000000">
                                {{count($partially_paid_invoices)}}
                            </div>
                            <div class="fw-semibold fs-5 " style="color:#000000">
                                Partialy Paid
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="py-2 px-2 rounded-2" style="box-shadow: 1px 1px 4px gray;">
                    <div class="d-flex align-items-center">
                        <div class="text-center py-1" style="width: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 384 512">
                                <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm0 32v64H288V256H96zM240 416h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                            </svg>
                        </div>
                        <div class="ms-1">
                            <div class="fw-semibold fs-3" style="color:#000000">
                                1
                            </div>
                            <div class="fw-semibold fs-5" style="color:#000000">
                                Overdue Invoices
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="row gx-2 mb-2">
            <div class="col-3">
                <div class="py-2 px-2 rounded-2" style="box-shadow: 1px 1px 4px gray;">
                    <div class="d-flex align-items-center">
                        <div class="text-center py-1" style="width: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3em" fill="#46c35f" viewBox="0 0 512 512">
                                <path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm177.6 62.1C192.8 334.5 218.8 352 256 352s63.2-17.5 78.4-33.9c9-9.7 24.2-10.4 33.9-1.4s10.4 24.2 1.4 33.9c-22 23.8-60 49.4-113.6 49.4s-91.7-25.5-113.6-49.4c-9-9.7-8.4-24.9 1.4-33.9s24.9-8.4 33.9 1.4zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                            </svg>
                        </div>
                        <div class="ms-1">
                            <div class="fw-semibold fs-3" style="color: #46c35f">
                                3
                            </div>
                            <div class="fw-semibold fs-5" style="color: #46c35f">
                                Paid Invoices
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="py-2 px-2 rounded-2" style="box-shadow: 1px 1px 4px gray; ">
                    <div class="d-flex align-items-center">
                        <div class="text-center py-1" style="width: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3em" fill="#fc6510" viewBox="0 0 512 512">
                                <path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm177.6 62.1C192.8 334.5 218.8 352 256 352s63.2-17.5 78.4-33.9c9-9.7 24.2-10.4 33.9-1.4s10.4 24.2 1.4 33.9c-22 23.8-60 49.4-113.6 49.4s-91.7-25.5-113.6-49.4c-9-9.7-8.4-24.9 1.4-33.9s24.9-8.4 33.9 1.4zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                            </svg>
                        </div>
                        <div class="ms-1">
                            <div class="fw-semibold fs-3" style="color: #fc6510">
                                2
                            </div>
                            <div class="fw-semibold fs-5" style="color: #fc6510">
                                Unpaid Invoices
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="py-2 px-2 rounded-2" style="box-shadow: 1px 1px 4px gray;">
                    <div class="d-flex align-items-center">
                        <div class="text-center py-1" style="width: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3em" fill="#019aff" viewBox="0 0 512 512">
                                <path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm177.6 62.1C192.8 334.5 218.8 352 256 352s63.2-17.5 78.4-33.9c9-9.7 24.2-10.4 33.9-1.4s10.4 24.2 1.4 33.9c-22 23.8-60 49.4-113.6 49.4s-91.7-25.5-113.6-49.4c-9-9.7-8.4-24.9 1.4-33.9s24.9-8.4 33.9 1.4zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                            </svg>
                        </div>
                        <div class="ms-1">
                            <div class="fw-semibold fs-3" style="color:#019aff">
                                9
                            </div>
                            <div class="fw-semibold fs-5" style="color:#019aff">
                                Partialy Paid
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="py-2 px-2 rounded-2" style="box-shadow: 1px 1px 4px gray;">
                    <div class="d-flex align-items-center">
                        <div class="text-center py-1" style="width: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3em" fill="#fc2c10" viewBox="0 0 512 512">
                                <path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm177.6 62.1C192.8 334.5 218.8 352 256 352s63.2-17.5 78.4-33.9c9-9.7 24.2-10.4 33.9-1.4s10.4 24.2 1.4 33.9c-22 23.8-60 49.4-113.6 49.4s-91.7-25.5-113.6-49.4c-9-9.7-8.4-24.9 1.4-33.9s24.9-8.4 33.9 1.4zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                            </svg>
                        </div>
                        <div class="ms-1">
                            <div class="fw-semibold fs-3" style="color:#fc2c10">
                                1
                            </div>
                            <div class="fw-semibold fs-5" style="color:#fc2c10">
                                Overdue Invoices
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row gx-2 gy-2">
            <div class="col-12 col-xl-8">
                <div class=" rounded-2" style="box-shadow: 1px 1px 4px gray; height:500px">
                    <div class="bg-primary text-white w-100 top-0 py-2 rounded-top ps-2 fs-3 fw-semibold">
                        Yearly Income Overview
                    </div>
                    <div id="lineChart" style="margin: 50px auto;">
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class=" rounded-2" style="box-shadow: 1px 1px 4px gray; height:500px">
                    <div class="bg-primary text-white w-100 top-0 py-2 rounded-top ps-2 fs-3 fw-semibold">
                        Payment Overview
                    </div>
                    <div id="pieChart" class="d-flex justify-content-center pieChart" style="margin-top: 50px;">
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="row">
            <div class="col-4 bg-primary">
                Total Amount
            </div>
            <div class="col-4">
                Total Paid
            </div>
            <div class="col-4">
                Total Due

            </div>
        </div> --}}
    </section>

    <style>
        .pieChart .apexcharts-canvas .apexcharts-legend-series .apexcharts-legend-text{
            margin-left: 5px !important;
            padding-left: 0px !important;
            font-size: 16px !important;
            font-weight: 500 !important;
        }

        .pieChart .apexcharts-legend{
            display: block !important;
            padding-left: 20% !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>

        var yearly_income = JSON.parse("{{ json_encode($yearly_income) }}");
        for (var i = 0; i < yearly_income.length; i++) {
            yearly_income[i] = parseFloat(yearly_income[i]).toFixed(2);
        }

        var received_amount = JSON.parse("{{ json_encode($total_paid) }}");
        received_amount = parseFloat(received_amount).toFixed(2) * 1;

        var due_amount = JSON.parse("{{ json_encode($due_amount) }}");
        due_amount = parseFloat(due_amount).toFixed(2) * 1;
        console.log(due_amount);

        var lineChartOptions = {
        chart: {
            height: 350,
            type: "line",
            stacked: false,
            toolbar: false
        },
        dataLabels: {
            enabled: false
        },
        colors: ["#27374D"],
        series: [
            {
            name: "Series A",
            data: yearly_income
            },
        ],
        stroke: {
            width: [4, 4],
            curve: 'smooth',
        },
        plotOptions: {
            bar: {
            columnWidth: "20%"
            }
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        responsive: [{
            breakpoint: 400,
            options: {
                chart: {
                width: 350
                },
                legend: {
                    position: 'bottom',
                },
            }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#lineChart"), lineChartOptions);

        chart.render();



        var pieChartOptions = {
            series: [received_amount,  due_amount],
            chart: {
                width: 450,
                type: 'pie',
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: true,
                position: 'bottom',
                horizontalAlign: 'center',
                width: 500,
            },
            labels: ['Received Amount', 'Due Amount'],
            colors: ['#27374D', '#DDE6ED'],
            responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                width: 300,
                height: 500
                },
                legend: {
                    horizontalAlign: 'center',
                    position: 'bottom',
                },
            }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#pieChart"), pieChartOptions);
        chart.render();
    </script>
@endsection



{{-- @section('content')
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row match-height">
            <!-- Greetings Card starts -->
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card card-congratulations">
                    <div class="card-body text-center">
                        <img src="{{ asset('images/elements/decore-left.png') }}" class="congratulations-img-left"
                            alt="card-img-left" />
                        <img src="{{ asset('images/elements/decore-right.png') }}" class="congratulations-img-right"
                            alt="card-img-right" />
                        <div class="avatar avatar-xl bg-primary shadow">
                            <div class="avatar-content">
                                <i data-feather="award" class="font-large-1"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1 class="mb-1 text-white">Congratulations John,</h1>
                            <p class="card-text m-auto w-75">
                                You have done <strong>57.6%</strong> more sales today. Check your new badge in your profile.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Greetings Card ends -->

            <!-- Subscribers Chart Card starts -->
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="users" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="fw-bolder mt-1">92.6k</h2>
                        <p class="card-text">Subscribers Gained</p>
                    </div>
                    <div id="gained-chart"></div>
                </div>
            </div>
            <!-- Subscribers Chart Card ends -->

            <!-- Orders Chart Card starts -->
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-warning p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="package" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="fw-bolder mt-1">38.4K</h2>
                        <p class="card-text">Orders Received</p>
                    </div>
                    <div id="order-chart"></div>
                </div>
            </div>
            <!-- Orders Chart Card ends -->
        </div>

        <div class="row match-height">
            <!-- Avg Sessions Chart Card starts -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-50">
                            <div
                                class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                                <div class="mb-1 mb-sm-0">
                                    <h2 class="fw-bolder mb-25">2.7K</h2>
                                    <p class="card-text fw-bold mb-2">Avg Sessions</p>
                                    <div class="font-medium-2">
                                        <span class="text-success me-25">+5.2%</span>
                                        <span>vs last 7 days</span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary">View Details</button>
                            </div>
                            <div
                                class="col-sm-6 col-12 d-flex justify-content-between flex-column text-end order-sm-2 order-1">
                                <div class="dropdown chart-dropdown">
                                    <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button"
                                        id="dropdownItem5" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Last 7 Days
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem5">
                                        <a class="dropdown-item" href="#">Last 28 Days</a>
                                        <a class="dropdown-item" href="#">Last Month</a>
                                        <a class="dropdown-item" href="#">Last Year</a>
                                    </div>
                                </div>
                                <div id="avg-sessions-chart"></div>
                            </div>
                        </div>
                        <hr />
                        <div class="row avg-sessions pt-50">
                            <div class="col-6 mb-2">
                                <p class="mb-50">Goal: $100000</p>
                                <div class="progress progress-bar-primary" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50"
                                        aria-valuemax="100" style="width: 50%"></div>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <p class="mb-50">Users: 100K</p>
                                <div class="progress progress-bar-warning" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="60"
                                        aria-valuemax="100" style="width: 60%"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="mb-50">Retention: 90%</p>
                                <div class="progress progress-bar-danger" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="70"
                                        aria-valuemax="100" style="width: 70%"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="mb-50">Duration: 1yr</p>
                                <div class="progress progress-bar-success" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90"
                                        aria-valuemax="100" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Avg Sessions Chart Card ends -->

            <!-- Support Tracker Chart Card starts -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">Support Tracker</h4>
                        <div class="dropdown chart-dropdown">
                            <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem4"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Last 7 Days
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem4">
                                <a class="dropdown-item" href="#">Last 28 Days</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                                <a class="dropdown-item" href="#">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                <h1 class="font-large-2 fw-bolder mt-2 mb-0">163</h1>
                                <p class="card-text">Tickets</p>
                            </div>
                            <div class="col-sm-10 col-12 d-flex justify-content-center">
                                <div id="support-trackers-chart"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <div class="text-center">
                                <p class="card-text mb-50">New Tickets</p>
                                <span class="font-large-1 fw-bold">29</span>
                            </div>
                            <div class="text-center">
                                <p class="card-text mb-50">Open Tickets</p>
                                <span class="font-large-1 fw-bold">63</span>
                            </div>
                            <div class="text-center">
                                <p class="card-text mb-50">Response Time</p>
                                <span class="font-large-1 fw-bold">1d</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Support Tracker Chart Card ends -->
        </div>

        <div class="row match-height">
            <!-- Timeline Card -->
            <div class="col-lg-4 col-12">
                <div class="card card-user-timeline">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <i data-feather="list" class="user-timeline-title-icon"></i>
                            <h4 class="card-title">User Timeline</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="timeline ms-50">
                            <li class="timeline-item">
                                <span class="timeline-point timeline-point-indicator"></span>
                                <div class="timeline-event">
                                    <h6>12 Invoices have been paid</h6>
                                    <p>Invoices are paid to the company</p>
                                    <div class="d-flex align-items-center">
                                        <img class="me-1" src="{{ asset('images/icons/json.png') }}" alt="data.json"
                                            height="23" />
                                        <h6 class="more-info mb-0">data.json</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                                <div class="timeline-event">
                                    <h6>Client Meeting</h6>
                                    <p>Project meeting with Carl</p>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-50">
                                            <img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" alt="Avatar"
                                                width="38" height="38" />
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">Carl Roy (Client)</h6>
                                            <p class="mb-0">CEO of Infibeam</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                                <div class="timeline-event">
                                    <h6>Create a new project</h6>
                                    <p>Add files to new design folder</p>
                                    <div class="avatar-group">
                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="bottom" title="Billy Hopkins" class="avatar pull-up">
                                            <img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" alt="Avatar"
                                                width="33" height="33" />
                                        </div>
                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="bottom" title="Amy Carson" class="avatar pull-up">
                                            <img src="{{ asset('images/portrait/small/avatar-s-6.jpg') }}" alt="Avatar"
                                                width="33" height="33" />
                                        </div>
                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="bottom" title="Brandon Miles" class="avatar pull-up">
                                            <img src="{{ asset('images/portrait/small/avatar-s-8.jpg') }}" alt="Avatar"
                                                width="33" height="33" />
                                        </div>
                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="bottom" title="Daisy Weber" class="avatar pull-up">
                                            <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" alt="Avatar"
                                                width="33" height="33" />
                                        </div>
                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="bottom" title="Jenny Looper" class="avatar pull-up">
                                            <img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}"
                                                alt="Avatar" width="33" height="33" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
                                <div class="timeline-event">
                                    <h6>Update project for client</h6>
                                    <p class="mb-0">Update files as per new design</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Timeline Card -->

            <!-- Sales Stats Chart Card starts -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-start pb-1">
                        <div>
                            <h4 class="card-title mb-25">Sales</h4>
                            <p class="card-text">Last 6 months</p>
                        </div>
                        <div class="dropdown chart-dropdown">
                            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"
                                data-bs-toggle="dropdown"></i>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Last 28 Days</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                                <a class="dropdown-item" href="#">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-inline-block me-1">
                            <div class="d-flex align-items-center">
                                <i data-feather="circle" class="font-small-3 text-primary me-50"></i>
                                <h6 class="mb-0">Sales</h6>
                            </div>
                        </div>
                        <div class="d-inline-block">
                            <div class="d-flex align-items-center">
                                <i data-feather="circle" class="font-small-3 text-info me-50"></i>
                                <h6 class="mb-0">Visits</h6>
                            </div>
                        </div>
                        <div id="sales-visit-chart" class="mt-50"></div>
                    </div>
                </div>
            </div>
            <!-- Sales Stats Chart Card ends -->

            <!-- App Design Card -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card card-app-design">
                    <div class="card-body">
                        <span class="badge badge-light-primary">03 Sep, 20</span>
                        <h4 class="card-title mt-1 mb-75 pt-25">App design</h4>
                        <p class="card-text font-small-2 mb-2">
                            You can Find Only Post and Quotes Related to IOS like ipad app design, iphone app design
                        </p>
                        <div class="design-group mb-2 pt-50">
                            <h6 class="section-label">Team</h6>
                            <span class="badge badge-light-warning me-1">Figma</span>
                            <span class="badge badge-light-primary">Wireframe</span>
                        </div>
                        <div class="design-group pt-25">
                            <h6 class="section-label">Members</h6>
                            <div class="avatar">
                                <img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" width="34"
                                    height="34" alt="Avatar" />
                            </div>
                            <div class="avatar bg-light-danger">
                                <div class="avatar-content">PI</div>
                            </div>
                            <div class="avatar">
                                <img src="{{ asset('images/portrait/small/avatar-s-14.jpg') }}" width="34"
                                    height="34" alt="Avatar" />
                            </div>
                            <div class="avatar">
                                <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" width="34"
                                    height="34" alt="Avatar" />
                            </div>
                            <div class="avatar bg-light-secondary">
                                <div class="avatar-content">AL</div>
                            </div>
                        </div>
                        <div class="design-planning-wrapper mb-2 py-75">
                            <div class="design-planning">
                                <p class="card-text mb-25">Due Date</p>
                                <h6 class="mb-0">12 Apr, 21</h6>
                            </div>
                            <div class="design-planning">
                                <p class="card-text mb-25">Budget</p>
                                <h6 class="mb-0">$49251.91</h6>
                            </div>
                            <div class="design-planning">
                                <p class="card-text mb-25">Cost</p>
                                <h6 class="mb-0">$840.99</h6>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary w-100">Join Team</button>
                    </div>
                </div>
            </div>
            <!--/ App Design Card -->
        </div>

        <!-- List DataTable -->
        <div class="row">
            <div class="col-12">
                <div class="card invoice-list-wrapper">
                    <div class="card-datatable table-responsive">
                        <table class="invoice-list-table table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th><i data-feather="trending-up"></i></th>
                                    <th>Client</th>
                                    <th>Total</th>
                                    <th class="text-truncate">Issued Date</th>
                                    <th>Balance</th>
                                    <th>Invoice Status</th>
                                    <th class="cell-fit">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ List DataTable -->
    </section>
    <!-- Dashboard Analytics end -->
@endsection --}}

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
@endsection
