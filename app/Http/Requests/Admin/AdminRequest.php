<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'role'     => ['required','integer','exists:roles,id'],
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','string','max:255', $this->isMethod('POST') ? 'unique:admins,email' : 'unique:admins,email,'.$this->route('staff')->id],
            'phone'    => ['required','string','max:255'],
            'password' => [$this->isMethod('POST') ? 'required' : 'nullable','min:8'],
        ];
    }

    /**
     * Update or store current requested data
     *
     */
    public function saved(?Admin $admin = null) : object
    {
        $input = $this->validated();
        $input['role_id'] = $this->role;

        if ($this->isMethod('POST')) {
            $admin = Admin::create(array_merge($input, [
                'password' => bcrypt($input['password']),
                'encrypted' => encrypt($input['password'])
            ]));
        }
        else {
            $admin->update($input);
        }
        return $admin;
    }
}
