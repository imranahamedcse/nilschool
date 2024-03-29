<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Slider;
use App\Models\Upload;
use App\Models\WebsiteSetup\FAQ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            'When does the session start and when do classes commence?',
            'When should I apply for my child\'s admission?',
            'What is the procedure for admission?',
        ];

        $answers = [
            "The academic session starts in July and classes commence either in July or August.",
            "Playgroup: Apply in September for the next academic session. Parents are advised to apply when the child is 2+ years old.Nursery to Class X: Apply in January for the next session.",
            "Once the application form is submitted it will be assessed in a pre-selection process. If selected, then the student and parents will be called for the admission test and/or interview (depending on the class in which you want to admit your child). After the test and/or interview either admission is offered, regretted or the names are placed on the waiting list if there are no vacancies.",
        ];
        
        foreach ($questions as $key=>$item) {
            $row = new FAQ();
            $row->question = $item;
            $row->answer = $answers[$key];
            $row->serial = $key;
            $row->save();
        }
    }
}
