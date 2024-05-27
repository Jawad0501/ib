<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $methodRule = $this->isMethod('POST') ? 'unique:roles,name' : 'unique:roles,name,'.$this->route('role')->id;
        return [
            'name'          => 'required|string|max:255|'.$methodRule,
            'permissions'   => 'required|array',
            'permissions.*' => 'string|exists:permissions,slug'
        ];
    }

    /**
     * Update or store current requested data
     *
     */
    public function saved(?Role $role = null) : bool
    {
        $input = [
            'name' => $this->name,
            'slug' => generate_slug($this->name),
            'permissions' => $this->permissions
        ];
        $this->isMethod('POST') ? Role::query()->create($input) : $role->update($input);

        return true;
    }
}
