@extends('layouts.admin.app')

@section('title', isset($role) ? 'Update Role' : 'Add New Role')

@section('content')
    <x-admin.page :title="isset($role) ? 'Update Role' : 'Add New Role'">
        @can('create_role')
            <x-slot name="header">
                <x-admin.page-button :href="route('admin.role.index')" title="Back to Role List" icon="back" />
            </x-slot>
        @endcan

        <form id="submit" action="{{ isset($role) ? route('admin.role.update', $role->id) : route('admin.role.store') }}" data-redirect="{{ route('admin.role.index') }}">
            @csrf
            @isset($role)
                @method('PUT')
            @endisset
            <div class="row">
                <x-admin.form-group label="name" placeholder="Enter role name" :value="$role->name ?? ''" />

                <div class="col-12 mt-4">
                    <h5>Role Permissions</h5>
                    <!-- Permission table -->
                    <div class="table-responsive">
                        <table class="table table-flush-spacing">
                            <tbody>
                                <tr>
                                    <td class="text-nowrap fw-semibold">
                                        Administrator Access
                                        <i class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll" />
                                            <label class="form-check-label" for="selectAll"> Select All </label>
                                        </div>
                                    </td>
                                </tr>
                                @foreach ($modules as $module)
                                    <tr>
                                        <td class="text-nowrap fw-semibold">{{ $module->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @foreach ($module->permissions as $permission)
                                                    <div class="form-check me-3 me-lg-5 w-25">
                                                        <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]" id="permissions_{{ $permission->slug }}" value="{{ $permission->slug }}" @isset($role) @foreach($role->permissions as $rolePermission) @checked($permission->slug == $rolePermission) @endforeach @endisset />
                                                        <label class="form-check-label" for="permissions_{{ $permission->slug }}">{{ $permission->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Permission table -->
                </div>

                <div class="col-12 text-end mt-4">
                    <x-admin.submit-button :text="isset($role) ? 'Update':'Submit'" />
                </div>
            </div>
        </form>
    </x-admin.page>
@endsection


