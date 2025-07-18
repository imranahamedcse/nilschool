<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Staff\RoleSeeder;
use Database\Seeders\Staff\UserSeeder;
use Database\Seeders\SearchSeeder;
use Database\Seeders\UploadSeeder;
use Database\Seeders\Settings\SettingSeeder;
use Database\Seeders\FlagIconSeeder;
use Database\Seeders\Settings\LanguageSeeder;
use App\Models\Academic\TimeSchedule;
use App\Models\Currency;
use Database\Seeders\Staff\PermissionSeeder;
use Database\Seeders\Staff\StaffSeeder;
use Database\Seeders\Fees\FeesTypeSeeder;
use Database\Seeders\Academic\ShiftSeeder;
use Database\Seeders\Fees\FeesGroupSeeder;
use App\Models\StudentInfo\StudentCategory;
use Database\Seeders\Accounts\IncomeSeeder;
use Database\Seeders\Fees\FeesMasterSeeder;
use Database\Seeders\Academic\ClassesSeeder;
use Database\Seeders\Academic\SectionSeeder;
use Database\Seeders\Academic\SubjectSeeder;
use Database\Seeders\Accounts\ExpenseSeeder;
use Database\Seeders\Staff\DepartmentSeeder;
use Database\Seeders\Staff\DesignationSeeder;
use Database\Seeders\Academic\ClassRoomSeeder;
use Database\Seeders\Academic\ClassRoutineSeeder;
use Database\Seeders\Academic\ClassSetupSeeder;
use Database\Seeders\StudentInfo\StudentSeeder;
use Database\Seeders\Accounts\AccountHeadSeeder;
use Database\Seeders\Examination\ExamTypeSeeder;
use Database\Seeders\Academic\TimeScheduleSeeder;
use Database\Seeders\Examination\MarkGradeSeeder;
use Database\Seeders\Academic\SubjectAssignSeeder;
use Database\Seeders\Examination\ExamAssignSeeder;
use Database\Seeders\Examination\MarkRegisterSeeder;
use Database\Seeders\StudentInfo\ParentGuardianSeeder;
use Database\Seeders\StudentInfo\StudentCategorySeeder;
use Database\Seeders\Academic\ClassSetupChildrensSeeder;
use Database\Seeders\ClassRoom\AssignmentSeeder;
use Database\Seeders\ClassRoom\HomeworkSeeder;
use Database\Seeders\ClassRoom\Postseeder;
use Database\Seeders\Dormitory\DormitorySeeder;
use Database\Seeders\Dormitory\DormitorySetupSeeder;
use Database\Seeders\Dormitory\DormitoryStudentSeeder;
use Database\Seeders\Dormitory\RoomSeeder;
use Database\Seeders\Dormitory\RoomTypeSeeder;
use Database\Seeders\Examination\ExaminationSettingsSeeder;
use Database\Seeders\Examination\ExamRoutineSeeder;
use Database\Seeders\Library\BookCategorySeeder;
use Database\Seeders\OnlineExamination\OnlineExamSeeder;
use Database\Seeders\OnlineExamination\QuestionBankSeeder;
use Database\Seeders\OnlineExamination\QuestionGroupSeeder;
use Database\Seeders\Settings\BloodGroupSeeder;
use Database\Seeders\Settings\GenderSeeder;
use Database\Seeders\Settings\ReligionSeeder;
use Database\Seeders\Settings\SessionSeeder;
use Database\Seeders\Transport\TransportSetupSeeder;
use Database\Seeders\Transport\PickupPointSeeder;
use Database\Seeders\Transport\RouteSeeder;
use Database\Seeders\Transport\VehicleSeeder;
use Database\Seeders\Transport\VehicleStudentSeeder;
use Database\Seeders\WebsiteSetup\AboutSeeder;
use Database\Seeders\WebsiteSetup\AcademicCalendarSeeder;
use Database\Seeders\WebsiteSetup\AcademicSeeder;
use Database\Seeders\WebsiteSetup\AdmissionSeeder;
use Database\Seeders\WebsiteSetup\CounterSeeder;
use Database\Seeders\WebsiteSetup\EventSeeder;
use Database\Seeders\WebsiteSetup\GalleryCategorySeeder;
use Database\Seeders\WebsiteSetup\GallerySeeder;
use Database\Seeders\WebsiteSetup\NewsSeeder;
use Database\Seeders\WebsiteSetup\SliderSeeder;
use Database\Seeders\WebsiteSetup\ContactInfoSeeder;
use Database\Seeders\WebsiteSetup\DepartmentContactSeeder;
use Database\Seeders\WebsiteSetup\DownloadableFormSeeder;
use Database\Seeders\WebsiteSetup\FAQSeeder;
use Database\Seeders\WebsiteSetup\InformationSeeder;
use Database\Seeders\WebsiteSetup\LessonPlanSeeder;
use Database\Seeders\WebsiteSetup\PageSectionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // Settings
            BloodGroupSeeder::class,
            GenderSeeder::class,
            LanguageSeeder::class,
            ReligionSeeder::class,
            SessionSeeder::class,
            SettingSeeder::class,

            UploadSeeder::class,
            FlagIconSeeder::class,
            SearchSeeder::class,

            // Staff
            DepartmentSeeder::class,
            DesignationSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            StaffSeeder::class,
            UserSeeder::class,

            // Academic
            ClassesSeeder::class,
            SectionSeeder::class,
            ShiftSeeder::class,
            SubjectSeeder::class,
            ClassSetupSeeder::class,
            ClassSetupChildrensSeeder::class,
            ClassRoomSeeder::class,
            SubjectAssignSeeder::class,
            TimeScheduleSeeder::class,
            ClassRoutineSeeder::class,
            // Student info
            ParentGuardianSeeder::class,
            StudentCategorySeeder::class,
            StudentSeeder::class,
            // Accounts
            AccountHeadSeeder::class,
            IncomeSeeder::class,
            ExpenseSeeder::class,
            // Class Room
            AssignmentSeeder::class,
            HomeworkSeeder::class,
            Postseeder::class,
            // Dormitory
            DormitorySeeder::class,
            RoomTypeSeeder::class,
            RoomSeeder::class,
            DormitorySetupSeeder::class,
            DormitoryStudentSeeder::class,
            // Examication
            ExamTypeSeeder::class,
            MarkGradeSeeder::class,
            ExamRoutineSeeder::class,
            ExaminationSettingsSeeder::class,
            ExamAssignSeeder::class,
            MarkRegisterSeeder::class,
            // Fees
            FeesGroupSeeder::class,
            FeesTypeSeeder::class,
            FeesMasterSeeder::class,
            // Library
            BookCategorySeeder::class,
            // Online Examination
            QuestionGroupSeeder::class,
            QuestionBankSeeder::class,
            OnlineExamSeeder::class,
            CurrencySeeder::class,
            // Transport
            RouteSeeder::class,
            VehicleSeeder::class,
            PickupPointSeeder::class,
            TransportSetupSeeder::class,
            VehicleStudentSeeder::class,

            // Frontend
            PageSectionsSeeder::class,
            SliderSeeder::class,
            CounterSeeder::class,
            NewsSeeder::class,
            EventSeeder::class,
            GalleryCategorySeeder::class,
            GallerySeeder::class,
            ContactInfoSeeder::class,
            DepartmentContactSeeder::class,
            AboutSeeder::class,

            DownloadableFormSeeder::class,
            LessonPlanSeeder::class,
            InformationSeeder::class,
            AdmissionSeeder::class,
            AcademicSeeder::class,
            AcademicCalendarSeeder::class,
            FAQSeeder::class,
        ]);
    }
}
