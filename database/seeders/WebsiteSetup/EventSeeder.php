<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\Event;
use App\Models\Upload;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'Meet the Teacher',
            'Trunk or Treat',
            'Family Feast',
            'Camp Read Away ',
            'Winter Art Contest',
            'Holidays Around the World',
            'Graduation Celebration',
            'Pie a Teacher',
            'Career Day',
            'Teacher vs. Student Competition'
        ];
        $descriptions = [
            'A classic and fan favorite! In the cafeteria or auditorium, each grade level sets up a table to meet and greet their upcoming students and families. The tables can be decorated and small gifts such as pencils or snacks can be passed out. This is a great way for teachers to make a great first impression and for students to be less inclined to get those first day of school jitters.',

            'Happening the week of Halloween, this can be a great alternative to a typical party and also allows students to celebrate outside of standard trick or treating (which we all know can be disastrous if landing on a school night). Parents and volunteers decorate the trunks of their cars and park in a circle around the parking lot. At the end of the day, students walk from car to car and collect candy and other treats. This is a great opportunity for members of the community to get involved and spend a little extra time with their kids! ',

            'This typically falls the week before Thanksgiving Break and is a great opportunity for families to join their children and teachers for a gratitude-centered meal. The feast can be donated from the community, made in-house, or a potluck depending on your school community! If you are looking for an easy way to get parents more involved in your classroom or school in general, this is the perfect place to start. ',

            'Searching for a way to bring the great outdoors into the four walls of your classroom? This may be it! Teachers ask families to send in sheets, blankets, and flashlights. In partners, students work to create the best reading fort they can imagine. Then, lights out! For the rest of the time, students flashlight read independently or with a buddy. S’mores and other campfire friendly snacks can be provided as well, but are not necessary to make this a fun and exciting experience.',

            'This is a great event for either the whole school or individual grade levels that have multiple classrooms. Teachers decide on a winter themed muse and have students create their own interpretation of it. Once all artwork is complete, students submit their masterpieces for voting. In order to make it fair, different grade levels or classrooms would vote on each others’ to avoid favoritism and give everyone a fair shot! Categories for voting could include most unique, most creative, the cutest, etc. and the winners could receive a virtual prize. ',

            'This event is best held by individual grade levels to ensure there is adequate time in the schedule to fully enjoy the experience. Every classroom on a grade level picks a country that has a unique holiday tradition or celebration. Examples include Israel, Germany, England, Mexico, etc. The teacher in charge of each country plans a quick read-a-loud or video to teach the students about the tradition and its importance, as well as a craft activity. The students then spend the day rotating to each country to learn and experience cultures and fun traditions unlike their own. ',

            'Celebrated each year on March 2nd, Read Across America Day was first established as a way to celebrate Dr. Suess’s birthday. Today, its main purpose is to motivate and help children become aware and celebrate good reading habits. Students from similar or different classrooms and grade levels are partnered up to buddy read and share in their love of reading. ',

            'This is a take on the classic field day event that students across all grade levels typically participate in each year. Instead of the average activities such as a cakewalk or relay race, students are challenged across all areas of STEM! This event could include activities such as a paper plate marble race, clothespin geometry, paper airplane challenge, or an array of engineering building challenges. The opportunities are endless and this event will get your kids involved in the many aspects of STEM-based fun.',

            'Elementary and Middle Schools arrange with their affiliate or nearby high school an event where soon-to-be graduates visit the school and take part in a parade. The graduates wear their gowns or college apparel and stroll through the music-filled hallways to be celebrated as well as get younger students thinking and excited about their own futures. Students lining the hallways are encouraged to wear apparel from their favorite university and cheer as the graduates parade through.',

            'This event is the perfect class or school wide incentive, especially if they have a favorite teacher they would like to surprise with a splat! Once classes or grade levels reach their predetermined goal, a teacher is selected to get pied in the face in front of the whole student body. Maybe not the most fun for the targeted teacher, but a memorable experience for everyone else! '
        ];
        
        foreach ($titels as $key => $value) {
            $upload       = new Upload();
            $upload->path = 'frontend/img/event/'.$key.'.webp';
            $upload->save();

            $row = new Event();
            $row->session_id  = setting('session');
            $row->title       = $value;
            $row->description = $descriptions[$key];
            $row->date        = date("Y-m-d", strtotime("+ ".$key." day"));
            $row->start_time  = date('H:m:s');
            $row->end_time    = date('H:m:s');
            $row->upload_id   = $upload->id;
            $row->address     = 'Resemont Tower, House 148, Road 13/B, Block E Banani Dhaka 1213.';
            $row->save();
        }
    }
}
