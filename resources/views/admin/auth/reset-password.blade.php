@extends('layouts.admin.guest')

@section('title', 'Reset Password')

@section('content')

    <h3 class="mb-1 fw-bold">Reset Password 🔒</h3>
    <p class="mb-4">for <span class="fw-bold">{{ $request->email }}</span></p>
    <form id="submit" class="mb-3" action="{{ route('admin.password.store') }}" method="POST" data-redirect="{{ route('admin.login') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->token }}">
        <input type="hidden" name="email" value="{{ $request->email }}">
        <x-admin.password-form-group label="New Password" for="password" />
        <x-admin.password-form-group label="Confirm Password" for="password_confirmation" />

        <x-admin.submit-button text="Set new password" class="w-100 mb-3" />

        <div class="text-center mt-2">
            <a href="{{ route('admin.login') }}">
                <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                Back to login
            </a>
        </div>
    </form>
@endsection
