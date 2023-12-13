<?php

namespace App\Http\Controllers\StudentInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentInfo\OnlineAdmission\StoreRequest;
use App\Http\Repositories\Settings\GenderRepository;
use App\Http\Repositories\Settings\ReligionRepository;
use App\Http\Repositories\Settings\BloodGroupRepository;
use App\Http\Repositories\Academic\ShiftRepository;
use App\Http\Repositories\Academic\ClassesRepository;
use App\Http\Repositories\Academic\SectionRepository;
use App\Http\Repositories\Academic\ClassSetupRepository;
use App\Http\Repositories\StudentInfo\OnlineAdmissionRepository;
use App\Http\Repositories\StudentInfo\StudentCategoryRepository;

class OnlineAdmissionController extends Controller
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

    function __construct(
        OnlineAdmissionRepository    $repo,
        ClassesRepository            $classRepo,
        SectionRepository            $sectionRepo,
        ClassSetupRepository         $classSetupRepo,
        ShiftRepository              $shiftRepo,
        BloodGroupRepository         $bloodRepo,
        ReligionRepository           $religionRepo,
        GenderRepository             $genderRepo,
        StudentCategoryRepository    $categoryRepo,
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
    }

    public function index()
    {
        $data['classes']  = $this->classRepo->assignedAll();
        $data['sections'] = [];
        $data['students'] = $this->repo->all();

        $data['title']    = ___('student_info.Online Admission');
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['online-admissions.search', 'class', 'section'],
            "create-permission" => '',
            "create-route"      => '',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.Dashboard"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.student-info.online-admission.index', compact('data'));
    }

    public function search(Request $request)
    {
        $data['classes']  = $this->classRepo->assignedAll();
        $data['sections'] = $this->classSetupRepo->getSections($request->class);
        $data['request']  = $request;
        $data['students'] = $this->repo->searchStudents($request);

        $data['title']    = ___('student_info.Online Admission');
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['online-admissions.search', 'class', 'section'],
            "create-permission" => '',
            "create-route"      => '',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.Dashboard"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.student-info.online-admission.index', compact('data'));
    }

    public function edit($id)
    {
        $data['title']        = ___('student_info.Admission approval');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => ___("common.Online Admission"), "route" => "online-admissions.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['student']      = $this->repo->show($id);
        $data['classes']      = $this->classRepo->assignedAll();
        $data['sections']     = $this->classSetupRepo->getSections($data['student']->class->id);
        $data['shifts']       = $this->shiftRepo->all();

        $data['bloods']       = $this->bloodRepo->all();
        $data['religions']    = $this->religionRepo->all();
        $data['genders']      = $this->genderRepo->all();
        $data['categories']   = $this->categoryRepo->all();
        return view('backend.admin.student-info.online-admission.edit', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);

        if ($result['status']) {
            return redirect()->route('online-admissions.index')->with('success', $result['message']);
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
