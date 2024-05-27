@extends('layouts.admin.app')

@section('title', 'Profile')

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset(mix('images/profile-banner.png')) }}" alt="Banner image" class="rounded-top img-fluid" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="{{ uploadedFile(auth()->user()->image) }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img " id="show_profile_image" width="100px" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ auth()->user()->name }}</h4>
                                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item"><i class="ti ti-user-plus"></i> Admin</li>
                                    <li class="list-inline-item"><i class="ti ti-mail"></i> {{ auth()->user()->email }}</li>
                                    {{-- <li class="list-inline-item"><i class="ti ti-calendar"></i> Joined April 2021</li> --}}
                                </ul>
                            </div>
                            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary" id="editBtn">
                                <i class="ti ti-edit me-1"></i>
                                Edit Your Account
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
