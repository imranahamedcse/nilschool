<?php

namespace App\Http\Controllers\StudentInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Settings\GenderRepository;
use App\Http\Repositories\Settings\ReligionRepository;
use App\Http\Repositories\Settings\BloodGroupRepository;
use App\Http\Repositories\Academic\ShiftRepository;
use App\Http\Repositories\Academic\ClassesRepository;
use App\Http\Repositories\Academic\SectionRepository;
use App\Http\Repositories\StudentInfo\StudentRepository;
use App\Http\Requests\StudentInfo\Student\StoreRequest;
use App\Http\Requests\StudentInfo\Student\UpdateRequest;
use App\Http\Repositories\Academic\ClassSetupRepository;
use App\Http\Repositories\Examination\ExamAssignRepository;
use App\Http\Repositories\StudentInfo\StudentCategoryRepository;

class StudentController extends Controller
{
    private $repo;
    private $classRepo;
    private $sectionRepo;
    private $classSetupRepo;
    private $shiftRepo;
    private $bloodRepo;
    private $religionRepo;
    private $genderRepo;
    private $categoryRepo;
    private $examAssignRepo;

    function __construct(
        StudentRepository $repo,
        ClassesRepository $classRepo,
        SectionRepository $sectionRepo,
        ClassSetupRepository $classSetupRepo,
        ShiftRepository   $shiftRepo,
        BloodGroupRepository         $bloodRepo,
        ReligionRepository           $religionRepo,
        GenderRepository             $genderRepo,
        StudentCategoryRepository    $categoryRepo,
        ExamAssignRepository         $examAssignRepo,
    ) {
        $this->repo         = $repo;
        $this->classRepo    = $classRepo;
        $this->sectionRepo  = $sectionRepo;
        $this->classSetupRepo  = $classSetupRepo;
        $this->shiftRepo    = $shiftRepo;
        $this->bloodRepo    = $bloodRepo;
        $this->religionRepo = $religionRepo;
        $this->genderRepo   = $genderRepo;
        $this->categoryRepo = $categoryRepo;
        $this->examAssignRepo = $examAssignRepo;
    }

    public function index()
    {
        $data['classes']  = $this->classRepo->assignedAll();
        $data['sections'] = [];
        $data['students'] = [];
        // $data['students'] = $this->repo->getPaginateAll();

        $title             = ___('student_info.List');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['student.search', 'class', 'section'],
            "create-permission"   => 'student_create',
            "create-route" => 'student.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.admin.student-info.student.index', compact('data'));
    }

    public function search(Request $request)
    {
        $data['classes']  = $this->classRepo->assignedAll();
        $data['sections'] = $this->classSetupRepo->getSections($request->class);
        $data['request']  = $request;
        $data['students'] = $this->repo->searchStudents($request);

        $title             = ___('student_info.List');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['student.search', 'class', 'section'],
            "create-permission"   => 'student_create',
            "create-route" => 'student.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.student-info.student.index', compact('data'));
    }

    public function create()
    {
        $data['title']     = ___('student_info.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => ___('student_info.Students'), "route" => "student.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']   = $this->classRepo->assignedAll();
        $data['sections']  = [];
        $data['shifts']    = $this->shiftRepo->all();

        $data['bloods']       = $this->bloodRepo->all();
        $data['religions']    = $this->religionRepo->all();
        $data['genders']      = $this->genderRepo->all();
        $data['categories']   = $this->categoryRepo->all();

        return view('backend.admin.student-info.student.create', compact('data'));
    }

    public function addNewDocument(Request $request)
    {
        $counter = $request->counter;
        return view('backend.admin.student-info.student.add-document', compact('counter'))->render();
    }
    public function getStudents(Request $request)
    {
        $examAssign = $this->examAssignRepo->getExamAssign($request);
        $students = $this->repo->getStudents($request);
        return view('backend.admin.student-info.student.students-list', compact('students', 'examAssign'))->render();
    }

    public function getClassSectionStudents(Request $request)
    {
        return $this->repo->getStudents($request);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);

        if ($result['status']) {
            return redirect()->route('student.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']     = ___('student_info.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => ___('student_info.Students'), "route" => "student.index"],
            ["title" => $data['title'], "route" => ""]
        ];


        $data['session_class_student'] = $this->repo->getSessionStudent($id);
        $data['student']   = $this->repo->show($data['session_class_student']->student_id);
        $data['classes']   = $this->classRepo->assignedAll();
        $data['sections']  = $this->classSetupRepo->getSections($data['session_class_student']->classes_id);
        $data['shifts']    = $this->shiftRepo->all();

        $data['bloods']       = $this->bloodRepo->all();
        $data['religions']    = $this->religionRepo->all();
        $data['genders']      = $this->genderRepo->all();
        $data['categories']   = $this->categoryRepo->all();
        return view('backend.admin.student-info.student.edit', compact('data'));
    }


    public function show($id)
    {
        $data = $this->repo->show($id);
        return view('backend.admin.student-info.student.show', compact('data'));
    }


    public function update(UpdateRequest $request)
    {
        $result = $this->repo->update($request, $request->id);

        if ($result['status']) {
            return redirect()->route('student.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {

        $result = $this->repo->destroy($id);
        if ($result['status']) :
            $success[0] = $result['message'];
            $success[1] = 'success';
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
            return response()->json($success);
        else :
            $success[0] = $result['message'];
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
            return response()->json($success);
        endif;
    }
}
