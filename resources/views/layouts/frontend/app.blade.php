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

            @include('layouts.frontend.partials.aside')


            @include('layouts.frontend.partials.right-bar')

            @include('layouts.frontend.partials.header')

            <main class="page-content">
                @yield('content')
            </main>
        </div>

        <script src="{{ asset(mix('js/scripts/pages/helper.js')) }}"></script>
        <script src="{{ mix('js/frontend/app.js') }}"></script>
        <script src="{{ asset(mix('vendors/js/toastr/toastr.js')) }}"></script>
    </body>
</html>
