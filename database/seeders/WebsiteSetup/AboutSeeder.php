<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Upload;
use App\Models\WebsiteSetup\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Campus',
            'Graduation',
            'Achievement',
        ];
        $descriptions = [
            'The campus is a vibrant hub where students gather to learn, collaborate, and grow, with lectures, seminars, and events enriching the educational experience.',
            'Graduation marks a significant milestone in one’s academic journey – a moment of triumph, reflection, and anticipation, celebrating years of hard work, dedication, and perseverance.',
            'Achievement is the tangible result of setting goals, overcoming obstacles, and pushing boundaries, fueling motivation, instilling confidence, and inspiring others to aim higher.'
        ];
        $icons = [
            'frontend/img/about/icon_1.png',
            'frontend/img/about/icon_2.png',
            'frontend/img/about/icon_3.png',
        ];
        $images = [
            'frontend/img/about/01.png',
            'frontend/img/about/02.png',
            'frontend/img/about/03.png',
        ];
        foreach ($names as $key => $item) {
            $upload       = new Upload();
            $upload->path = $images[$key];
            $upload->save();

            $icon       = new Upload();
            $icon->path = $icons[$key];
            $icon->save();

            $row                 = new About();
            $row->name           = $item;
            $row->description    = $descriptions[$key];
            $row->upload_id      = $upload->id;
            $row->icon_upload_id = $icon->id;
            $row->serial         = $key;
            $row->save();
        }
    }
}
