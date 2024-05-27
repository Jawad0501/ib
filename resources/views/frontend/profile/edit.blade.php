@extends('layouts.frontend.app')

@section('title', 'Profile')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="fs-5 fw-semibold mb-4">My Profile</h5>
                </div>

                <div class="col-12">
                    <div class="card">
                        <form id="submit" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <div class="profile-pic-wrapper">
                                            <div class="pic-holder">
                                                <img id="profilePic" class="pic" src="{{ uploadedFile(auth()->user()->avatar) }}">
                                                <input class="uploadProfileInput" type="file" name="avatar" id="avatar" data-show-image="profilePic" accept="image/*" style="opacity: 0;" />
                                                <label for="avatar" class="upload-file-block">
                                                    <div class="text-center">
                                                        <div class="mb-2">
                                                            <i class="fa fa-camera fa-2x"></i>
                                                        </div>
                                                        <div class="text-uppercase">
                                                            Choice <br /> Profile Photo
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <x-frontend.form-group label="name" placeholder="Enter name" :value="auth()->user()->name" column="col-lg-6" />
                                    <x-frontend.form-group label="email" type="email" placeholder="Enter email" :value="auth()->user()->email" column="col-lg-6" />
                                    <x-frontend.form-group label="telephone" type="tel" placeholder="Enter telephone" :value="auth()->user()->telephone" column="col-lg-6" />
                                    <x-frontend.form-group label="company_name" placeholder="Enter company name" :value="auth()->user()->company_name" column="col-lg-6" />
                                    <x-frontend.form-group label="designation" placeholder="Enter designation" :value="auth()->user()->designation" column="col-lg-6" />

                                    <div class="col-12">
                                        <h5>Office Address</h5>
                                        <hr/>
                                    </div>
                                    {{-- <x-frontend.form-group label="location" for="office_address[location]" placeholder="Enter location" :value="auth()->user()->office_address->location" column="col-lg-6" /> --}}
                                    <x-admin.form-group label="address_Line_1" for="office_address[address_line_1]" placeholder="Address Line 1" :value="auth()->user()->office_address?->address_line_1 ?? null" column="col-12 mt-0" />
                                    <x-admin.form-group label="address_Line_2" for="office_address[address_line_2]" placeholder="Address Line 2" :value="auth()->user()->office_address?->address_line_2 ?? null" column="col-12" />
                                    <x-admin.form-group label="city" for="office_address[city]" placeholder="Enter City" :value="auth()->user()->office_address?->city ?? null" column="col-xl-6" />
                                    <x-admin.form-group label="state/Region" for="office_address[state]" placeholder="Enter State/Region" :value="auth()->user()->office_address?->state ?? null" column="col-xl-6" />
                                    <x-frontend.form-group label="postcode" for="office_address[postcode]" placeholder="Enter postcode" :value="auth()->user()->office_address->postcode" column="col-lg-6" />
                                    <x-frontend.form-group label="country" for="office_address[country]" placeholder="Enter country" :value="auth()->user()->office_address->country" column="col-lg-6" />


                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5>Delivery Address</h5>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" id="equal_office" name="equal_office" style="margin-right:4px" onchange="getOfficeAddress()" />
                                                <label for="equal_office" >Same as Office Address</label>
                                            </div>
                                        </div>
                                        <hr/>
                                    </div>
                                    {{-- <x-frontend.form-group label="location" for="delivery_address[location]" placeholder="Enter location" :value="auth()->user()->delivery_address->location" column="col-lg-6" /> --}}
                                    <x-admin.form-group label="address_Line_1" for="delivery_address[address_line_1]" placeholder="Address Line 1" :value="auth()->user()->delivery_address?->address_line_1 ?? null" column="col-12 mt-0" />
                                    <x-admin.form-group label="address_Line_2" for="delivery_address[address_line_2]" placeholder="Address Line 2" :value="auth()->user()->delivery_address?->address_line_2 ?? null" column="col-12" />
                                    <x-admin.form-group label="city" for="delivery_address[city]" placeholder="Enter City" :value="auth()->user()->delivery_address?->city ?? null" column="col-xl-6" />
                                    <x-admin.form-group label="state/Region" for="delivery_address[state]" placeholder="Enter State/Region" :value="auth()->user()->delivery_address?->state ?? null" column="col-xl-6" />
                                    <x-frontend.form-group label="postcode" for="delivery_address[postcode]" placeholder="Enter postcode" :value="auth()->user()->delivery_address->postcode" column="col-lg-6" />
                                    <x-frontend.form-group label="country" for="delivery_address[country]" placeholder="Enter country" :value="auth()->user()->delivery_address->country" column="col-lg-6" />

                                    <div class="col-12"></div>
                                    <x-frontend.form-group label="vat_number" placeholder="Enter vat number" :value="auth()->user()->vat_number" column="col-lg-6" />
                                    <x-frontend.form-group label="account_person_name" placeholder="Enter account person name" :value="auth()->user()->account_person->name ?? null" column="col-lg-6" />
                                    <x-frontend.form-group label="account_person_email" placeholder="Enter account person email" :value="auth()->user()->account_person->email ?? null" column="col-lg-6" />
                                    <x-frontend.form-group label="account_person_telephone" placeholder="Enter account person telephone" :value="auth()->user()->account_person->telephone ?? null" column="col-lg-6" />
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <x-frontend.submit-button label="Update" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function getOfficeAddress(){
            if(event.target.checked == true){

                let office_address_1 = document.getElementById('office_address[address_line_1]').value;
                let office_address_2 = document.getElementById('office_address[address_line_2]').value;
                let office_city = document.getElementById('office_address[city]').value;
                let office_state = document.getElementById('office_address[state]').value;
                let office_postcode = document.getElementById('office_address[postcode]').value;
                let office_country = document.getElementById('office_address[country]').value;


                document.getElementById('delivery_address[address_line_1]').value = office_address_1;
                document.getElementById('delivery_address[address_line_2]').value = office_address_2;
                document.getElementById('delivery_address[city]').value = office_city;
                document.getElementById('delivery_address[state]').value = office_state;
                document.getElementById('delivery_address[postcode]').value = office_postcode;
                document.getElementById('delivery_address[country]').value = office_country;
            }
            else{

                document.getElementById('delivery_address[address_line_1]').value = '';
                document.getElementById('delivery_address[address_line_2]').value = '';
                document.getElementById('delivery_address[city]').value = '';
                document.getElementById('delivery_address[state]').value = '';
                document.getElementById('delivery_address[postcode]').value = '';
                document.getElementById('delivery_address[country]').value = '';

            }
        }
    </script>

@endsection
