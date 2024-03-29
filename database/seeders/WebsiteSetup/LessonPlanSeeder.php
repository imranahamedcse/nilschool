<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Upload;
use App\Models\WebsiteSetup\LessonPlan;
use Illuminate\Database\Seeder;

class LessonPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Class One',
            'Class Two',
            'Class Three',
        ];

        $images = [
            'frontend/img/lesson-plan/class one.pdf',
            'frontend/img/lesson-plan/class two.pdf',
            'frontend/img/lesson-plan/class three.pdf',
        ];
        foreach ($names as $key=>$item) {
            $upload = new Upload();
            $upload->path = $images[$key];
            $upload->save();

            $row = new LessonPlan();
            $row->name = $item;
            $row->upload_id = $upload->id;
            $row->serial = $key;
            $row->save();
        }
    }
}
