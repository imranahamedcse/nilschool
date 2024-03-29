<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Upload;
use App\Models\WebsiteSetup\AcademicCalendar;
use Illuminate\Database\Seeder;

class AcademicCalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Academic Calendar 2024',
        ];

        $images = [
            'frontend/img/academic-calendar/calendar_2024.pdf',
        ];
        foreach ($names as $key=>$item) {
            $upload = new Upload();
            $upload->path = $images[$key];
            $upload->save();

            $row = new AcademicCalendar();
            $row->name = $item;
            $row->upload_id = $upload->id;
            $row->serial = $key;
            $row->save();
        }
    }
}
