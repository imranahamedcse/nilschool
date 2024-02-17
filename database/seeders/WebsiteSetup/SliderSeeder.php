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
            'Ignite Your Passion: nilSchool Fest 2024',
            'nilSchool Talent Showcase: Unleash Your Potential!',
            'Explore, Learn, Grow: nilSchool Science Fair',
        ];
        $descriptions = [
            'Join us for a day of excitement and exploration at the nilSchool Fest 2024! Experience a diverse range of activities, from thrilling performances to engaging workshops. Unleash your creativity and ignite your passion for learning!',
            'Calling all talented students! Showcase your skills and shine on stage at the nilSchool Talent Showcase. Whether you excel in music, dance, or drama, this is your chance to dazzle the audience and unleash your full potential!',
            'Calling all young scientists! Dive into the fascinating world of science at the nilSchool Science Fair. Explore innovative projects, conduct experiments, and discover the wonders of STEM education. Join us for a day of discovery and fun!',
        ];
        $images = [
            'frontend/img/sliders/01.jpg',
            'frontend/img/sliders/02.jpg',
            'frontend/img/sliders/03.jpg',
        ];
        foreach ($names as $key => $item) {
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
