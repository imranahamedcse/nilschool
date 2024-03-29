<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\WebsiteSetup\Admission;
use Illuminate\Database\Seeder;

class AdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page_names = [
            'Admission',
            'Why Our School',
            'How to apply',
            'Admission Process',
            'Financial Assistances',
            'Fees',
            'FAQ',
            'Campus',
        ];
        $titles = [
            'Admission',
            'Why Our School',
            'How to apply',
            'Admission Process',
            'Financial Assistances',
            'Fees',
            'FAQ',
            'Campus',
        ];

        $descriptions = [
            '<h3>Classes XI - XII</h3>
            <p>In order to apply, perspective students must undergo a primary evaluation (see entry requirement) and then collect prescribed Admission Form from the MLIS Advanced Level Admission Office according to the following schedule<br>January &ndash; December Session: 20th December<br><br>Time: 8:00 am-12:30 pm<br>July&mdash;June Session: 15th May<br><br>The following documents must be completed and submitted to MLIS Advanced Level Admission Office before the interview A completed Admission Form A complete set of IGCSE results, statement of entry (in case of pending results) and certificates<br><br>Student&rsquo;s passport size photograph(s)<br>Parents&rsquo; passport size photograph(s)<br><br>Interview with applicants and parents. Payment of Admission Fee. This can be paid in the Accounts Section of the Admission Office. Admission procedure has to be completed within a deadline (or on a seat-available basis)</p>',

            '<h5 class="fw-semibold">Why Vista School?</h5>
            <p>Because Vista School continues to be a pioneer in education and is constantly innovating, improving and evolving as an institution. With all our experience and well-designed systems, we are able to ensure a consistently high standard of education. We emphasize developing the whole child and we don\'t compromise on quality in any aspect of our operations. And our results speak for themselves:<br><br>The results achieved by our students are exemplary - each year our students dominate the awards for highest achievers in the O and A Levels nationwide.<br>Our sports teams regularly retain champion-status in tournaments.<br>Our functions and events are lauded as some of the best school productions in the country.<br>Our graduates go on to the most prestigious universities abroad as well as the best in higher education in Bangladesh.<br><br>Our alumni have achieved all kinds of academic and professional heights in business and commerce, academia, medicine, the arts and public services.</p>',

            '<p>Application Forms are available online, please click on the button below. If you cannot access the form, you can also contact us and we will email you the form.<br><br>Playgroup Admissions: Interviews are taken from September for the next academic session which starts in July; therefore parents are advised to apply when the child is 2.5 years old and as early as possible since admission is offered on a first-come-first-served basis.<br><br>Nursery to IX Admissions: From January onwards application forms are collected for the next academic session which starts in July. The Admission Test starts in spring.<br><br>A-Level Admissions: In June application forms are collected for the coming academic session. Admission is only offered if students meet minimum academic requirements.<br><br>Successful candidates who cannot be admitted due to unavailability of seats are kept in the waiting list and are notified as and when vacancies arise.</p>',

            '<h5>Who We Serve</h5>
            <p>We serve Bangladeshi families who value a good education. We welcome those who appreciate well-rounded educational opportunities that go beyond just academics. The members of our community place importance on good character, moral and social development as well as excellent academics.<br><br>Admission is offered those who want to receive a balanced and well-rounded education using English as the primary medium of instruction but placing equal emphasis on Bangla.<br><br>It is compulsory for all students to take Bangla up to O\' Level. Students who have lived abroad and do not have a good foundation in Bangla can take "Special Bangla" in small groups which is an accelerated program designed to help those students come up to the required level.</p>',

            '<p>The Management of Vista School is committed to provide access to top quality education for the wider community. Through the Vista School Scholarship Program we have developed support for both underprivileged and meritorious students. The Scholarship Program has two components, as follows:<br><br>Merit based Scholarship<br><br>Need based Financial Assistance<br><br></p>
            <h5>Merit based Scholarship</h5>
            <p>As a part of our recognition of hard work, dedication and academic excellence, Vista School offers Merit Scholarships to one student each from Class V to X. To become eligible for a Merit Scholarship, students must demonstrate excellent academic records. Top students are then invited to sit for the Merit Exam, and the highest achievers are invited for interviews. Through this process, one student is selected to receive the Merit Scholarship from each class.</p>',

            '<h5 class="fw-semibold">School Fees</h5>
            <p>Vista School charges a single annual tuition fee. There is no separately yearly charge. At the time of admission, we charge an Admission Fee as well.<br><br>Vista School offers flexibility for parents in both the payment structure and payment mode for its annual tuition fees. In addition, stationery and textbooks can be purchased through the school for an additional fee, which varies from class to class (this is not mandatory but is designed as a convenience for parents).<br><br>For more information about our fees, payment structures and payment modes, please contact our Admissions Office, based in the Mirpur campus at 01755630141.<br><br></p>
            <h5 class="fw-semibold">Admission Fee</h5>
            <p>The Admission Fee is divided in two parts i.e. actual Admission fee and Security deposit fee.<br><br>The Admission Fee is non-refundable. However, after a student leaves the school, the security deposit is refundable if the conditions for a refund are met. Details are provided to parents in the Student-Parent Handbook.</p>',

            '<p>Give below are some questions and answers about the admission procedure, fees, payment methods and other common questions we receive at the Admissions office.</p>
            <p>1. When does the session start and when do classes commence?</p>
            <p>2. When should I apply for my child\'s admission?</p>
            <p>3. What is the procedure for admission?</p>
            <p>4. How long is the admissions process?</p>
            <p>5. What questions might be asked during the interview?</p>
            <p>6. The written exams are taken on which subjects?</p>
            <p>7. Why do you take a security deposit and when will it be refunded?</p>
            <p>8. How and where do we need to pay the monthly tuition fee?</p>
            <p>9. Why is the Admission Fee non-refundable?</p>
            <p>10. Where can I get an Admission Form?</p>',

            '<p>Vista School has eight campuses throughout Dhaka city. Interested parents may visit these campuses in Dhanmondi, Banani, Gulshan, Mirpur or Uttara by contacting our Admissions Department. Our team will organize the tour in consultation with the concerned campus. Parents are also able to visit these campuses during the Admissions process when they are called for an interview.<br><br>For further queries regarding admission or to set up a campus tour, please contact: Admissions Department<br>Telephone: (0088) 01755630141.<br>Email: admissions@vistaschool.com</p>',
        ];
        foreach ($page_names as $key=>$item) {
            $row = new Admission();
            $row->page_name   = $item;
            $row->title       = $titles[$key];
            $row->description = $descriptions[$key];
            $row->save();
        }
    }
}
