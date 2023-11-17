<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\GalleryCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Admission',
            'Annual Program',
            'Awards',
            'Curriculum'
        ];
        foreach ($names as $key=>$item) {
            $row = new GalleryCategory();
            $row->name = $item;
            $row->save();
        }
    }
}
