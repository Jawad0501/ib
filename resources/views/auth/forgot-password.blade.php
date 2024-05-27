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

        <style>
            .margin{
                margin: 241px 350px;
            }

            .padding{
                padding: 0px 50px;
            }

            .min-width{
                min-width: 400px;
            }

            @media (min-width: 200px) and (max-width: 450px) {
                .min-width{
                    min-width: 300px;
                }

                .padding{
                    padding: 0px 20px;
                }

                .margin{
                    margin: 100px 250px;
                }
            }

            @media (min-width: 451px) and (max-width: 1000px) {
                .margin{
                    margin: 241px 350px;
                }

                .padding{
                    padding: 0px 50px;
                }

                .min-width{
                    min-width: 400px;
                }
            }

        </style>

    </head>

    <body style="background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url({{url('storage/setting/login-new.png')}}); background-size: cover; background-repeat: no-repeat;">

        <section class="" >
            <div class="container">
                <div class="d-flex justify-content-center align-items-center ">
                    <div class="margin padding bg-white min-width" style=" box-shadow: 0px 0px 5px black; border-radius: 10px ">
                        <div class="d-flex justify-content-center my-5">
                            <img src="{{url('storage/setting/logo.png')}}" alt="" width="200px">
                        </div>
                        <form class="auth-form text-black my-5" method="post">
                            @csrf
                            <div class="alert alert-warning text-center mb-4" role="alert">
                                @if(session()->has('status'))
                                    {{ session()->get('status') }}
                                @else
                                    Enter your Email and instructions will be sent to you!
                                @endif
                            </div>

                            <x-frontend.form-group label="email" placeholder="Enter your email" column="col-12" />

                            <div class="mt-4">
                                <button type="submit" class="btn btn-dark w-100">Send Request</button>
                            </div>
                        </form><!-- end form -->
                        <div class="mt-5 text-center text-black">
                            <p>Remembered It ? <a href="{{ route('login') }}" class="fw-medium text-black text-decoration-underline"> Go to Login </a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="{{ asset(mix('js/scripts/pages/helper.js')) }}"></script>
        <script src="{{ mix('js/frontend/app.js') }}"></script>
        @stack('scripts')
    </body>
</html>

