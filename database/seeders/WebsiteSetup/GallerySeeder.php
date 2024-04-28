<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Gallery;
use App\Models\Upload;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 12; $i++) {
            $upload = new Upload();
            $upload->path = 'frontend/img/gallery/' . $i . '.jpg';
            $upload->save();

            $row = new Gallery();
            $row->gallery_category_id  = rand(1, 4);
            $row->upload_id = $upload->id;
            $row->save();
        }
    }
}
