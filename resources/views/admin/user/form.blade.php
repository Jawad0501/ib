<x-admin.modal
    :title="isset($user) ? 'Update User' : 'Add New User'"
    action="{{ isset($user) ? route('admin.user.update', $user->id) : route('admin.user.store') }}"
    :button="isset($user) ? 'Update' : 'Submit'" size="lg"
>
    @isset($user)
        @method('PUT')
    @endisset

    @if (request()->has('add_from_inside'))
        <input type="hidden" name="add_from_inside" value="{{ true }}">
    @endif

    <x-admin.form-group label="full name" name="name" id="name" placeholder="Enter Full Name" :value="$user->name ?? ''" column="col-xl-6" />
    <x-admin.form-group label="email" type="email" placeholder="Enter Email" :value="$user->email ?? ''" column="col-xl-6" />
    <x-admin.form-group label="company_name" placeholder="Enter Company Name" :value="$user->company_name ?? ''" column="col-xl-6" />
    <x-admin.form-group label="telephone" placeholder="Enter Telephone" :value="$user->telephone ?? ''" column="col-xl-6" />

    <div class="col-12 mt-3">
        <h5>Office Address</h5>
        <hr/>
    </div>
    <x-admin.form-group label="address_Line_1" for="office_address[address_line_1]" placeholder="Address Line 1" :value="$user->office_address?->address_line_1 ?? null" column="col-12 mt-0" />
    <x-admin.form-group label="address_Line_2" for="office_address[address_line_2]" placeholder="Address Line 2" :value="$user->office_address?->address_line_2 ?? null" column="col-12" />
    <x-admin.form-group label="city" for="office_address[city]" placeholder="Enter City" :value="$user->office_address?->city ?? null" column="col-xl-6" />
    <x-admin.form-group label="state/Region" for="office_address[state]" placeholder="Enter State/Region" :value="$user->office_address?->state ?? null" column="col-xl-6" />
    <x-admin.form-group label="postcode" for="office_address[postcode]" placeholder="Enter Postcode" :value="$user->office_address?->postcode ?? null" column="col-xl-6" />
    <x-admin.form-group label="country" for="office_address[country]" placeholder="Enter Country" :value="$user->office_address?->country ?? null" column="col-xl-6" />

    @if(isset($user))
    <div class="col-12 mt-3">
        <h5>Delivery Address</h5>
        <hr/>
    </div>
    @else
    <div class="col-12 mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5>Delivery Address</h5>
            </div>
            <div class="d-flex align-items-center">
                <input type="checkbox" style="margin-right:4px" onchange="getOfficeAddress()" />
                <label for="equal_office" >Same as Office Address</label>
            </div>
        </div>

        <hr/>
    </div>
    @endif

    <x-admin.form-group label="address_Line_1" for="delivery_address[address_line_1]" placeholder="Address Line 1" :value="$user->delivery_address?->address_line_1 ?? null" column="col-12 mt-0" />
    <x-admin.form-group label="address_Line_2" for="delivery_address[address_line_2]" placeholder="Address Line 2" :value="$user->delivery_address?->address_line_2 ?? null" column="col-12" />
    <x-admin.form-group label="city" for="delivery_address[city]" placeholder="Enter City" :value="$user->delivery_address?->city ?? null" column="col-xl-6" />
    <x-admin.form-group label="state/Region" for="delivery_address[state]" placeholder="Enter State/Region" :value="$user->delivery_address?->state ?? null" column="col-xl-6" />
    <x-admin.form-group label="postcode" for="delivery_address[postcode]" placeholder="Enter Postcode" :value="$user->delivery_address?->postcode ?? null" column="col-xl-6" />
    <x-admin.form-group label="country" for="delivery_address[country]" placeholder="Enter Country" :value="$user->delivery_address?->country ?? null" column="col-xl-6" />

    <div class="col-12 mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5>Account Person</h5>
            </div>
            <div class="d-flex align-items-center">
                <input type="checkbox" style="margin-right:4px" onchange="getGivenUserInfo()" />
                <label for="equal_office" >Same as User Info Above</label>
            </div>
        </div>

        <hr/>
    </div>
    <x-admin.form-group label="account_Person_Name" name="account_person_name" id="account_person_name" placeholder="Enter Account Person Name" :value="$user->account_person->name ?? ''" column="col-xl-6 mt-0" />
    <x-admin.form-group label="account_Person_Email" name="account_person_email" id="account_person_email" type="email" placeholder="Enter Account Person Email" :value="$user->account_person->email ?? ''" column="col-xl-6 mt-0" />
    <x-admin.form-group label="account_Person_Telephone" name="account_person_telephone" id="account_person_telephone" placeholder="Enter Account Person Telephone" :value="$user->account_person->telephone ?? ''" column="col-xl-6 " />


    <x-admin.form-group label="VAT_number" name="vat_number" id="vat_number" placeholder="Enter VAT Number" :value="$user->vat_number ?? ''" column="col-xl-12 mt-3" />


</x-admin.modal>

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

    function getGivenUserInfo(){
        if(event.target.checked == true){

            let full_name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let telephone = document.getElementById('telephone').value;


            document.getElementById('account_person_name').value = full_name;
            document.getElementById('account_person_email').value =  email;
            document.getElementById('account_person_telephone').value = telephone;
        }
        else{

            document.getElementById('account_person_name').value = '';
            document.getElementById('account_person_email').value = '';
            document.getElementById('account_person_telephone').value = '';

        }
    }


</script>
