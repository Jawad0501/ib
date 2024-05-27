<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['key' => 'title', 'value' => 'IB Software'],
            ['key' => 'email', 'value' => 'info@deepgreen.studio'],
            ['key' => 'phone', 'value' => '+44 20 7790 6101'],
            ['key' => 'logo', 'value' => 'setting/kgXmxSnUTJ59tWbq.png'],
            ['key' => 'auth_logo', 'value' => 'setting/sign-in.png'],
            ['key' => 'default_image', 'value' => 'setting/default_image.jpg'],
            ['key' => 'currency_text', 'value' => 'GBP'],
            ['key' => 'currency_symbol', 'value' => '£'],
            ['key' => 'favicon', 'value' => 'setting/kgXmxSnUTJ59tWbq.png'],
            ['key' => 'frontend_logo', 'value' => 'setting/logo.png'],
            ['key' => 'badge_logo', 'value' => 'setting/badge-logo.png'],
            ['key' => 'mailer', 'value' => ''],
            ['key' => 'host', 'value' => ''],
            ['key' => 'port', 'value' => ''],
            ['key' => 'username', 'value' => ''],
            ['key' => 'password', 'value' => ''],
            ['key' => 'from_address', 'value' => ''],
            ['key' => 'from_name', 'value' => ''],
        ];

        foreach ($settings as $setting) {
            updateSetting($setting['key'], $setting['value']);
        }
    }
}
