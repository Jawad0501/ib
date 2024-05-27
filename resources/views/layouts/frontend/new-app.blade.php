<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('title') - IB Software</title>

        <link rel="stylesheet" href="{{ mix('css/frontend/app.css') }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/toastr/toastr.css')) }}" />
    </head>
    <body>

        <div class="wrapper">


            <div class="overlay-bg d-none"></div>
            <div class="d-flex justify-content-between align-items-center mx-3 mt-2">
                <div id="toggled-left" class="d-xl-none text-grey">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </div>

                <div id="toggled-right" class="d-xl-none text-grey">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </div>
            </div>
            <main class="page-content">
                @yield('content')
            </main>
        </div>



        <script src="{{ asset(mix('js/scripts/pages/helper.js')) }}"></script>
        <script src="{{ mix('js/frontend/app.js') }}"></script>
        <script src="{{ asset(mix('vendors/js/toastr/toastr.js')) }}"></script>
    </body>
</html>
