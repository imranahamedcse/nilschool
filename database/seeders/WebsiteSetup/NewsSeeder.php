<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\News;
use App\Models\Upload;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            'frontend/img/blog/01.png',
            'frontend/img/blog/02.png',
            'frontend/img/blog/03.png',
            'frontend/img/blog/04.png',
            'frontend/img/blog/05.png',
            'frontend/img/blog/06.png',
            'frontend/img/blog/07.png',
            'frontend/img/blog/08.png',
        ];
        foreach ($images as $key => $value) {

            $upload = new Upload();
            $upload->path = $value;
            $upload->save();

            $row = new News();
            $row->title = '20+ Academic Curriculum We Done!' . $key;
            $row->description = 'Onsest Schooled Is Home To More Than 20,000 Students And 230,000 Alumni With A Variety Of Interests, Ages And Backgrounds, The University Reflects The City’s Dynamic Mix Of Populations.';
            $row->date = date("Y-m-d", strtotime("- " . ++$key . " day"));
            $row->publish_date = date('Y-m-d');
            $row->upload_id = $upload->id;
            $row->save();
        }
    }
}
