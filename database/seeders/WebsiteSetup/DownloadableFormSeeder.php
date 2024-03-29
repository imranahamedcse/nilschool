<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Upload;
use App\Models\WebsiteSetup\DownloadableForm;
use Illuminate\Database\Seeder;

class DownloadableFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Admission from',
            'Application for Subject Change',
            'Application for leave',
        ];

        $images = [
            'frontend/img/downloadable-form/admission from.pdf',
            'frontend/img/downloadable-form/application for subject change.pdf',
            'frontend/img/downloadable-form/application for leave.pdf',
        ];
        foreach ($names as $key=>$item) {
            $upload = new Upload();
            $upload->path = $images[$key];
            $upload->save();

            $row = new DownloadableForm();
            $row->name = $item;
            $row->upload_id = $upload->id;
            $row->serial = $key;
            $row->save();
        }
    }
}
