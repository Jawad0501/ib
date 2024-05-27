<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewStaffMail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $this->authorize('show_user');
        if(request()->ajax()) {
            $admin = Admin::query()->with('role:id,name')->select(['id','role_id','name','email','phone']);
            return $this->datatableInitilize($admin)->toJson();
        }
        return view('admin.staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->authorize('create_user');
        $roles = DB::table('roles')->get(['id','name']);
        return view('admin.staff.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\AdminRequest  $request
     */
    public function store(AdminRequest $request)
    {
        $this->authorize('create_user');


        $user = $request->saved();

        Mail::to($user->email)->send(new NewStaffMail($user));

        return response()->json([
            'message' => translate('added_message', ['text' => 'user'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $staff
     */
    public function edit(Admin $staff)
    {
        $this->authorize('edit_user');
        $roles = DB::table('roles')->get(['id','name']);
        return view('admin.staff.form', compact('roles', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\AdminRequest  $request
     * @param  \App\Models\Admin  $staff
     */
    public function update(AdminRequest $request, Admin $staff)
    {
        $this->authorize('edit_user');
        $request->saved($staff);

        return response()->json([
            'message' => translate('updated_message', ['text' => 'User'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $staff
     */
    public function destroy(Admin $staff)
    {
        $this->authorize('delete_user');
        $staff->delete();
        return response()->json(['message' => translate('deleted_message', ['text' => 'User'])]);
    }
}
