<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\WebsiteSetup\Academic;
use Illuminate\Database\Seeder;

class AcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page_names = [
            'Academic',
            'Academic Calendar',
            'Our Curriculum',
            'Facilities',
            'Management',
            'Services & Supports',
            'Syllabus',
        ];
        $titles = [
            'Academic',
            'Academic Calendar',
            'Our Curriculum',
            'Facilities',
            'Management',
            'Services & Supports',
            'Syllabus',
        ];

        $descriptions = [
            '<p>Vista School is one of the largest private English-medium schools in Bangladesh, offering pre-school to A\' Level classes of an international standard. It offers a complete school-leaving course using English as the medium of instruction. We emphasize equal proficiency in Bangla as a necessary prerequisite for a well-rounded education for Bangladeshi students.<br><br>Vista School curriculum has been designed to reflect the specific needs of Bangladeshi students keeping in mind their heritage, culture and national identity. The school has designed a comprehensive curriculum for all classes leading to the University of Cambridge International Examinations Ordinary and Advanced Level General Certificate of Education courses which are taught in Classes IX to XII. These examinations are administered by the British Council, Dhaka.<br><br>In the Junior school, we encourage children to observe their surroundings, think independently, ask questions and to freely express themselves. In recent years, we have introduced center-based classrooms, where diverse activities are conducted to develop a range of important skills.</p>
            <p><img src="../../frontend/img/sliders/01.jpg" alt="" width="100%"></p>',

            '<div class="col-12 col-lg-8">
            <div class="container px-0 pt-2">
            <div class="table-responsive mb-3">
            <table class="table table-bordered">
            <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Day</th>
            <th scope="col">Activities/Holiday</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <th scope="row">1</th>
            <td>01 Jan 2024</td>
            <td>Monday</td>
            <td>Orientation class.</td>
            </tr>
            <tr>
            <th scope="row">2</th>
            <td>02 Jan - 11 Jan 2024</td>
            <td>Friday - Thursday</td>
            <td>Registration</td>
            </tr>
            <tr>
            <th scope="row">3</th>
            <td>22 Jan 2024</td>
            <td>Monday</td>
            <td>Deadline of cources.</td>
            </tr>
            </tbody>
            </table>
            </div>
            </div>
            </div>',

            '<p>Vista School is an IB World School. The School also provides a comprehensive, balanced education, integrating all eight learning areas from the Western Vista School Curriculum Framework. They are: English &ndash; encompasses all areas of literacy including reading, writing, viewing texts, spelling and critical awareness. The focus of an Vista School literacy programme is on students becoming confident and adaptable users of language, able to apply their knowledge in a wide range of contexts. All forms of literacy are acknowledged, including print based and media.<br><br><strong>Science &ndash;</strong>&nbsp;students are encouraged to learn about the world around them through concrete, meaningful experiences. The Science curriculum is hands-on, with children being encouraged to investigate and solve problems independently. Discovery is the basis for all concrete knowledge and understanding.<br><br><strong>Mathematics &ndash;</strong>&nbsp;the curriculum is taught in the areas of Space, Chance and Data, Number and Algebra, with a special emphasis on developing the student\'s &lsquo;mathematical disposition\', that is, encouraging them to problem solve and take different approaches to finding solutions, an attitude which is then applied across the curriculum.<br><br><strong>Technology and Enterprise &ndash;</strong>&nbsp;students are encouraged to engage in long-term projects in which they consider the materials, information and systems which suit a given purpose, applying them to a &lsquo;Technology Process\' which realizes new opportunities or meets human needs.<br><br><strong>The Arts &ndash;</strong> students participate in a wide range of activities including fine arts, music, drama and literature. High value is placed on the student\'s ability to express themselves creatively and evaluate the works of others critically. Students are taught the value of arts in the wider community, and are aware of the way their own creative abilities aid their success in other Learning Areas.</p>',

            '<div class="card mb-3">
            <div class="card-body">
            <h5 class="fw-semibold"><a class="text-black" href="../../academic/facilities">Integrated Student Information System (SIS)</a></h5>
            <p class="m-0">A one-stop solution for all student data, streamlining processes like enrollment, attendance, and performance tracking to enhance administrative efficiency.</p>
            </div>
            </div>
            <div class="card mb-3">
            <div class="card-body">
            <h5 class="fw-semibold"><a class="text-black" href="../../academic/facilities">Customizable Academic Planning</a></h5>
            <p class="m-0">Enables educators to develop and adjust curricula and lesson plans to meet the unique needs and learning goals of each student.</p>
            </div>
            </div>
            <div class="card mb-3">
            <div class="card-body">
            <h5 class="fw-semibold"><a class="text-black" href="../../academic/facilities">Automated Communication Channels</a></h5>
            <p class="m-0">Facilitates seamless communication among teachers, parents, and students, ensuring everyone stays informed and engaged.</p>
            </div>
            </div>
            <div class="card mb-3">
            <div class="card-body">
            <h5 class="fw-semibold"><a class="text-black" href="../../academic/facilities">Resource Allocation Optimization</a></h5>
            <p class="m-0">Utilizes advanced algorithms to ensure optimal use of resources, including classroom assignments, staff scheduling, and budgeting.</p>
            </div>
            </div>',

            '<h5 class="fw-semibold"><a class="text-black" href="../../academic/management">Empowering Educational Excellence: Vista School Management Unveiled</a></h5>
            <p>Embark on a journey of educational transformation with Vista School Management. Our comprehensive system is meticulously designed to elevate every aspect of school operations, from academic planning to resource allocation and student progress tracking. By seamlessly integrating state-of-the-art technology, data-driven insights, and pedagogical expertise, we empower educators to nurture the full potential of every student. Explore how Vista School Management is revolutionizing the educational landscape, fostering a culture of excellence, innovation, and inclusivity.</p>
            <p>&nbsp;</p>
            <p>Vista School Management. Our comprehensive system is meticulously designed to elevate every aspect of school operations, from academic planning to resource allocation and student progress tracking. By seamlessly integrating state-of-the-art technology, data-driven insights, and pedagogical expertise, we empower educators to nurture the full potential of every student</p>',

            '<div class="text-center h5 fst-italic">"Inclusion, a continual process dedicated to enhancing access and involvement in learning for all students by identifying and eliminating barriers, thrives in a culture of collaboration, mutual respect, support, and collective problem-solving within the entire school community&rdquo; &ndash; Learning Diversity and Inclusion in IB Programs, pg.3.</div>
            <p><br><br>Essential beliefs at Vista School include recognizing each student\'s unique learning characteristics, supporting them within regular classrooms, emphasizing a strong partnership between school and home, and viewing learning as a social and cognitive process.<br><br>Although the Vista School curriculum is not modified, the Student Support Team employs instructional support systems to eliminate learning barriers so students can access the academic program. Quality educators lead learning through evidence-based approaches, using data-guided collaborative decision-making and supporting classroom implementation.</p>',

            '<div class="col-12 col-lg-8">
            <div class="container px-0 pt-2">
            <div class="table-responsive mb-3">
            <table class="table table-bordered">
            <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name of the Books</th>
            <th scope="col">Mid Term</th>
            <th scope="col">Final Term</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <th scope="row">1</th>
            <td>10 Stories from Shakespeare</td>
            <td>1. Noise By Jessie Pope<br>2. Knowledge By Eleanor Farjeon</td>
            <td>1. Limericks By Edward Lear<br>2. The Blind Boy By Colley Cibber</td>
            </tr>
            </tbody>
            </table>
            </div>
            </div>
            </div>',
        ];
        foreach ($page_names as $key => $item) {
            $row = new Academic();
            $row->page_name   = $item;
            $row->title       = $titles[$key];
            $row->description = $descriptions[$key];
            $row->save();
        }
    }
}
