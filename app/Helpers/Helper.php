<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Str;

if (!function_exists('setting')) {
    function setting()
    {
        $settings = Cache::get('settings');
        if (!$settings) {
            $settings = Setting::get(['key', 'value']);
            Cache::put('settings', $settings);
        }
        return $settings;
    }
}

if (!function_exists('getSetting')) {
    function getSetting($key)
    {
        $settings = Cache::get('settings');
        $setting = $settings->where('key', $key)->first();
        return $setting ? $setting->value : null;
    }
}

if (!function_exists('updateSetting')) {
    function updateSetting($key, $value)
    {
        Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        return true;
    }
}

if (! function_exists('store_log')) {
    function store_log($class, $data, $event)
    {
        $full_name = auth()->check() ? auth()->user()->name : 'Seeding';
        $description = match ($event) {
            'create' => "New $data $class Added By $full_name",
            'update' => "$data $class Edited By $full_name",
            'delete' => "$data $class Deleted By $full_name"
        };
        Log::channel('info')->info($description);
        return true;
    }
}

if (!function_exists('image_allowed_extensions')) {

    /**
     * image_allowed_extensions
     *
     * @return string
     */
    function image_allowed_extensions()
    {
        return 'mimes:jpg,jpeg,png,svg,gif,bmp,webp';
    }
}

if (!function_exists('translate')) {

    /**
     * translate
     *
     * @param  mixed $text
     * @param  mixed $vars
     * @return string
     */
    function translate($text, $vars = null)
    {
        return $vars !== null ? __("language.$text", $vars) : __("language.$text");
    }
}


if (!function_exists('generate_slug')) {
    /**
     * function generate unique slug
     *
     * @param  mixed $slug
     * @return string
     */
    function generate_slug($slug = null)
    {
        return $slug != null ? Str::slug($slug) : Str::random();
    }
}

if (!function_exists('fileUpload')) {

    /**
     * upload file
     *
     * @param  mixed $file
     * @param  mixed $folder
     * @param  mixed $current
     * @return boolean
     */
    function fileUpload($file, $folder, $current = null)
    {
        $the_file = $file->getClientOriginalName();

        $name = pathinfo($the_file, PATHINFO_FILENAME);
        $extension = pathinfo($the_file, PATHINFO_EXTENSION);

        $filename = $name . '-' . time() . '.' . $extension;

        if ($current != null) deleteUploadedFile($current);

        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        return $file->storeAs($folder, $filename, 'public');
    }
}

if (!function_exists('seeder_fileUpload')) {

    /**
     * upload file
     *
     * @param  string $fileName
     * @param  string $folder
     * @return string
     */
    function seeder_fileUpload($fileName, $folder)
    {
        $file = "$folder/$fileName";
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        \Illuminate\Support\Facades\File::copy(resource_path("images/$file"), storage_path("app/public/$file"));

        return $file;
    }
}

if (!function_exists('uploadedFile')) {

    /**
     * get uploaded file
     *
     * @param  mixed $file
     * @return string
     */
    function uploadedFile($file)
    {
        if ($file != null && Storage::disk('public')->exists($file)) {
            return Storage::disk('public')->url($file);
        }

        $default_image = getSetting('default_image');
        return Storage::disk('public')->url($default_image);
    }
}

if (!function_exists('deleteUploadedFile')) {

    /**
     * delete uploaded file
     *
     * @param  mixed $file
     * @return boolean
     */
    function deleteUploadedFile($file)
    {
        if ($file != null && Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
        }
        return true;
    }
}

if (!function_exists('convertAmount')) {
    /**
     * convertAmount
     */
    function convertAmount($amount, $symbol = true) : string
    {
        if($symbol) {
            return getSetting('currency_symbol').''. number_format($amount, 2, '.', ',');
        }
        return number_format($amount, 2, '.', ',');
    }
}

if (! function_exists('generate_invoice')) {
    /**
     * function generate unique invoice
     *
     * @param  mixed $invoice
     */
    function generate_invoice($id) : string
    {
        return 'IB'.sprintf("%s%05s", '', $id);
    }
}

if (! function_exists('generate_order_number')) {
    /**
     * function generate unique invoice
     *
     * @param  mixed $invoice
     */
    function generate_order_number($id) : string
    {
        return 'IBPO'.sprintf("%s%05s", '', $id);
    }
}

if (!function_exists('getTrx')) {
    function getTrx($length = 12) : string
    {
        $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('isAdminUrlRequest')) {
    function isAdminUrlRequest()
    {
        return request()->is('admin*');
    }
}

if (!function_exists('userWelcome')) {
    function userWelcome()
    {
        $hour   = date("G");
        $minute = date("i");
        $second = date("s");
        $msg    = "Today is " . date("l, M. d, Y.") . "And the time is " . date("g:i a");

        if ( (int)$hour == 0 && (int)$hour <= 9 ) {
            $greet = "Good Morning,";
        }
        else if ( (int)$hour >= 10 && (int)$hour <= 11 ) {
            $greet = "Good Day,";
        }
        else if ( (int)$hour >= 12 && (int)$hour <= 15 ) {
            $greet = "Good Afternoon,";
        }
        else if ( (int)$hour >= 16 && (int)$hour <= 23 ) {
            $greet = "Good Evening,";
        }
        else {
            $greet = "Welcome,";
        }

        return $greet;
        // return $greet.$msg;
    }
}


if (!function_exists('smtpConfig')) {
    function smtpConfig()
    {
        $setting = setting();
        $mailer = Cache::get('settings')->where('key', 'mailer')->firstOrFail();
        $host = Cache::get('settings')->where('key', 'host')->firstOrFail();
        $port = Cache::get('settings')->where('key', 'port')->firstOrFail();
        $username = Cache::get('settings')->where('key', 'username')->firstOrFail();
        $password = Cache::get('settings')->where('key', 'password')->firstOrFail();
        $encryption = Cache::get('settings')->where('key', 'encryption')->firstOrFail();
        $from_address = Cache::get('settings')->where('key', 'from_address')->firstOrFail();
        $from_name = Cache::get('settings')->where('key', 'from_name')->firstOrFail();



        Config::set('mail.mailers.smtp.transport', $mailer->value);
        Config::set('mail.mailers.smtp.host', $host->value);
        Config::set('mail.mailers.smtp.port', $port->value);
        Config::set('mail.mailers.smtp.username', $username->value);
        Config::set('mail.mailers.smtp.password', $password->value);
        Config::set('mail.mailers.smtp.encryption', $encryption->value);
        Config::set('mail.from.address', $from_address->value);
        Config::set('mail.from.name', $from_name->value);
    }
}

if (!function_exists('avatarText')) {
    function avatarText($value)
    {
        if(!empty($value)) {
            $data = '';
            foreach (explode(' ', $value) as $val) {
                $data .= mb_substr($val, 0, 1);
            }
        }
        return $data ?? $value;
    }
}

