<?php

namespace Database\Seeders\Fees;

use App\Models\Fees\FeesGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeesGroupSeeder extends Seeder
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
                'name'        => 'Monthly fees',
                'description' => 'Fees Group Description. Lorem ipsum dolor sit amet et justo od 1',
            ],
            [
                'name'        => 'Exam fees',
                'description' => 'Fees Group Description. Lorem ipsum dolor sit amet et justo od 2',
            ],
        ];

        foreach ($items as $item) {
            $row               = new FeesGroup();
            $row->name         = $item['name'];
            $row->description  = $item['description'];
            $row->save();
        }
    }
}
