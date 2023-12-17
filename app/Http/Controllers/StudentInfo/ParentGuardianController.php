<?php

namespace App\Http\Controllers\StudentInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Academic\ShiftInterface;
use App\Http\Interfaces\Settings\BloodGroupInterface;
use App\Http\Interfaces\Settings\GenderInterface;
use App\Http\Interfaces\Settings\ReligionInterface;
use App\Http\Interfaces\StudentInfo\ParentGuardianInterface;
use App\Http\Interfaces\StudentInfo\StudentCategoryInterface;
use App\Http\Requests\StudentInfo\ParentGuardian\StoreRequest;
use App\Http\Requests\StudentInfo\ParentGuardian\UpdateRequest;
use App\Http\Requests\StudentInfo\ParentGuardian\StudentStoreRequest;

class ParentGuardianController extends Controller
{
    private $repo, $classRepo, $classSetupRepo, $shiftRepo, $bloodRepo, $religionRepo, $genderRepo, $categoryRepo;

    function __construct(
        ParentGuardianInterface     $repo,
        ClassesInterface            $classRepo,
        ClassSetupInterface         $classSetupRepo,
        ShiftInterface              $shiftRepo,
        BloodGroupInterface         $bloodRepo,
        ReligionInterface           $religionRepo,
        GenderInterface             $genderRepo,
        StudentCategoryInterface    $categoryRepo,
    ) {
        $this->repo            = $repo;
        $this->classRepo       = $classRepo;
        $this->classSetupRepo  = $classSetupRepo;
        $this->shiftRepo       = $shiftRepo;
        $this->bloodRepo       = $bloodRepo;
        $this->religionRepo    = $religionRepo;
        $this->genderRepo      = $genderRepo;
        $this->categoryRepo    = $categoryRepo;
    }

    public function index()
    {
        $title             = ___('common.List');
        $data['headers']   = [
            "title"        => $title,
            "filter"       => ['parent.search', 'class', 'section'],
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___('common.Parent'), "route" => "parent.index"],
            ["title" => $title, "route" => ""]
        ];

        $data['classes']  = $this->classRepo->assignedAll();
        $data['sections'] = [];

        $data['parents'] = [];
        return view('backend.admin.student-info.parent.index', compact('data'));
    }

    public function search(Request $request)
    {
        $title             = ___('common.List');
        $data['headers']   = [
            "title"        => $title,
            "filter"       => ['parent.search', 'class', 'section'],
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___('common.Parent'), "route" => "parent.index"],
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
        $data['title']              = ___('common.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___('common.Parent'), "route" => "parent.index"],
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
        $data['title']       = ___('common.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___('common.Parent'), "route" => "parent.index"],
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
        $data['title']     = ___('common.Add student');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___('common.Parent'), "route" => "parent.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['id']  = $id;
        $data['classes']   = $this->classRepo->assignedAll();
        $data['sections']  = [];
        $data['shifts']    = $this->shiftRepo->allActive();

        $data['bloods']       = $this->bloodRepo->allActive();
        $data['religions']    = $this->religionRepo->allActive();
        $data['genders']      = $this->genderRepo->allActive();
        $data['categories']   = $this->categoryRepo->allActive();

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
