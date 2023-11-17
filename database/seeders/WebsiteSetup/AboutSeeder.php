<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Upload;
use App\Models\WebsiteSetup\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'Special Campus Tour',
            'Graduation',
            'Powerful Alumni',
        ];
        $descriptions = [
            'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. enim velit mollit. Exercitation veniam consequat sunt nostrud amet. enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Exercitation veniam consequat sunt nostrud amet. enim velit mollit. Exercitation veniam consequat sunt nostrud amet.',
            'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. enim velit mollit. Exercitation veniam consequat sunt nostrud amet. enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Exercitation veniam consequat sunt nostrud amet. enim velit mollit. Exercitation veniam consequat sunt nostrud amet.',
            'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. enim velit mollit. Exercitation veniam consequat sunt nostrud amet. enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Exercitation veniam consequat sunt nostrud amet. enim velit mollit. Exercitation veniam consequat sunt nostrud amet.',
        ];
        $icons = [
            'frontend/img/about-gallery/icon_1.webp',
            'frontend/img/about-gallery/icon_2.webp',
            'frontend/img/about-gallery/icon_3.webp',
        ];
        $images = [
            'frontend/img/about-gallery/1.webp',
            'frontend/img/about-gallery/2.webp',
            'frontend/img/about-gallery/3.webp',
        ];
        foreach ($names as $key=>$item) {
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
