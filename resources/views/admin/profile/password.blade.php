@extends('layouts.admin.app')

@section('title', 'Update Password')

@section('content')
    <x-admin.page :title="'Update Password'" column="col-lg-6 mx-auto">
        <form id="submit" action="{{ route('admin.password.update') }}" data-redirect="{{ route('admin.login') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row gy-1">
                <x-admin.form-group
                    label="current_password"
                    type="password"
                    placeholder="Enter current password"
                />
                <x-admin.form-group
                    label="password"
                    type="password"
                    placeholder="Enter password"
                />
                <x-admin.form-group
                    label="confirm_password"
                    type="password"
                    for="password_confirmation"
                    placeholder="Enter confirm password"
                />

                <div class="col-12 text-end mt-4">
                    <x-admin.submit-button text="Update" />
                </div>
            </div>
        </form>
    </x-admin.page>
@endsection
