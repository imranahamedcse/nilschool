<?php

namespace App\Providers;

use App\Http\Interfaces\Academic\AttendanceInterface;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\SectionInterface;
use App\Http\Interfaces\Academic\ShiftInterface;
use App\Http\Interfaces\Academic\SubjectInterface;
use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\UserManagement\RoleRepository;
use App\Http\Interfaces\AuthenticationRepositoryInterface;
use App\Http\Interfaces\Settings\BloodGroupInterface;
use App\Http\Interfaces\Settings\LanguageInterface;
use App\Http\Repositories\AuthenticationRepository;
use App\Http\Interfaces\UserManagement\PermissionInterface;
use App\Http\Interfaces\UserManagement\UserInterface;
use App\Http\Repositories\Settings\LanguageRepository;
use App\Http\Repositories\UserManagement\PermissionRepository;
use App\Http\Repositories\UserManagement\UserRepository;
use App\Http\Interfaces\Settings\FlagIconInterface;
use App\Http\Interfaces\Settings\GenderInterface;
use App\Http\Interfaces\Settings\ReligionInterface;
use App\Http\Interfaces\Settings\SessionInterface;
use App\Http\Repositories\Academic\ClassesRepository;
use App\Http\Repositories\Academic\SectionRepository;
use App\Http\Repositories\Academic\ShiftRepository;
use App\Http\Repositories\Academic\SubjectRepository;
use App\Http\Interfaces\Academic\ClassRoomInterface;
use App\Http\Interfaces\Academic\ClassRoutineInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Academic\SubjectAssignInterface;
use App\Http\Interfaces\Academic\TimeScheduleInterface;
use App\Http\Interfaces\Accounts\AccountHeadInterface;
use App\Http\Interfaces\Accounts\ExpenseInterface;
use App\Http\Interfaces\Accounts\IncomeInterface;
use App\Http\Interfaces\Canteen\OrderInterface;
use App\Http\Interfaces\Canteen\ProductCategoryInterface;
use App\Http\Interfaces\Canteen\ProductInterface;
use App\Http\Interfaces\ClassRoom\AssignmentInterface;
use App\Http\Interfaces\ClassRoom\HomeworkInterface;
use App\Http\Interfaces\ClassRoom\PostInterface;
use App\Http\Interfaces\Dormitory\DormitoryInterface;
use App\Http\Interfaces\Dormitory\DormitorySetupInterface;
use App\Http\Interfaces\Dormitory\DormitoryStudentInterface;
use App\Http\Interfaces\Dormitory\RoomInterface;
use App\Http\Interfaces\Dormitory\RoomTypeInterface;
use App\Http\Interfaces\Examination\ExamAssignInterface;
use App\Http\Interfaces\Examination\ExaminationSettingsInterface;
use App\Http\Interfaces\Examination\ExamRoutineInterface as ExaminationExamRoutineInterface;
use App\Http\Interfaces\WebsiteSetup\CounterInterface;
use App\Http\Interfaces\Examination\ExamTypeInterface;
use App\Http\Interfaces\Examination\MarksGradeInterface;
use App\Http\Interfaces\Report\MarksheetInterface;
use App\Http\Interfaces\Examination\MarksRegisterInterface;
use App\Http\Interfaces\Fees\FeesAssignInterface;
use App\Http\Interfaces\Fees\FeesCollectInterface;
use App\Http\Interfaces\Fees\FeesGroupInterface;
use App\Http\Interfaces\Fees\FeesMasterInterface;
use App\Http\Interfaces\Fees\FeesTypeInterface;
use App\Http\Interfaces\Frontend\FrontendInterface;
use App\Http\Interfaces\Library\BookCategoryInterface;
use App\Http\Interfaces\Library\BookInterface;
use App\Http\Interfaces\Library\IssueBookInterface;
use App\Http\Interfaces\Library\MemberCategoryInterface;
use App\Http\Interfaces\Library\MemberInterface;
use App\Http\Interfaces\OnlineExamination\ExamTypeInterface as OnlineExaminationExamTypeInterface;
use App\Http\Interfaces\OnlineExamination\OnlineExamInterface;
use App\Http\Interfaces\OnlineExamination\QuestionBankInterface;
use App\Http\Interfaces\OnlineExamination\QuestionGroupInterface;
use App\Http\Interfaces\Report\AccountInterface;
use App\Http\Interfaces\Report\AttendanceInterface as ReportAttendanceInterface;
use App\Http\Interfaces\WebsiteSetup\NewsInterface;
use App\Http\Interfaces\Report\ClassRoutineInterface as ReportClassRoutineInterface;
use App\Http\Interfaces\Report\DueFeesInterface;
use App\Http\Interfaces\Report\ExamRoutineInterface;
use App\Http\Interfaces\Report\FeesCollectionInterface;
use App\Http\Interfaces\Report\MeritListInterface;
use App\Http\Interfaces\Report\ProgressCardInterface;
use App\Http\Interfaces\Settings\SettingInterface;
use App\Http\Interfaces\WebsiteSetup\SliderInterface;
use App\Http\Interfaces\HumanResource\DepartmentInterface;
use App\Http\Interfaces\HumanResource\DesignationInterface;
use App\Http\Interfaces\HumanResource\StaffAttendanceInterface;
use App\Http\Interfaces\HumanResource\StaffInterface;
use App\Http\Interfaces\UserManagement\RoleInterface;
use App\Http\Interfaces\StudentInfo\DisabledStudentInterface;
use App\Http\Interfaces\StudentInfo\OnlineAdmissionInterface;
use App\Http\Interfaces\StudentInfo\ParentGuardianInterface;
use App\Http\Interfaces\StudentInfo\PromoteStudentInterface;
use App\Http\Interfaces\StudentInfo\StudentCategoryInterface;
use App\Http\Interfaces\StudentInfo\StudentInterface;
use App\Http\Interfaces\StudentPanel\ClassRoutineInterface as StudentPanelClassRoutineInterface;
use App\Http\Interfaces\StudentPanel\DashboardInterface;
use App\Http\Interfaces\StudentPanel\ExamRoutineInterface as StudentPanelExamRoutineInterface;
use App\Http\Interfaces\StudentPanel\MarksheetInterface as StudentPanelMarksheetInterface;
use App\Http\Interfaces\Transport\TransportSetupInterface;
use App\Http\Interfaces\Transport\PickupPointInterface;
use App\Http\Interfaces\Transport\RouteInterface;
use App\Http\Interfaces\Transport\TransportStudentInterface;
use App\Http\Interfaces\Transport\VehicleInterface;
use App\Http\Interfaces\WebsiteSetup\AboutInterface;
use App\Http\Interfaces\WebsiteSetup\ContactInfoInterface;
use App\Http\Interfaces\WebsiteSetup\ContactMessageInterface;
use App\Http\Interfaces\WebsiteSetup\DepartmentContactInterface;
use App\Http\Interfaces\WebsiteSetup\EventInterface;
use App\Http\Interfaces\WebsiteSetup\GalleryCategoryInterface;
use App\Http\Interfaces\WebsiteSetup\GalleryInterface;
use App\Http\Interfaces\WebsiteSetup\SectionsInterface;
use App\Http\Interfaces\WebsiteSetup\SubscribeInterface;
use App\Http\Repositories\Academic\AttendanceRepository;
use App\Http\Repositories\Academic\ClassRoomRepository;
use App\Http\Repositories\Academic\ClassRoutineRepository;
use App\Http\Repositories\Academic\ClassSetupRepository;
use App\Http\Repositories\Academic\SubjectAssignRepository;
use App\Http\Repositories\Academic\TimeScheduleRepository;
use App\Http\Repositories\Accounts\AccountHeadRepository;
use App\Http\Repositories\Accounts\ExpenseRepository;
use App\Http\Repositories\Accounts\IncomeRepository;
use App\Http\Repositories\Canteen\OrderRepository;
use App\Http\Repositories\Canteen\ProductCategoryRepository;
use App\Http\Repositories\Canteen\ProductRepository;
use App\Http\Repositories\ClassRoom\AssignmentRepository;
use App\Http\Repositories\ClassRoom\HomeworkRepository;
use App\Http\Repositories\ClassRoom\PostRepository;
use App\Http\Repositories\Settings\BloodGroupRepository;
use App\Http\Repositories\Dormitory\DormitoryRepository;
use App\Http\Repositories\Dormitory\DormitorySetupRepository;
use App\Http\Repositories\Dormitory\DormitoryStudentRepository;
use App\Http\Repositories\Dormitory\RoomRepository;
use App\Http\Repositories\Dormitory\RoomTypeRepository;
use App\Http\Repositories\Examination\ExamAssignRepository;
use App\Http\Repositories\Examination\ExaminationSettingsRepository;
use App\Http\Repositories\Examination\ExamRoutineRepository as ExaminationExamRoutineRepository;
use App\Http\Repositories\WebsiteSetup\CounterRepository;
use App\Http\Repositories\Examination\ExamTypeRepository;
use App\Http\Repositories\Examination\MarksGradeRepository;
use App\Http\Repositories\Report\MarksheetRepository;
use App\Http\Repositories\Examination\MarksRegisterRepository;
use App\Http\Repositories\Fees\FeesAssignRepository;
use App\Http\Repositories\Fees\FeesCollectRepository;
use App\Http\Repositories\Fees\FeesGroupRepository;
use App\Http\Repositories\Fees\FeesMasterRepository;
use App\Http\Repositories\Fees\FeesTypeRepository;
use App\Http\Repositories\Frontend\FrontendRepository;
use App\Http\Repositories\Library\BookCategoryRepository;
use App\Http\Repositories\Library\BookRepository;
use App\Http\Repositories\Library\IssueBookRepository;
use App\Http\Repositories\Library\MemberCategoryRepository;
use App\Http\Repositories\Library\MemberRepository;
use App\Http\Repositories\OnlineExamination\ExamTypeRepository as OnlineExaminationExamTypeRepository;
use App\Http\Repositories\Settings\GenderRepository;
use App\Http\Repositories\OnlineExamination\OnlineExamRepository;
use App\Http\Repositories\OnlineExamination\QuestionBankRepository;
use App\Http\Repositories\OnlineExamination\QuestionGroupRepository;
use App\Http\Repositories\Report\AccountRepository;
use App\Http\Repositories\Report\AttendanceRepository as ReportAttendanceRepository;
use App\Http\Repositories\WebsiteSetup\NewsRepository;
use App\Http\Repositories\Settings\ReligionRepository;
use App\Http\Repositories\Report\ClassRoutineRepository as ReportClassRoutineRepository;
use App\Http\Repositories\Report\DueFeesRepository;
use App\Http\Repositories\Report\ExamRoutineRepository;
use App\Http\Repositories\Report\FeesCollectionRepository;
use App\Http\Repositories\Report\MeritListRepository;
use App\Http\Repositories\Report\ProgressCardRepository;
use App\Http\Repositories\Settings\SessionRepository;
use App\Http\Repositories\Settings\SettingRepository;
use App\Http\Repositories\WebsiteSetup\SliderRepository;
use App\Http\Repositories\HumanResource\DepartmentRepository;
use App\Http\Repositories\HumanResource\DesignationRepository;
use App\Http\Repositories\FlagIconRepository;
use App\Http\Repositories\HumanResource\StaffAttendanceRepository;
use App\Http\Repositories\HumanResource\StaffRepository;
use App\Http\Repositories\StudentInfo\DisabledStudentRepository;
use App\Http\Repositories\StudentInfo\OnlineAdmissionRepository;
use App\Http\Repositories\StudentInfo\ParentGuardianRepository;
use App\Http\Repositories\StudentInfo\PromoteStudentRepository;
use App\Http\Repositories\StudentInfo\StudentCategoryRepository;
use App\Http\Repositories\StudentInfo\StudentRepository;
use App\Http\Repositories\StudentPanel\ClassRoutineRepository as StudentPanelClassRoutineRepository;
use App\Http\Repositories\StudentPanel\DashboardRepository;
use App\Http\Repositories\StudentPanel\ExamRoutineRepository as StudentPanelExamRoutineRepository;
use App\Http\Repositories\StudentPanel\MarksheetRepository as StudentPanelMarksheetRepository;
use App\Http\Repositories\Transport\TransportSetupRepository;
use App\Http\Repositories\Transport\PickupPointRepository;
use App\Http\Repositories\Transport\RouteRepository;
use App\Http\Repositories\Transport\TransportStudentRepository;
use App\Http\Repositories\Transport\VehicleRepository;
use App\Http\Repositories\WebsiteSetup\AboutRepository;
use App\Http\Repositories\WebsiteSetup\ContactInfoRepository;
use App\Http\Repositories\WebsiteSetup\ContactMessageRepository;
use App\Http\Repositories\WebsiteSetup\DepartmentContactRepository;
use App\Http\Repositories\WebsiteSetup\EventRepository;
use App\Http\Repositories\WebsiteSetup\GalleryCategoryRepository;
use App\Http\Repositories\WebsiteSetup\GalleryRepository;
use App\Http\Repositories\WebsiteSetup\SectionsRepository;
use App\Http\Repositories\WebsiteSetup\SubscribeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Frontend
        $this->app->bind(FrontendInterface::class,                 FrontendRepository::class);

        $this->app->bind(AuthenticationRepositoryInterface::class, AuthenticationRepository::class);
        $this->app->bind(RoleInterface::class,                     RoleRepository::class);
        $this->app->bind(PermissionInterface::class,               PermissionRepository::class);
        $this->app->bind(UserInterface::class,                     UserRepository::class);
        $this->app->bind(SettingInterface::class,                  SettingRepository::class);
        $this->app->bind(LanguageInterface::class,                 LanguageRepository::class);
        $this->app->bind(FlagIconInterface::class,                 FlagIconRepository::class);
        $this->app->bind(GenderInterface::class,                   GenderRepository::class);
        $this->app->bind(ReligionInterface::class,                 ReligionRepository::class);
        $this->app->bind(BloodGroupInterface::class,               BloodGroupRepository::class);

        // website setup
        $this->app->bind(AboutInterface::class,                    AboutRepository::class);
        $this->app->bind(ContactInfoInterface::class,              ContactInfoRepository::class);
        $this->app->bind(ContactMessageInterface::class,           ContactMessageRepository::class);
        $this->app->bind(CounterInterface::class,                  CounterRepository::class);
        $this->app->bind(DepartmentContactInterface::class,        DepartmentContactRepository::class);
        $this->app->bind(EventInterface::class,                    EventRepository::class);
        $this->app->bind(GalleryCategoryInterface::class,          GalleryCategoryRepository::class);
        $this->app->bind(GalleryInterface::class,                  GalleryRepository::class);
        $this->app->bind(NewsInterface::class,                     NewsRepository::class);
        $this->app->bind(SectionsInterface::class,                 SectionsRepository::class);
        $this->app->bind(SliderInterface::class,                   SliderRepository::class);
        $this->app->bind(SubscribeInterface::class,                SubscribeRepository::class);

        // Academic
        $this->app->bind(SessionInterface::class,                  SessionRepository::class);
        $this->app->bind(ClassesInterface::class,                  ClassesRepository::class);
        $this->app->bind(SectionInterface::class,                  SectionRepository::class);
        $this->app->bind(SubjectInterface::class,                  SubjectRepository::class);
        $this->app->bind(ShiftInterface::class,                    ShiftRepository::class);
        $this->app->bind(ClassRoomInterface::class,                ClassRoomRepository::class);
        $this->app->bind(ClassSetupInterface::class,               ClassSetupRepository::class);
        $this->app->bind(SubjectAssignInterface::class,            SubjectAssignRepository::class);
        $this->app->bind(ClassRoutineInterface::class,             ClassRoutineRepository::class);
        $this->app->bind(TimeScheduleInterface::class,             TimeScheduleRepository::class);
        $this->app->bind(AttendanceInterface::class,               AttendanceRepository::class);

        // Class Room
        $this->app->bind(AssignmentInterface::class,               AssignmentRepository::class);
        $this->app->bind(HomeworkInterface::class,                 HomeworkRepository::class);
        $this->app->bind(PostInterface::class,                     PostRepository::class);

        // Fess
        $this->app->bind(FeesGroupInterface::class,                FeesGroupRepository::class);
        $this->app->bind(FeesTypeInterface::class,                 FeesTypeRepository::class);
        $this->app->bind(FeesMasterInterface::class,               FeesMasterRepository::class);
        $this->app->bind(FeesAssignInterface::class,               FeesAssignRepository::class);
        $this->app->bind(FeesCollectInterface::class,              FeesCollectRepository::class);

        // HumanResource
        $this->app->bind(DepartmentInterface::class,               DepartmentRepository::class);
        $this->app->bind(DesignationInterface::class,              DesignationRepository::class);
        $this->app->bind(StaffInterface::class,                    StaffRepository::class);
        $this->app->bind(StaffAttendanceInterface::class,          StaffAttendanceRepository::class);

        // Examination
        $this->app->bind(ExamAssignInterface::class,               ExamAssignRepository::class);
        $this->app->bind(ExaminationSettingsInterface::class,      ExaminationSettingsRepository::class);
        $this->app->bind(ExaminationExamRoutineInterface::class,   ExaminationExamRoutineRepository::class);
        $this->app->bind(ExamTypeInterface::class,                 ExamTypeRepository::class);
        $this->app->bind(MarksGradeInterface::class,               MarksGradeRepository::class);
        $this->app->bind(MarksRegisterInterface::class,            MarksRegisterRepository::class);

        // Report
        $this->app->bind(MarksheetInterface::class,                MarksheetRepository::class);
        $this->app->bind(MeritListInterface::class,                MeritListRepository::class);
        $this->app->bind(ProgressCardInterface::class,             ProgressCardRepository::class);
        $this->app->bind(DueFeesInterface::class,                  DueFeesRepository::class);
        $this->app->bind(FeesCollectionInterface::class,           FeesCollectionRepository::class);
        $this->app->bind(AccountInterface::class,                  AccountRepository::class);
        $this->app->bind(ReportAttendanceInterface::class,         ReportAttendanceRepository::class);
        $this->app->bind(ReportClassRoutineInterface::class,       ReportClassRoutineRepository::class);
        $this->app->bind(ExamRoutineInterface::class,              ExamRoutineRepository::class);

        // Accounts
        $this->app->bind(AccountHeadInterface::class,              AccountHeadRepository::class);
        $this->app->bind(IncomeInterface::class,                   IncomeRepository::class);
        $this->app->bind(ExpenseInterface::class,                  ExpenseRepository::class);

        // Students
        $this->app->bind(DisabledStudentInterface::class,           DisabledStudentRepository::class);
        $this->app->bind(OnlineAdmissionInterface::class,           OnlineAdmissionRepository::class);
        $this->app->bind(ParentGuardianInterface::class,            ParentGuardianRepository::class);
        $this->app->bind(PromoteStudentInterface::class,            PromoteStudentRepository::class);
        $this->app->bind(StudentCategoryInterface::class,           StudentCategoryRepository::class);
        $this->app->bind(StudentInterface::class,                   StudentRepository::class);


        // Student panel
        $this->app->bind(DashboardInterface::class,                          DashboardRepository::class);
        $this->app->bind(StudentPanelClassRoutineInterface::class,           StudentPanelClassRoutineRepository::class);
        $this->app->bind(StudentPanelExamRoutineInterface::class,            StudentPanelExamRoutineRepository::class);
        $this->app->bind(StudentPanelMarksheetInterface::class,              StudentPanelMarksheetRepository::class);

        // Online examination
        $this->app->bind(OnlineExaminationExamTypeInterface::class, OnlineExaminationExamTypeRepository::class);
        $this->app->bind(QuestionGroupInterface::class,             QuestionGroupRepository::class);
        $this->app->bind(QuestionBankInterface::class,              QuestionBankRepository::class);
        $this->app->bind(OnlineExamInterface::class,                OnlineExamRepository::class);

        // Transport
        $this->app->bind(RouteInterface::class,              RouteRepository::class);
        $this->app->bind(VehicleInterface::class,            VehicleRepository::class);
        $this->app->bind(PickupPointInterface::class,        PickupPointRepository::class);
        $this->app->bind(TransportSetupInterface::class,     TransportSetupRepository::class);
        $this->app->bind(TransportStudentInterface::class,   TransportStudentRepository::class);

        // Dormitory
        $this->app->bind(RoomTypeInterface::class,           RoomTypeRepository::class);
        $this->app->bind(DormitoryInterface::class,          DormitoryRepository::class);
        $this->app->bind(RoomInterface::class,               RoomRepository::class);
        $this->app->bind(DormitorySetupInterface::class,     DormitorySetupRepository::class);
        $this->app->bind(DormitoryStudentInterface::class,   DormitoryStudentRepository::class);

        // Library
        $this->app->bind(BookCategoryInterface::class,   BookCategoryRepository::class);
        $this->app->bind(BookInterface::class,           BookRepository::class);
        $this->app->bind(IssueBookInterface::class,      IssueBookRepository::class);
        $this->app->bind(MemberCategoryInterface::class, MemberCategoryRepository::class);
        $this->app->bind(MemberInterface::class,         MemberRepository::class);

        // Library
        $this->app->bind(ProductCategoryInterface::class,   ProductCategoryRepository::class);
        $this->app->bind(ProductInterface::class,           ProductRepository::class);
        $this->app->bind(OrderInterface::class,             OrderRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
