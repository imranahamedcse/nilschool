<?php

namespace Database\Seeders\Settings;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use App\Traits\CommonHelperTrait;

class SettingSeeder extends Seeder
{
    use CommonHelperTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'application_name',
            'value' => 'nilSchool',
        ]);
        Setting::create([
            'name' => 'address',
            'value' => '123 Main Street, Cityville, State, ZIP',
        ]);
        Setting::create([
            'name' => 'latest_news',
            'value' => 'Admissions open - 30% off!',
        ]);
        Setting::create([
            'name' => 'phone',
            'value' => '+1 (555) 123-4567',
        ]);
        Setting::create([
            'name' => 'email',
            'value' => 'nilschool@info.com',
        ]);
        Setting::create([
            'name' => 'school_about',
            'value' => 'Welcome to nilSchool! We are dedicated to providing quality education and fostering a positive learning environment for our students. Our committed team of educators is passionate about helping students succeed academically and grow into responsible individuals.',
        ]);
        Setting::create([
            'name' => 'footer_text',
            'value' => '© 2024 nilSchool. All rights reserved.',
        ]);
        Setting::create([
            'name' => 'mail_drive',
            'value' => 'smtp',
        ]);
        Setting::create([
            'name' => 'mail_host',
            'value' => 'smtp.gmail.com',
        ]);
        Setting::create([
            'name' => 'mail_address',
            'value' => 'nilschool@info.com',
        ]);
        Setting::create([
            'name' => 'from_name',
            'value' => 'nilSchool',
        ]);
        Setting::create([
            'name' => 'mail_username',
            'value' => 'nilschool@info.com',
        ]);

        $mail_password = Crypt::encrypt('ya!@a+TIY^&)$&esT');
        Setting::create([
            'name' => 'mail_password',
            'value' => $mail_password,
        ]);

        Setting::create([
            'name' => 'mail_port',
            'value' => '587',
        ]);
        Setting::create([
            'name' => 'encryption',
            'value' => 'tls',
        ]);
        Setting::create([
            'name' => 'default_langauge',
            'value' => 'en',
        ]);
        Setting::create([
            'name' => 'light_logo',
            'value' => 'backend/uploads/settings/light.png',
        ]);
        Setting::create([
            'name' => 'dark_logo',
            'value' => 'backend/uploads/settings/dark.png',
        ]);
        Setting::create([
            'name' => 'favicon',
            'value' => 'backend/uploads/settings/favicon.png',
        ]);
        Setting::create([
            'name' => 'session',
            'value' => 1,
        ]);
        Setting::create([
            'name' => 'currency_code',
            'value' => 'USD',
        ]);
    }
}
