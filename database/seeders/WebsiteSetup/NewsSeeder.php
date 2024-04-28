<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\News;
use App\Models\Upload;
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

        $items = [
            [
                'title'        => 'Mastering the Art of Blogging: Tips for Beginners',
                'description' => 'Are you new to the world of blogging? Discover essential tips and strategies to kickstart your blogging journey and captivate your audience from day one.'
            ],
            [
                'title'        => '10 Inspiring Ideas for Your Next Blog Post',
                'description' => 'Struggling to come up with fresh content ideas? Explore these 10 creative prompts to ignite your inspiration and create engaging blog posts that resonate with your readers.'
            ],
            [
                'title'        => 'The Power of Visuals: How to Enhance Your Blog with Images',
                'description' => 'Learn how to leverage the power of visuals to elevate your blog content. From selecting the perfect images to optimizing their impact, discover tips for enhancing your blog with compelling visuals.'
            ],
            [
                'title'        => 'SEO Essentials: Boosting Your Blog\'s Visibility on Search Engines',
                'description' => 'Unlock the secrets of search engine optimization (SEO) and improve your blog\'s visibility on Google and other search engines. Explore essential strategies and best practices for maximizing organic traffic to your blog.'
            ],
            [
                'title'        => 'Writing Engaging Headlines: The Key to Grabbing Your Audience\'s Attention',
                'description' => 'Crafting compelling headlines is crucial for capturing your audience\'s attention and enticing them to read your blog posts. Discover proven techniques for writing attention-grabbing headlines that drive clicks and engagement.'
            ],
            [
                'title'        => 'Building a Community: Fostering Engagement on Your Blog',
                'description' => 'Create a thriving community around your blog by fostering meaningful engagement with your audience. Explore strategies for building rapport, encouraging discussion, and cultivating a loyal following.'
            ],
            [
                'title'        => 'Monetization Methods: Turning Your Blog into a Profitable Venture',
                'description' => 'Ready to monetize your blog and turn your passion into profit? Explore various monetization methods, from affiliate marketing to sponsored content, and learn how to generate revenue from your blog.'
            ],
            [
                'title'        => 'Navigating the Blogosphere: Networking Tips for Bloggers',
                'description' => 'Forge valuable connections within the blogging community and expand your reach by mastering the art of networking. Discover effective networking tips and strategies for establishing mutually beneficial relationships with fellow bloggers.'
            ]
        ];

        foreach ($images as $key => $value) {

            $upload       = new Upload();
            $upload->path = $value;
            $upload->save();

            $row               = new News();
            $row->title        = $items[$key]['title'];
            $row->description  = $items[$key]['description'];
            $row->date         = date("Y-m-d", strtotime("- " . ++$key . " day"));
            $row->publish_date = date('Y-m-d');
            $row->upload_id    = $upload->id;
            $row->save();
        }
    }
}
