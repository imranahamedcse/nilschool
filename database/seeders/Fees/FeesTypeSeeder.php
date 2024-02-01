<?php

namespace Database\Seeders\Fees;

use App\Models\Fees\FeesType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeesTypeSeeder extends Seeder
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
                "name" => "Tuition Fee",
                "code" => "TF001",
                "description" => "Cost for academic instruction."
            ],
            [
                "name" => "Registration Fee",
                "code" => "RF002",
                "description" => "One-time fee for enrolling in the school."
            ],
            [
                "name" => "Book Fees",
                "code" => "BF003",
                "description" => "Cost for textbooks and learning materials."
            ],
            [
                "name" => "Uniform Fee",
                "code" => "UF004",
                "description" => "Cost for school uniforms."
            ],
            [
                "name" => "Extracurricular Activities Fee",
                "code" => "EAF005",
                "description" => "Cost for participating in extracurricular activities."
            ]
        ];

        foreach ($items as $item) {

            FeesType::create([
                'name'        => $item['name'],
                'code'        => $item['code'],
                'description' => $item['description'],
            ]);
        }
    }
}
