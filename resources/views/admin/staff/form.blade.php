<x-admin.modal
    :title="isset($staff) ? 'Update user' : 'Add New user'"
    :action="isset($staff) ? route('admin.staff.update', $staff->id) : route('admin.staff.store')"
    :button="isset($staff) ? 'Update' : 'Submit'"
>
    @isset($staff)
        @method('PUT')
    @endisset

    <x-admin.form-group label="role" isType="select" column="col-12">
        <option value="">Select role</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" @isset($staff) @selected($staff->role_id == $role->id) @endisset>{{ $role->name }}</option>
        @endforeach
    </x-admin.form-group>
    <x-admin.form-group label="name" placeholder="Enter name" :value="$staff->name ?? ''" column="col-12" />
    <x-admin.form-group label="email" type="email" placeholder="Enter email" :value="$staff->email ?? ''" column="col-12" />
    <x-admin.form-group label="phone" placeholder="Enter phone" :value="$staff->phone ?? ''" column="col-12" />
    @if (!isset($staff))
        <x-admin.form-group label="password" type="password" placeholder="Enter password" column="col-12" />
    @endif
</x-admin.modal>
