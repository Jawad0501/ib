<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title'           => ['nullable', 'string', 'max:255'],
            'currency_text'   => ['nullable', 'string', 'max:10'],
            'currency_symbol' => ['nullable', 'string', 'max:10'],
            'logo'            => ['nullable', 'image', 'mimes:png,jpg,jpeg,bmp,svg,webp', 'max:1024'],
            'favicon'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,bmp,svg,webp', 'max:1024'],
            'default_image'   => ['nullable', 'image', 'mimes:png,jpg,jpeg,bmp,svg,webp', 'max:1024'],
            'mailer'          => ['nullable', 'string', 'max:10'],
            'host'            => ['nullable', 'string', 'max:255'],
            'port'            => ['nullable', 'string', 'max:10'],
            'username'        => ['nullable', 'string', 'max:255'],
            'password'        => ['nullable', 'string', 'max:255'],
            'encryption'      => ['nullable', 'string', 'max:5'],
            'from_address'    => ['nullable', 'string', 'max:255'],
            'from_name'       => ['nullable', 'string', 'max:255'],
        ];
    }
}
