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
                'image'   => $uploads[0],
                'name'    => 'Maple Elementary School',
                'address' => '123 Maple Street, Anytown, USA',
            ],
            [
                'image'   => $uploads[1],
                'name'    => 'Oak Middle School',
                'address' => '456 Oak Avenue, Somewhereville, USA',
            ],
            [
                'image'   => $uploads[2],
                'name'    => 'Pine High School',
                'address' => '789 Pine Boulevard, Cityburg, USA',
            ],
            [
                'image'   => $uploads[3],
                'name'    => 'Cedar Academy',
                'address' => '101 Cedar Lane, Townsville, USA',
            ],
        ];

        foreach ($info as $value) {
            $row = new ContactInfo();
            $row->upload_id = $value['image'];
            $row->name = $value['name'];
            $row->address = $value['address'];
            $row->save();
        }
    }
}
