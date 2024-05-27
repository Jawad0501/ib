<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Models\Quote;
use App\Models\UserUploadedFile;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->authorize('show_customer');
        if(request()->ajax()) {
            return $this->datatableInitilize(User::query()->select(['id','name','email','company_name','telephone','vat_number']))->toJson();
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->authorize('create_customer');
        if(request()->has('customer_get')) {
            return response()->json([
                'customers' => DB::table('users')->latest('id')->get(['id','name'])
            ]);
        }
        return view('admin.user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UserRequest  $request
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create_customer');

        $request->saved();

        return response()->json([
            'add_from_inside' =>$request->has('add_from_inside'),
            'message' => translate('added_message', ['text' => 'customer'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     */
    public function edit(User $user)
    {
        $this->authorize('edit_customer');
        return view('admin.user.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UserRequest  $request
     * @param  \App\Models\User  $user
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('edit_customer');
        $request->saved($user);

        return response()->json(['message' => translate('updated_message', ['text' => 'Customer'])]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     */
    public function destroy(User $user)
    {
        $this->authorize('delete_customer');
        $user->delete();

        return response()->json(['message' => translate('deleted_message', ['text' => 'Customer'])]);
    }

    public function showUserQuotes($id){
        $quotes = Quote::where('user_id', $id)->get();
        $sl_no = [];
        $i = 1;

        $quotes = Quote::where('user_id', $id)->get()->map(function($quote) use(&$i) {
            $quote->sl_no = $i;

            $i = $i + 1;

            return $quote;
        });

        return view('admin.user.user-quotes', compact('quotes', 'id'));
    }

    public function showUserFiles($id){
        $artworks = Quote::where('user_id', $id)->where('artwork', '!=', null)->get();
        $approval_files = Quote::where('user_id', $id)->where('approval_file', '!=', null)->get();
        $uploadedFiles = UserUploadedFile::where('user_id', $id)->get();

        return view('admin.user.files', compact('artworks', 'approval_files', 'uploadedFiles'));
    }
}
