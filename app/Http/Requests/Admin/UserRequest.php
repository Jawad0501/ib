<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'                      => ['required','string','max:255'],
            'email'                     => ['required','email','string','max:255', $this->isMethod('POST') ? 'unique:users,email' : 'unique:users,email,'.$this->route('user')->id],
            'company_name'              => ['required','string','max:255'],
            'designation'               => ['nullable', 'string', 'max:255'],
            'office_address'            => ['required', 'array'],
            'office_address.address_line_1'   => ['required', 'string', 'max:255'],
            'office_address.address_line_2'   => ['nullable', 'string', 'max:255'],
            'office_address.city'       => ['required', 'string', 'max:255'],
            'office_address.state'      => ['required', 'string', 'max:255'],
            'office_address.postcode'   => ['required', 'string', 'max:10'],
            'office_address.country'    => ['required', 'string', 'max:30'],
            'telephone'                 => ['nullable', 'string', 'max:255'],
            'delivery_address'          => ['required', 'array'],
            'delivery_address.address_line_1' => ['required', 'string', 'max:255'],
            'delivery_address.address_line_2' => ['nullable', 'string', 'max:255'],
            'delivery_address.city'     => ['required', 'string', 'max:255'],
            'delivery_address.state'    => ['required', 'string', 'max:255'],
            'delivery_address.postcode' => ['required', 'string', 'max:10'],
            'delivery_address.country'  => ['required', 'string', 'max:30'],
            'vat_number'                => ['nullable','string','max:255'],
            'account_person_name'       => ['required','string','max:255'],
            'account_person_email'      => ['required','email','string','max:255'],
            'account_person_telephone'  => ['nullable','string','max:255']
        ];
    }

    /**
     * Update or store current requested data
     *
     */
    public function saved(?User $user = null) : bool
    {
        $input = $this->validated();

        $input['account_person'] = [
            'name'      => $this->account_person_name,
            'email'     => $this->account_person_email,
            'telephone' => $this->account_person_telephone
        ];

        if ($this->isMethod('POST')) {

            User::create(array_merge($input, [
                'password' => bcrypt('12345678'),
            ]));
        }
        else {
            $user->update($input);
        }

        return true;
    }
}
