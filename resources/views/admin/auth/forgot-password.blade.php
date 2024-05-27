@extends('layouts.admin.guest')

@section('title', 'Forget Password')

@section('content')

    <h4 class="card-title mb-1">Forgot Password? 🔒</h4>
    <p class="card-text mb-2">Enter your email and we'll send you instructions to reset your password</p>

    <form id="submit" class="auth-login-form mt-2" action="{{ route('admin.login') }}" method="POST">
        @csrf
        <x-admin.form-group
            label="email"
            type="email"
            placeholder="Enter your email"
            column="mb-3"
            autofocus
        />
        <x-admin.submit-button text="Send Reset Link" class="w-100" />

        <div class="text-center mt-2">
            <a href="{{ route('admin.login') }}" class="d-flex align-items-center justify-content-center">
                <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                Back to login
            </a>
        </div>
    </form>
@endsection
