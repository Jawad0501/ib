
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title') | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content=" " />
        <meta name="keywords" content="" />
        <meta content="Themesdesign" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('title') - {{ config('app.name') }}</title>

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ uploadedFile(getSetting('favicon')) }}">

        <link href="{{ mix('css/frontend/auth/app.css') }}" rel="stylesheet" />

    </head>

    <body class="position-relative">

        {{-- <div id="preloader">
            <div id="status">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div> --}}

        <div class="" style="">
            @if(Route::currentRouteName() == 'placeorder.index' || Route::currentRouteName() == 'login' || Route::currentRouteName() == 'password.request' || Route::currentRouteName() == 'password.reset')

            @else
            @include('layouts.frontend.partials.navbar')
            @endif

            <div class="main-content">

                <div class="page-content">

                    @yield('content')

                </div>

                {{-- @include('layouts.frontend.partials.footer-alt') --}}


                <button onclick="topFunction()" id="back-to-top"><i class="mdi mdi-arrow-up"></i></button>
            </div>

        </div>

        <script src="{{ asset(mix('js/scripts/pages/helper.js')) }}"></script>
        <script src="{{ mix('js/frontend/app.js') }}"></script>
        @stack('scripts')
    </body>
</html>
