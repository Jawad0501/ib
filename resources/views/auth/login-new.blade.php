@extends('layouts.frontend.guest')

@section('content')

<section class="" style="
background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8) ), url({{url('storage/setting/login-new.png')}}); background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center ">
            <div style="min-width: 400px; margin: 215px 350px; box-shadow: 0px 0px 5px black; border-radius: 10px " class="bg-white">
                <div class="d-flex justify-content-center my-5">
                    <img src="{{url('storage/setting/logo.png')}}" alt="" width="200px">
                </div>

                <form action="{{ route('login') }}" class="auth-form my-5" method="POST">
                    @csrf

                    @if(session()->has('status'))
                        <div class="alert alert-warning text-center mb-4" role="alert">{{ session()->get('status') }}</div>
                    @endif

                    <div class="row gy-3 px-4">
                        <x-frontend.form-group label="email" placeholder="Enter your email" column="col-12" class="mb-3" />
                        <x-frontend.form-group label="password" type="password" placeholder="Enter your password" column="col-12" class="mb-3" />

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                                <a href="{{ route('password.request') }}" class="float-end text-black">Forgot Password?</a>
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-5">
                            <button type="submit" class="btn btn-dark btn-hover w-100">Sign In</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

@endsection
