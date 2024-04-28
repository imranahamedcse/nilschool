<?php

namespace Database\Seeders\Academic;

use App\Models\Academic\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $items = [
            [
                'name' => 'English',
                'code' => '101',
                'type' => '1',
            ],
            [
                'name' => 'Math',
                'code' => '102',
                'type' => '1',
            ],
            [
                'name' => 'Physics',
                'code' => '103',
                'type' => '1',
            ],
            [
                'name' => 'Chemistry',
                'code' => '104',
                'type' => '1',
            ],
            [
                'name' => 'Biology',
                'code' => '105',
                'type' => '2',
            ]
        ];

        foreach ($items as $item) {
            $row = new Subject();
            $row->name = $item['name'];
            $row->code = $item['code'];
            $row->type = $item['type'];  // 1=theory or 2=practical
            $row->save();
        }
    }
}
