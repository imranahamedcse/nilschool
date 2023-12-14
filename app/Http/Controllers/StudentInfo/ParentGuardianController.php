<?php

namespace App\Http\Controllers\StudentInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Academic\ClassesRepository;
use App\Http\Repositories\Academic\ClassSetupRepository;
use App\Http\Repositories\Academic\ShiftRepository;
use App\Http\Repositories\Settings\BloodGroupRepository;
use App\Http\Repositories\Settings\GenderRepository;
use App\Http\Repositories\Settings\ReligionRepository;
use App\Http\Repositories\StudentInfo\ParentGuardianRepository;
use App\Http\Repositories\StudentInfo\StudentCategoryRepository;
use App\Http\Requests\StudentInfo\ParentGuardian\StoreRequest;
use App\Http\Requests\StudentInfo\ParentGuardian\UpdateRequest;
use App\Http\Requests\StudentInfo\ParentGuardian\StudentStoreRequest;

class ParentGuardianController extends Controller
{
    private $repo, $classRepo, $classSetupRepo;
    private $shiftRepo;
    private $bloodRepo;
    private $religionRepo;
    private $genderRepo;
    private $categoryRepo;

    function __construct(
        ParentGuardianRepository $repo,
        ClassesRepository $classRepo,
        ClassSetupRepository $classSetupRepo,
        ShiftRepository   $shiftRepo,
        BloodGroupRepository         $bloodRepo,
        ReligionRepository           $religionRepo,
        GenderRepository             $genderRepo,
        StudentCategoryRepository    $categoryRepo,
    ) {
        $this->repo       = $repo;
        $this->classRepo    = $classRepo;
        $this->classSetupRepo  = $classSetupRepo;
        $this->shiftRepo    = $shiftRepo;
        $this->bloodRepo    = $bloodRepo;
        $this->religionRepo = $religionRepo;
        $this->genderRepo   = $genderRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $title             = ___('student_info.List');
        $data['headers']   = [
            "title"        => $title,
            "filter"       => ['parent.search', 'class', 'section'],
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___('student_info.Parent'), "route" => "parent.index"],
            ["title" => $title, "route" => ""]
        ];

        $data['classes']  = $this->classRepo->assignedAll();
        $data['sections'] = [];

        $data['parents'] = [];
        return view('backend.admin.student-info.parent.index', compact('data'));
    }

    public function search(Request $request)
    {
        $title             = ___('student_info.List');
        $data['headers']   = [
            "title"        => $title,
            "filter"       => ['parent.search', 'class', 'section'],
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___('student_info.Parent'), "route" => "parent.index"],
            ["title" => $title, "route" => ""]
        ];

        $data['classes']  = $this->classRepo->assignedAll();
        $data['sections'] = $this->classSetupRepo->getSections($request->class);
        $data['request']  = $request;
        $data['parents'] = $this->repo->searchParent($request);

        return view('backend.admin.student-info.parent.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('student_info.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___('student_info.Parent'), "route" => "parent.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.student-info.parent.create', compact('data'));
    }

    public function getParent(Request $request)
    {
        $result = $this->repo->getParent($request);
        return response()->json($result);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('parent.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['parent']      = $this->repo->show($id);
        $data['title']       = ___('student_info.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___('student_info.Parent'), "route" => "parent.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.student-info.parent.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result) {
            return redirect()->route('parent.index')->with('success', $result['message']);
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

    public function addStudent($id)
    {
        $data['title']     = ___('student_info.Add student');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___('student_info.Parent'), "route" => "parent.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['id']  = $id;
        $data['classes']   = $this->classRepo->assignedAll();
        $data['sections']  = [];
        $data['shifts']    = $this->shiftRepo->all();

        $data['bloods']       = $this->bloodRepo->all();
        $data['religions']    = $this->religionRepo->all();
        $data['genders']      = $this->genderRepo->all();
        $data['categories']   = $this->categoryRepo->all();

        return view('backend.admin.student-info.parent.add-student', compact('data'));
    }

    public function studentStore(StudentStoreRequest $request)
    {
        $result = $this->repo->studentStore($request);

        if ($result['status']) {
            return redirect()->route('parent.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }
}
