<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{

    /**
     * Show the form for editing the resource.
     *
     */
    public function edit()
    {
        $this->authorize('edit_setting');
        return view('admin.setting');
    }

    /**
     * Update the resource in storage.
     *
     * @param  \App\Http\Requests\Admin\SettingRequest  $request
     */
    public function update(SettingRequest $request)
    {
        $this->authorize('edit_setting');
        $fields = [
            'title'           => $request->title,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'currency_text'   => $request->currency_text,
            'currency_symbol' => $request->currency_symbol,
            'frontend_logo'   => $request->hasFile('logo') ? fileUpload($request->logo, 'setting', getSetting('frontend_logo')) : getSetting('frontend_logo'),
            'default_image'   => $request->hasFile('default_image') ? fileUpload($request->default_image, 'setting', getSetting('default_image')) : getSetting('default_image'),
            'favicon'         => $request->hasFile('favicon') ? fileUpload($request->favicon, 'setting', getSetting('favicon')) : getSetting('favicon'),
            'mailer'          => $request->mailer,
            'host'            => $request->host,
            'port'            => $request->port,
            'username'        => $request->username,
            'password'        => $request->password,
            'encryption'      => $request->encryption,
            'from_address'    => $request->from_address,
            'from_name'       => $request->from_name
        ];

        foreach ($fields as $key => $value) {
            updateSetting($key, $value);
        }

        Artisan::call('cache:clear');

        return response()->json(['message' => 'Settings updated successfully']);
    }
}
