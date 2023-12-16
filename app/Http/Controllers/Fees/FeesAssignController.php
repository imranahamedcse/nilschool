<?php

namespace App\Http\Controllers\Fees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Academic\SectionInterface;
use App\Http\Requests\Fees\Assign\StoreRequest;
use App\Http\Requests\Fees\Assign\UpdateRequest;
use App\Http\Interfaces\Fees\FeesTypeInterface;
use App\Http\Interfaces\Fees\FeesGroupInterface;
use App\Http\Interfaces\Fees\FeesAssignInterface;
use App\Http\Interfaces\Fees\FeesMasterInterface;
use App\Http\Interfaces\Settings\GenderInterface;
use App\Http\Interfaces\StudentInfo\StudentCategoryInterface;
use App\Http\Interfaces\StudentInfo\StudentInterface;

class FeesAssignController extends Controller
{
    private $repo;
    private $typeRepo;
    private $groupRepo;
    private $feesMasterRepo;
    private $genderRepo;
    private $categoryRepo;
    private $classRepo;
    private $sectionRepo;
    private $classSetupRepo;
    private $studentRepo;

    function __construct(
        FeesAssignInterface $repo,
        FeesTypeInterface $typeRepo,
        FeesGroupInterface $groupRepo,
        FeesMasterInterface $feesMasterRepo,
        GenderInterface $genderRepo,
        StudentCategoryInterface $categoryRepo,
        ClassesInterface $classRepo,
        SectionInterface $sectionRepo,
        ClassSetupInterface $classSetupRepo,
        StudentInterface $studentRepo
    ) {
        $this->repo              = $repo;
        $this->typeRepo          = $typeRepo;
        $this->groupRepo         = $groupRepo;
        $this->feesMasterRepo    = $feesMasterRepo;
        $this->genderRepo        = $genderRepo;
        $this->categoryRepo      = $categoryRepo;
        $this->classRepo         = $classRepo;
        $this->sectionRepo       = $sectionRepo;
        $this->classSetupRepo    = $classSetupRepo;
        $this->studentRepo       = $studentRepo;
    }

    public function index()
    {
        $data['fees_assigns'] = $this->repo->all();

        $title             = ___('fees.fees_assign');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'fees_assign_create',
            "create-route" => 'fees-assign.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.fees.assign.index', compact('data'));
    }

    public function show(Request $request)
    {

        $data['fees_assign']  = $this->repo->show($request->id);
        return view('backend.admin.fees.assign.view', compact('data'))->render();
    }

    public function create()
    {
        $data['title']        = ___('fees.Add fees assign');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => ___("common.Fees assign"), "route" => "fees-assign.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']      = $this->classRepo->assignedAll();
        $data['sections']     = [];
        $data['fees_groups']  = $this->feesMasterRepo->allGroups();
        $data['genders']      = $this->genderRepo->allActive();
        $data['categories']   = $this->categoryRepo->allActive();
        return view('backend.admin.fees.assign.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('fees-assign.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message'])->withInput();
    }

    public function edit($id)
    {
        $data['title']        = ___('fees.Edit fees assign');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => ___("common.Fees assign"), "route" => "fees-assign.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['fees_assign']  = $this->repo->show($id);
        $data['classes']      = $this->classRepo->assignedAll();
        $data['sections']     = $this->classSetupRepo->getSections($data['fees_assign']->classes_id);
        $data['fees_groups']  = $this->feesMasterRepo->allGroups();

        $data['assigned_fes_masters']  =  array_unique($data['fees_assign']->feesAssignChilds->pluck('fees_master_id')->toArray());

        $data['fees_masters']  = $this->feesMasterRepo->all()->where('fees_group_id', $data['fees_assign']->fees_group_id);

        $data['genders']      = $this->genderRepo->allActive();
        $data['categories']   = $this->categoryRepo->allActive();

        $request = new Request();
        $request->replace(['class' => $data['fees_assign']->classes_id, 'section' => $data['fees_assign']->section_id, 'gender' => $data['fees_assign']->gender_id]);

        $data['students']     = $this->studentRepo->getStudents($request);

        return view('backend.admin.fees.assign.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('fees-assign.index')->with('success', $result['message']);
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

    public function getFeesAssignStudents(Request $request)
    {
        $students = $this->repo->getFeesAssignStudents($request);
        return view('backend.admin.fees.assign.fees-assing-students-list', compact('students'))->render();
    }

    public function getAllTypes(Request $request)
    {
        $types = $this->repo->groupTypes($request);
        return view('backend.admin.fees.assign.fees-types', compact('types'))->render();
    }
}
