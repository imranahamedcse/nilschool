<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Counter;
use App\Models\Upload;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Curriculum',
            'Students',
            'Expert Teachers',
            'User',
            'Parents',
        ];
        $images = [
            'frontend/img/counters/01.webp',
            'frontend/img/counters/02.webp',
            'frontend/img/counters/03.webp',
            'frontend/img/counters/04.webp',
            'frontend/img/counters/05.webp',
        ];
        foreach ($names as $key=>$item) {
            $upload = new Upload();
            $upload->path = $images[$key];
            $upload->save();

            $row = new Counter();
            $row->name = $item;
            $row->total_count = 45*$key;
            $row->upload_id = $upload->id;
            $row->serial = $key;
            $row->save();
        }
    }
}
