@extends('layouts.frontend.guest')

@section('title', 'Login')

@section('content')
    <section class="bg-auth">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12">
                    <div class="card auth-box p-0">
                        <div class="row g-0">
                            <div class="col-lg-6 text-center">
                                <div class="card-body p-4">
                                    <a href="/">
                                        <img src="{{ uploadedFile(getSetting('logo')) }}" alt="" class="logo-dark">
                                    </a>
                                    <div class="mt-5">
                                        <img src="{{ uploadedFile(getSetting('auth_logo')) }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-6">
                                <div class="auth-content card-body p-5 h-100 text-white">
                                    <div class="w-100">
                                        <div class="text-center mb-4">
                                            <h5>Reset Password</h5>
                                            <p class="text-white-70">Reset your password</p>
                                        </div>
                                        <form action="{{ route('password.store') }}" class="auth-form" method="POST">
                                            @csrf

                                            <div class="row gy-3">

                                                <input type="hidden" name="token" value="{{ $request->token }}">
                                                <input type="hidden" name="email" value="{{ $request->email }}">
                                                <x-frontend.form-group type="password" label="New Password" for="password" />
                                                <x-frontend.form-group type="password" label="Confirm Password" for="password_confirmation" />

                                                <div class="col-12 text-center">
                                                    <button type="submit" class="btn btn-white btn-hover w-100">Set new password</button>
                                                </div>
                                            </div>

                                        </form>

                                        <div class="mt-5 text-center text-white-50">
                                            <p>Remembered It ? <a href="{{ route('login') }}" class="fw-medium text-white text-decoration-underline"> Go to Login </a></p>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end auth-box-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
@endsection
