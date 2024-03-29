<?php

namespace Database\Seeders\WebsiteSetup;

use App\Models\WebsiteSetup\Information;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page_names = [
            'Information',
            'Career',
            'Payment',
        ];
        $titles = [
            'Information',
            'Career',
            'Payment',
        ];

        $descriptions = [
            '<pre style=""><h2>Vista School, Dhanmondi</h2><h4><font color="#212529" face="Tahoma">Address:</font></h4><font color="#212529" face="Tahoma"><b>Head Office:</b><br></font><font color="#212529" face="Tahoma">House # 05, Road # 12 (New),<br></font><p><font color="#212529" face="Tahoma">Dhanmondi, Dhaka-1209. Bangladesh</font></p><font color="#212529" face="Tahoma"><b>Contact Info:</b><br></font><span style="color: rgb(33, 37, 41); font-family: Tahoma; background-color: var(--bs-card-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);">E-mail: admin@vistaschoolschool.org<br></span><font color="#212529" face="Tahoma">Telephone: +88 02 55026528, +88 02 55026529</font></pre>',

            '<p><img src="http://vista-school-ms.test/frontend/img/default/career.jpg" alt="Image" class="rounded mb-4" max-width="100%" style="color: rgb(33, 37, 41); font-family: Roboto; margin-bottom: 1.5rem !important; border-radius: var(--bs-border-radius) !important;"><span style="color: rgb(33, 37, 41); font-family: Roboto;"></span><br style="color: rgb(33, 37, 41); font-family: Roboto;"><p><span style="font-weight: bolder; color: rgb(33, 37, 41); font-family: Verdana;">Vista School</span><span style="color: rgb(33, 37, 41); font-family: Verdana;">&nbsp;invites Exceptional Educators to join its team of change makers! If you are a passionate teacher, believe in your ability to make a difference and have immaculate communication skills in English, come! join our team of trend setters!</span></p><p><span style="color: rgb(33, 37, 41); font-family: Verdana;">All applicants must have requisite qualifications and at least 3 years of experience. Exceptional Freshers can also apply.</span><br><span style="color: rgb(33, 37, 41); font-family: Verdana;">Attractive emoluments commensurate with qualifications and experience offered. Vista School offers an excellent work environment that encourages and rewards competence and initiative.</span></p><p><span style="color: rgb(33, 37, 41); font-family: Verdana;">Interested candidates can mail their resumes to career@vistaschool.edu.bd</span></p></p>',

            '<h3 style="text-align: center; "><b>Vista School Fees Payment Options</b></h3><h3 style="text-align: center; "><b><br></b></h3><div style="text-align: center;">Please give STUDENT ID in case of each online payment Online Payment : https://vistaschool.edu.bd/-&gt; Payment-&gt; Pay Online -&gt; Campus Information -&gt;Student Information -&gt; Payment Information -&gt; Payment Method:</div><div style="text-align: center;"><br></div><div style="text-align: center;">OK Wallet payment of vista -&gt;Login ok wallet -&gt; Go Fees pay-&gt; Tution fee – Ok EMS -&gt; Sclect vista -&gt; select Branch -&gt;Student ID-&gt;Check Students name &amp; TK -&gt; PIN -&gt; Confirm.</div><div style="text-align: center;"><br></div><div style="text-align: center;">NAGAD payment of vista: Bill pay -&gt;Select – vista / 1037, Student ID, Class, Month, Campus, Amount -&gt; your PIN-&gt; Send.</div><div style="text-align: center;"><br></div><div style="text-align: center;">ROCKET/NEXUS payment of vista: Bill pay -&gt; Other -&gt; vista / 2728 (Mobile No-01678308555) -&gt;Student ID, Amount you want to pay-&gt; your PIN-&gt; Send.</div><div style="text-align: center;"><br></div><div style="text-align: center;">bKash payment of vista: Step1- bKash Pay Bill Step2-Educational Institution Step 3 vista. Step4- Enter Student ID Tuition Fee Amount. (Reference Class, Campus)</div><div style="text-align: center;"><br></div><div style="text-align: center;">Bank Accounts of vista</div><div style="text-align: center;"><br></div><div style="text-align: center;"><b>DBBL A/C # 258.120.0000013, (Mohammadpur Branch)</b></div><div style="text-align: center;"><b><br></b></div><div style="text-align: center;"><b>UCBL A/C # 0842301000000168, (Dhanmondi Branch)</b></div><div style="text-align: center;"><b><br></b></div><div style="text-align: center; "><b>Bank Asia A/C # 06236000004, (Lalmatia Branch)</b></div>',
        ];
        foreach ($page_names as $key=>$item) {
            $row = new Information();
            $row->page_name   = $item;
            $row->title       = $titles[$key];
            $row->description = $descriptions[$key];
            $row->save();
        }
    }
}
