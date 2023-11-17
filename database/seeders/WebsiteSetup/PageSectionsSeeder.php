<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Upload;
use App\Models\WebsiteSetup\PageSections;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $images = [
            'frontend/img/accreditation/accreditation.webp',
            'frontend/img/banner/cta_bg.webp',
            'frontend/img/explore/1.webp',
            'frontend/img/icon/1.svg',
            'frontend/img/icon/2.svg',
            'frontend/img/icon/3.svg',
        ];

        $uploads = [];
        foreach ($images as $key => $value) {
            $row = new Upload();
            $row->path = $value;
            $row->save();

            $uploads[] = $row->id;
        }


        $data = [
            [
                'key'         => 'social_links',
                'name'        => '',
                'description' => '',
                'upload_id'   => null,
                'data'        => [
                    [
                        'name' => 'Facebook',
                        'icon' => 'fab fa-facebook-f',
                        'link' => 'http://www.facebook.com'
                    ],
                    [
                        'name' => 'Twitter',
                        'icon' => 'fab fa-twitter',
                        'link' => 'http://www.twitter.com'
                    ],
                    [
                        'name' => 'Pinterest',
                        'icon' => 'fab fa-pinterest-p',
                        'link' => 'http://www.pinterest.com',
                    ],
                    [
                        'name' => 'Instagram',
                        'icon' => 'fab fa-instagram',
                        'link' => 'http://www.instagram.com',
                    ]
                ],
            ],
            [
                'key'         => 'statement',
                'name'        => 'Statement Of Onest Schooleded',
                'description' => '',
                'upload_id'   => $uploads[0],
                'data'        => [
                    [
                        'title'       => 'Mission Statement',
                        'description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Read More',
                    ],
                    [
                        'title'       => 'Vision Statement',
                        'description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet Read More',
                    ],
                ],
            ],
            [
                'key'         => 'study_at',
                'name'        => 'Study at Onest Schooleded',
                'description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. veniam consequat sunt nostrud amet',
                'upload_id'   => $uploads[1],
                'data'        => [
                    [
                        'icon'        => $uploads[3],
                        'title'       => 'Out Prospects',
                        'description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. veniam consequat sunt nostrud amet',
                    ],
                    [
                        'icon'        => $uploads[4],
                        'title'       => 'Out Prospects',
                        'description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. veniam consequat sunt nostrud amet',
                    ],
                    [
                        'icon'        => $uploads[5],
                        'title'       => 'Out Prospects',
                        'description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. veniam consequat sunt nostrud amet',
                    ],
                ],
            ],
            [
                'key'         => 'explore',
                'name'        => 'Explore Onest Schoooled',
                'description' => '"We Educate Knowledge & Essential Skills" is a phrase that emphasizes the importance of both theoretical knowledge',
                'upload_id'   => $uploads[2],
                'data'        => [
                    [
                        'tab' => 'Campus Life',
                        'title' => 'Campus Life',
                        'description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud'
                    ],
                    [
                        'tab' => 'Academic',
                        'title' => 'Academic',
                        'description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud'
                    ],
                    [
                        'tab' => 'Athletics',
                        'title' => 'Athletics',
                        'description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud'
                    ],
                    [
                        'tab' => 'School',
                        'title' => 'School',
                        'description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud'
                    ],
                ],
            ],
            [
                'key'         => 'why_choose_us',
                'name'        => 'Excellence In Teaching And Learning',
                'description' => 'Welcomed every pain avoided but in certain circumstances owing obligations of business it will to the claims of duty or the obligations of business it will frequently occurs that pleasures. Provide Endless Opportunities',
                'upload_id'   => null,
                'data'        => [
                    'A higher education qualification',
                    'Better career prospects',
                    'Better career prospects',
                    'Better career prospects'
                ],
            ],
            [
                'key'         => 'academic_curriculum',
                'name'        => '20+ Academic Curriculum',
                'description' => 'Onsest Schooled is home to more than 20,000 students and 230,000 alumni with a wide variety of interests, ages and backgrounds, the University reflects the city’s dynamic mix of populations.',
                'upload_id'   => null,
                'data'        => [
                    'Bangal Medium',
                    'Bangal Medium',
                    'Bangal Medium',
                    'Bangal Medium',
                    'Bangal Medium',
                    'Bangal Medium',
                ],
            ],
            [
                'key'         => 'coming_up',
                'name'        => 'What’s Coming Up?',
                'description' => 'Welcomed every pain avoided but in certain circumstances owing obligations of business it will to the claims of duty or the obligation.',
                'upload_id'   => null,
                'data'        => [],
            ],
            [
                'key'         => 'news',
                'name'        => 'Latest From Our Blog',
                'description' => 'Welcomed every pain avoided but in certain circumstances owing obligations of business it will to the claims of duty or the obligation.',
                'upload_id'   => null,
                'data'        => [],
            ],
            [
                'key'         => 'our_gallery',
                'name'        => 'Our Gallery',
                'description' => 'Welcomed every pain avoided but in certain circumstances owing obligations of business it will to the claims of duty or the obligation.',
                'upload_id'   => null,
                'data'        => [],
            ],
            [
                'key'         => 'contact_information',
                'name'        => 'Find Our <br> Contact Information',
                'description' => '',
                'upload_id'   => null,
                'data'        => [],
            ],
            [
                'key'         => 'department_contact_information',
                'name'        => 'Contact By Department',
                'description' => 'Welcomed every pain avoided but in certain circumstances owing obligations of business it will to the claims of duty or the obligations of business it will',
                'upload_id'   => null,
                'data'        => [],
            ],
            [
                'key'         => 'our_teachers',
                'name'        => 'Our Featured Teachers',
                'description' => '',
                'upload_id'   => null,
                'data'        => [],
            ],
        ];


        foreach ($data as $key => $value){
            $row              = new PageSections();
            $row->key         = $value['key'];
            $row->name        = $value['name'];
            $row->description = $value['description'];
            $row->upload_id   = $value['upload_id'];
            $row->data        = $value['data'];
            $row->save();
        }
    }
}
