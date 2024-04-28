<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Counter;
use App\Models\Upload;
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
            'Teachers',
            'User',
        ];
        $images = [
            'frontend/img/counter/01.png',
            'frontend/img/counter/02.png',
            'frontend/img/counter/03.png',
            'frontend/img/counter/04.png',
        ];
        foreach ($names as $key => $item) {
            $upload = new Upload();
            $upload->path = $images[$key];
            $upload->save();

            $row = new Counter();
            $row->name = $item;
            $row->total_count = 45 * ++$key;
            $row->upload_id = $upload->id;
            $row->serial = $key;
            $row->save();
        }
    }
}
