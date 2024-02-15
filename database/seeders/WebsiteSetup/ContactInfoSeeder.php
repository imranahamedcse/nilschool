<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Upload;
use App\Models\WebsiteSetup\ContactInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            'frontend/img/contact/01.jpg',
            'frontend/img/contact/02.jpg',
            'frontend/img/contact/03.jpg',
            'frontend/img/contact/04.jpg',
        ];

        $uploads = [];
        foreach ($images as $key => $value) {
            $row = new Upload();
            $row->path = $value;
            $row->save();

            $uploads[] = $row->id;
        }

        $info = [
            [
                'image' => $uploads[0],
                'name' => 'Our School',
                'address' => '222, Tower Building, Country Hall, California 777, United States',
            ],
            [
                'image' => $uploads[1],
                'name' => 'Our School',
                'address' => '222, Tower Building, Country Hall, California 777, United States',
            ],
            [
                'image' => $uploads[2],
                'name' => 'Our School',
                'address' => '222, Tower Building, Country Hall, California 777, United States',
            ],
            [
                'image' => $uploads[3],
                'name' => 'Our School',
                'address' => '222, Tower Building, Country Hall, California 777, United States',
            ],
        ];

        foreach ($info as $key => $value) {
            $row = new ContactInfo();
            $row->upload_id = $value['image'];
            $row->name = $value['name'];
            $row->address = $value['address'];
            $row->save();
        }
    }
}
