<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'                      => ['required', 'string', 'max:255'],
            'email'                     => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'company_name'              => ['required', 'string', 'max:255'],
            'designation'               => ['nullable', 'string', 'max:255'],
            'office_address'            => ['required', 'array'],
            'office_address.address_line_1'   => ['required', 'string', 'max:255'],
            'office_address.address_line_2'   => ['nullable', 'string', 'max:255'],
            'office_address.city'       => ['required', 'string', 'max:255'],
            'office_address.state'      => ['required', 'string', 'max:255'],
            'office_address.postcode'   => ['required', 'string', 'max:20'],
            'office_address.country'    => ['required', 'string', 'max:100'],
            'telephone'                 => ['required', 'string', 'max:255'],
            'delivery_address'          => ['required', 'array'],
            'delivery_address.address_line_1' => ['required', 'string', 'max:255'],
            'delivery_address.address_line_2' => ['nullable', 'string', 'max:255'],
            'delivery_address.city'     => ['required', 'string', 'max:255'],
            'delivery_address.state'    => ['required', 'string', 'max:255'],
            'delivery_address.postcode' => ['required', 'string', 'max:20'],
            'delivery_address.country'  => ['required', 'string', 'max:100'],
            'vat_number'                => ['required', 'string', 'max:255'],
            'account_person_name'       => ['required', 'string', 'max:255'],
            'account_person_email'      => ['required', 'email', 'string', 'max:255'],
            'account_person_telephone'  => ['required', 'string', 'max:255'],
            'avatar'                    => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg']
        ];
    }
}
