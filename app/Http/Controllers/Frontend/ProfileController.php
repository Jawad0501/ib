<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /**
     * Display the resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        return view('frontend.profile.edit');
    }

    /**
     * Update the resource in storage.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $data = $request->validated();
        $data['avatar'] = $request->hasFile('avatar') ? fileUpload($request->file('avatar'), 'user', auth()->user()->avatar) : auth()->user()->avatar;

        $request->user()->fill($data);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        return response()->json(['message' => 'Profile updated successfully']);
    }
}
