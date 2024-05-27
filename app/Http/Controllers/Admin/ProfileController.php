<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('admin.profile.show');
    }

    /**
     * Show the form for editing the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit()
    {
        return view('admin.profile.edit');
    }

    /**
     * Update the resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $input = [
            'name'  => $request->name,
            'email' => $request->email,
            'image' => $request->hasFile('image') ? fileUpload($request->image, 'admin', $request->user()->image) : $request->user()->image
        ];

        $request->user()->fill($input)->save();

        return response()->json(['message' => translate('updated_message', ['text' => 'Profile'])]);
    }
}
