<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Slider;
use App\Models\Upload;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Let’s Build Your Future With Onest Shooled 1',
            'Let’s Build Your Future With Onest Shooled 2',
            'Let’s Build Your Future With Onest Shooled 3',
        ];
        $descriptions = [
            'Wonderful environment where children undertakes laborious physical learn and grow. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sin 1.',
            'Wonderful environment where children undertakes laborious physical learn and grow. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sin 2.',
            'Wonderful environment where children undertakes laborious physical learn and grow. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sin 3.',
        ];
        $images = [
            'frontend/img/sliders/03.webp',
            'frontend/img/sliders/02.webp',
            'frontend/img/sliders/01.webp',
        ];
        foreach ($names as $key=>$item) {
            $upload = new Upload();
            $upload->path = $images[$key];
            $upload->save();

            $row = new Slider();
            $row->name = $item;
            $row->description = $descriptions[$key];
            $row->upload_id = $upload->id;
            $row->serial = $key;
            $row->save();
        }
    }
}
