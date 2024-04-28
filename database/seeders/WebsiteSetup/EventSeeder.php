<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Event;
use App\Models\Upload;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titels = [
            'Teacher Meet and Greet',
            'Spooktacular Trunk or Treat',
            'Gratitude Gathering: Family Feast',
            'Camp Read Away: Indoor Adventure',
            'Winter Art Extravaganza',
            'Journey Through Cultures: Holidays Around the World',
            'Read Across America Day Celebration',
            'STEM-tastic Challenge Day',
            'Graduation Parade Celebration',
            'Teacher vs. Student Fun Competition'
        ];
        $descriptions = [
            'Experience a timeless tradition where teachers eagerly welcome upcoming students and families. Decorated tables, small gifts, and warm greetings await, setting the stage for a memorable start to the school year.',

            'Join us for a spooktacular celebration before Halloween! Trunk or Treat offers a safe and fun alternative to traditional trick-or-treating. Decorated car trunks filled with treats await eager students, creating a festive atmosphere for all to enjoy.',

            'Gather with your school family for a heartwarming feast of gratitude. Share in the joy of community as parents, children, and teachers come together to celebrate the spirit of Thanksgiving with a delicious meal.',

            "Embark on an indoor camping adventure like no other! Build reading forts with blankets and flashlights, then dive into the magical world of books under the twinkling lights. S'mores optional, but smiles guaranteed!",

            'Unleash your creativity at the Winter Art Contest! Students transform winter muses into stunning artworks, competing for titles like "Most Unique" and "Most Creative". Join us for a celebration of talent and imagination.',

            'Explore diverse cultures and holiday traditions at Holidays Around the World. Travel from classroom to classroom, learning about customs from Israel to Mexico. Immerse yourself in a day of global learning and fun.',

            'Celebrate the joy of reading on Read Across America Day! Buddy up with classmates and share your favorite stories, spreading the love of reading throughout the school community.',

            "Get ready for a STEM-tastic extravaganza! Engage in thrilling challenges like paper plate marble races and engineering competitions. It's a day of hands-on learning and excitement for all STEM enthusiasts.",

            'Join us for a memorable Graduation Celebration! High school graduates parade through the halls, inspiring younger students with visions of their bright futures. Wear your college gear and cheer on these future leaders!',

            "Gear up for some playful fun at the Teacher vs. Student Competition! Reach your goals and watch as a lucky teacher gets pied in the face. It's a hilarious and unforgettable event for everyone involved!"
        ];

        foreach ($titels as $key => $value) {
            $upload       = new Upload();
            $upload->path = 'frontend/img/event/' . $key . '.jpg';
            $upload->save();

            $row = new Event();
            $row->session_id  = setting('session');
            $row->title       = $value;
            $row->description = $descriptions[$key];
            $row->date        = date("Y-m-d", strtotime("+ " . $key . " day"));
            $row->start_time  = date('H:m:s');
            $row->end_time    = date('H:m:s');
            $row->upload_id   = $upload->id;
            $row->address     = 'Resemont Tower, House 148, Road 13/B, Block E Banani Dhaka 1213.';
            $row->save();
        }
    }
}
