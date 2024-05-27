@extends('layouts.admin.app')

@section('title', 'Update Settings')
@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')
    <x-admin.page title="Update Settings">

        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-general" aria-controls="navs-general" aria-selected="true">
                            <i class="tf-icons ti ti-home ti-xs me-1"></i>
                            Home
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-file" aria-controls="navs-file" aria-selected="false" tabindex="-1">
                            <i class="tf-icons ti ti-file ti-xs me-1"></i>
                            File
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-email" aria-controls="navs-email" aria-selected="false" tabindex="-1">
                            <i class="tf-icons ti ti-email ti-xs me-1"></i>
                            SMTP
                        </button>
                    </li>
                </ul>
                <form id="submit" action="{{ route('admin.setting.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-general" role="tabpanel">
                            <div class="row gy-2">
                                <x-admin.form-group label="title" :value="getSetting('title')" placeholder="Enter title" column="col-lg-6" />
                                <x-admin.form-group label="email" :value="getSetting('email')" placeholder="Enter email" column="col-lg-6" />
                                <x-admin.form-group label="phone" :value="getSetting('phone')" placeholder="Enter phone" column="col-lg-6" />
                                <x-admin.form-group label="currency_text" :value="getSetting('currency_text')" placeholder="Enter currency text" column="col-lg-6" />
                                <x-admin.form-group label="currency_symbol" :value="getSetting('currency_symbol')" placeholder="Enter currency symbol" column="col-lg-6" />
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-file" role="tabpanel">
                            <div class="row gy-2">
                                @php
                                    $items = [
                                        'logo'    => getSetting('logo'),
                                        'favicon' => getSetting('favicon'),
                                        'default_image' => getSetting('default_image'),
                                    ];
                                @endphp

                                @foreach ($items as $key => $item)
                                    @php
                                        $label = match ($key) {
                                            'logo'          => 'Logo',
                                            'favicon'       => 'Favicon',
                                            'default_image' => 'Defalt Image'
                                        };
                                    @endphp
                                    <div class="col-md-6 col-xl-3">
                                        <label for="{{ $key }}" class="mb-2 text-capitalize">{{ $label }}</label>
                                        <div class="card shadow border-0">
                                            <div class="card-body">
                                                <img src="{{ uploadedFile($item) }}" class="img-fluid" id="{{ $key }}" />
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <input type="file" name="{{ $key }}" id="{{ $key }}" data-show-image="{{ $key }}" accept="image/*" class="form-control" />
                                            <div class="invalid-feedback" id="invalid_{{ $key }}"></div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-email" role="tabpanel">
                            <div class="row gy-2">

                                <div class="col-6">
                                    <label for="mailer" class="form-label">Mailer</label>
                                    <input type="text" id="mailer" name="mailer" class="form-control" value="{{config('mail.mailers.smtp.transport')}}">
                                </div>

                                <div class="col-6">
                                    <label for="host" class="form-label">Host</label>
                                    <input type="text" id="host" name="host" class="form-control" value="{{config('mail.mailers.smtp.host')}}">
                                </div>

                            </div>

                            <div class="row gy-3">

                                <div class="col-6">
                                    <label for="port" class="form-label">Port</label>
                                    <input type="text" id="port" name="port" class="form-control" value="{{config('mail.mailers.smtp.port')}}">
                                </div>

                                <div class="col-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" value="{{config('mail.mailers.smtp.username')}}">
                                </div>

                            </div>

                            <div class="row gy-3">

                                <div class="col-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" id="password" name="password" class="form-control" value="{{config('mail.mailers.smtp.password')}}">
                                </div>

                                <div class="col-6">
                                    <label for="encryption" class="form-label">Encryption</label>
                                    <input type="text" id="encryption" name="encryption" class="form-control" value="{{config('mail.mailers.smtp.encryption')}}">
                                </div>

                            </div>

                            <div class="row gy-3">

                                <div class="col-6">
                                    <label for="from_address" class="form-label">From Address</label>
                                    <input type="email" id="from_address" name="from_address" class="form-control" value="{{config('mail.from.address')}}">
                                </div>

                                <div class="col-6">
                                    <label for="from_name" class="form-label">From Name</label>
                                    <input type="text" id="from_name" name="from_name" class="form-control" value="{{config('mail.from.name')}}">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <x-admin.submit-button />
                    </div>
                </form>
            </div>
        </div>
    </x-admin.page>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
