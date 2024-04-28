<?php

namespace Database\Seeders\Settings;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        Language::create([
            'name'       => 'English',
            'code'       => 'en',
            'icon_class' => 'flag-icon flag-icon-us',
            'direction'  =>'ltr'
        ]);

        Language::create([
            'name'       => 'Bangla',
            'code'       => 'bn',
            'icon_class' => 'flag-icon flag-icon-bd',
            'direction'  =>'ltr'
        ]);
    }
}
