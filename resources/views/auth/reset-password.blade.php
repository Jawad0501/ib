@extends('layouts.frontend.guest')

@section('content')

<section class="" style="
background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8) ), url({{url('storage/setting/login-new.png')}}); background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center ">
            <div style="min-width: 400px; margin: 231px 350px; box-shadow: 0px 0px 5px black; border-radius: 10px " class="bg-white">
                <div class="d-flex justify-content-center my-5">
                    <img src="{{url('storage/setting/logo.png')}}" alt="" width="200px">
                </div>

                <form action="{{ route('password.store') }}" class="auth-form my-5" method="POST">
                    @csrf

                    <div class="row gy-3 px-4">

                        <input type="hidden" name="token" value="{{ $request->token }}" class="mb-3">
                        <input type="hidden" name="email" value="{{ $request->email }}" class="mb-3">
                        <x-frontend.form-group type="password" label="New Password" for="password" class="mb-3"/>
                        <x-frontend.form-group type="password" label="Confirm Password" for="password_confirmation" class="mb-3" />

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-dark btn-hover w-100">Set new password</button>
                        </div>

                    </div>

                </form>

                <div class="mt-5 text-center text-black">
                    <p>Remembered It ? <a href="{{ route('login') }}" class="fw-medium text-black text-decoration-underline"> Go to Login </a></p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
