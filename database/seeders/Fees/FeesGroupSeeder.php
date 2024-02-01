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
                "title" => "Tuition Fee",
                "description" => "Cost for academic instruction."
            ],
            [
                "title" => "Registration Fee",
                "description" => "One-time fee for enrolling in the school."
            ],
            [
                "title" => "Book Fees",
                "description" => "Cost for textbooks and learning materials."
            ],
            [
                "title" => "Uniform Fee",
                "description" => "Cost for school uniforms."
            ],
            [
                "title" => "Extracurricular Activities Fee",
                "description" => "Cost for participating in extracurricular activities."
            ]
        ];

        foreach ($items as $item) {
            $row               = new FeesGroup();
            $row->name         = $item['title'];
            $row->description  = $item['description'];
            $row->save();
        }
    }
}
