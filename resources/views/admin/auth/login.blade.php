@extends('layouts.admin.guest')

@section('title', 'Login')

@section('content')
    <h4 class="card-title mb-1">Welcome to {{ config('app.name') }}! 👋</h4>
    <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>

    <form id="submit" class="auth-login-form mt-2" action="{{ route('admin.login') }}" method="POST" data-redirect="{{ route('admin.dashboard') }}">
        @csrf
        <x-admin.form-group
            label="email"
            type="email"
            placeholder="Enter your email or username"
            column="mb-3"
            value=""
        />

        <div class="mb-1">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="{{ route('admin.password.request') }}">
                    <small>Forgot Password?</small>
                </a>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge" id="password"
                    name="password" tabindex="2"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                    value=""
                />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
        </div>
        <div class="mb-1">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" tabindex="3" />
                <label class="form-check-label" for="remember-me"> Remember Me </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100" tabindex="4">Sign in</button>
    </form>
@endsection
