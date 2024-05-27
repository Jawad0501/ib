<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request)
    {
        $this->authorize('show_permission');
        if(request()->ajax()) {
            return $this->datatableInitilize(Permission::query()->with('module:id,name')->select(['id', 'module_id','name']))->toJson();
        }

        return view('admin.permission.index');
    }
}
