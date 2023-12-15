<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Http\Interfaces\Staff\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Settings\SessionInterface;
use App\Traits\ApiReturnFormatTrait;
use App\Http\Interfaces\Academic\ShiftInterface;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Academic\SectionInterface;
use App\Http\Interfaces\Academic\SubjectInterface;
use App\Models\Academic\SubjectAssignChildren;
use App\Http\Interfaces\Academic\SubjectAssignInterface;
use App\Http\Requests\Academic\SubjectAssign\StoreRequest;
use App\Http\Requests\Academic\SubjectAssign\UpdateRequest;

class SubjectAssignController extends Controller
{
    use ApiReturnFormatTrait;

    private $repo, $sessionRepo, $classesRepo, $sectionRepo, $shiftRepo, $subjectRepo, $staffRepo, $classSetupRepo;

    function __construct(
        SubjectAssignInterface $repo,
        SessionInterface       $sessionRepo,
        ClassesInterface       $classesRepo,
        SectionInterface       $sectionRepo,
        ShiftInterface         $shiftRepo,
        SubjectInterface       $subjectRepo,
        UserInterface          $staffRepo,
        ClassSetupInterface    $classSetupRepo,
    ) {
        $this->repo              = $repo;
        $this->sessionRepo       = $sessionRepo;
        $this->classesRepo       = $classesRepo;
        $this->sectionRepo       = $sectionRepo;
        $this->shiftRepo         = $shiftRepo;
        $this->subjectRepo       = $subjectRepo;
        $this->staffRepo         = $staffRepo;
        $this->classSetupRepo    = $classSetupRepo;
    }

    public function index()
    {
        $data['subject_assigns']    = $this->repo->all();


        $title             = ___('academic.subject_assign');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'subject_assign_create',
            "create-route" => 'assign-subject.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.academic.assign-subject.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('academic.Add subject assign');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Subject Assign"), "route" => "assign-subject.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']            = $this->classesRepo->assignedAll();
        $data['sections']           = [];
        $data['shifts']             = $this->shiftRepo->allActive();
        return view('backend.admin.academic.assign-subject.create', compact('data'));
    }

    public function addSubjectTeacher(Request $request)
    {
        $counter          = $request->counter;
        $data['subjects'] = $this->subjectRepo->allActive();
        $data['teachers'] = $this->staffRepo->allActive();
        return view('backend.admin.academic.assign-subject.add-subject-teacher', compact('counter', 'data'))->render();
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('assign-subject.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function show(Request $request)
    {

        $data['subject_assign_children'] = SubjectAssignChildren::where('subject_assign_id', $request->id)->get();

        return view('backend.admin.academic.assign-subject.view', compact('data'))->render();
    }

    public function getSubjects(Request $request)
    {
        $result = $this->repo->getSubjects($request);
        return response()->json($result, 200);
    }

    public function edit($id)
    {

        $data                       = $this->repo->show($id);
        $data['title']              = ___('academic.Edit subject assign');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Subject Assign"), "route" => "assign-subject.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['subject_assign']     = $data['row'];
        $data['assignSubjects']     = $data['assignSubjects'];
        $data['disabled']           = $data['disabled'];
        $data['redirect']           = $data['redirect'];
        $data['classes']            = $this->classesRepo->assignedAll();
        $data['sections']           = $this->classSetupRepo->getSections($data['subject_assign']->classes_id);
        $data['shifts']             = $this->shiftRepo->allActive();
        $data['subjects']           = $this->subjectRepo->allActive();
        $data['teachers']           = $this->staffRepo->allActive();
        $data['all_subject_assign'] = $data['subject_assign']->subjectTeacher->pluck('subject_id')->toArray();

        return view('backend.admin.academic.assign-subject.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('assign-subject.index')->with('success', $result['message']);
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

    public function checkSection(Request $request)
    {
        $result = $this->repo->checkSection($request);
        return response()->json($result, 200);
    }

    public function checkExamAssign($id)
    {
        $result = $this->repo->checkExamAssign($id);
        return response()->json($result, 200);
    }
}
