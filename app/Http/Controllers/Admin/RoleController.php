<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Module;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->authorize('show_role');
        if(request()->ajax()) {
            return $this->datatableInitilize(Role::query()->select(['id','name','permissions']))->toJson();
        }

        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->authorize('create_role');
        $modules = Module::get();
        return view('admin.role.form', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleRequest  $request
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('create_role');
        $request->saved();
        return response()->json(['message' => translate('added_message', ['text' => 'role'])]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     */
    public function edit(Role $role)
    {
        $this->authorize('edit_role');
        $modules = Module::get();
        return view('admin.role.form', compact('modules', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleRequest  $request
     * @param  \App\Models\Role  $role
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('create_role');
        $request->saved($role);
        return response()->json(['message' => translate('updated_message', ['text' => 'Role'])]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete_role');
        $role->delete();
        return response()->json(['message' => translate('deleted_message', ['text' => 'Role'])]);
    }
}
