<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'value' => 'Onest Schooled - School Management System',
        ]);
        Setting::create([
            'name' => 'address',
            'value' => 'Resemont Tower, House 148, Road 13/B, Block E Banani Dhaka 1213.',
        ]);
        Setting::create([
            'name' => 'phone',
            'value' => '+62 8787 8787',
        ]);
        Setting::create([
            'name' => 'email',
            'value' => 'onestschooled@gmail.com',
        ]);
        Setting::create([
            'name' => 'school_about',
            'value' => 'Lorem ipsum dolor sit amet consectetur. Morbi cras sodales elementum sed. Suspendisse adipiscing arcu magna leo sodales pellentesque. Ac iaculis mattis ornare rhoncus nibh mollis arcu.',
        ]);
        Setting::create([
            'name' => 'footer_text',
            'value' => '© 2023 Onest Schooled . All rights reserved.',
        ]);
        Setting::create([
            'name' => 'file_system',
            'value' => 'local',
        ]);
        Setting::create([
            'name' => 'aws_access_key_id',
            'value' => 'AKIA3OGN2RWSJOR5UOTK',
        ]);
        Setting::create([
            'name' => 'aws_secret_key',
            'value' => 'Vz18p5ELHI6BP9K7iZAzduu+sQCD/KkvbAwElmfX',
        ]);
        Setting::create([
            'name' => 'aws_region',
            'value' => 'ap-southeast-1',
        ]);
        Setting::create([
            'name' => 'aws_bucket',
            'value' => 'onestschool',
        ]);
        Setting::create([
            'name' => 'aws_endpoint',
            'value' => 'https://s3.ap-southeast-1.amazonaws.com',
        ]);
        Setting::create([
            'name' => 'recaptcha_sitekey',
            'value' => '6Lfn6nQhAAAAAKYauxvLddLtcqSn1yqn-HRn_CbN',
        ]);
        Setting::create([
            'name' => 'recaptcha_secret',
            'value' => '6Lfn6nQhAAAAABOzRtEjhZYB49Dd4orv41thfh02',
        ]);
        Setting::create([
            'name' => 'recaptcha_status',
            'value' => '0',
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
            'value' => 'sales@onesttech.com',
        ]);
        Setting::create([
            'name' => 'from_name',
            'value' => 'Onest Schooled - School Management System',
        ]);
        Setting::create([
            'name' => 'mail_username',
            'value' => 'sales@onesttech.com',
        ]);

        // pass
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
