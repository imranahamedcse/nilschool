<?php

namespace App\Http\Controllers\ClassRoom;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Academic\SectionInterface;
use App\Http\Interfaces\Academic\SubjectInterface;
use App\Http\Interfaces\ClassRoom\AssignmentInterface;
use App\Http\Requests\ClassRoom\Assignment\StoreRequest;
use App\Http\Requests\ClassRoom\Assignment\UpdateRequest;

class AssignmentController extends Controller
{
    private $repo;
    private $classRepo;
    private $classSetupRepo;
    private $sectionRepo;
    private $subjectRepo;

    function __construct(
        AssignmentInterface $repo,
        ClassSetupInterface $classSetupRepo,
        ClassesInterface    $classRepo,
        SectionInterface    $sectionRepo,
        SubjectInterface    $subjectRepo,
        )
    {
        $this->repo               = $repo;
        $this->classRepo          = $classRepo;
        $this->classSetupRepo     = $classSetupRepo;
        $this->sectionRepo        = $sectionRepo;
        $this->subjectRepo        = $subjectRepo;
    }

    public function index()
    {
        $title              = ___('common.Assignment');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['assignment.search', 'class', 'section', 'subject'],
            "create-permission"   => 'assignment_create',
            "create-route" => 'assignment.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections'] = [];
        $data['assignments']    = $this->repo->all();
        return view('backend.admin.class_room.assignment.index', compact('data'));
    }

    public function search(Request $request)
    {
        $title              = ___('common.Assignment');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['assignment.search', 'class', 'section', 'subject'],
            "create-permission"   => 'assignment_create',
            "create-route" => 'assignment.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections'] = [];
        $data['assignments']    = $this->repo->search($request);
        return view('backend.admin.class_room.assignment.index', compact('data'));
    }


    public function show(Request $request)
    {
        $data['assignment']        = $this->repo->show($request->id);


        $request = new Request([
            'class'     => $data['assignment']->classes_id,
            'section'   => $data['assignment']->section_id,
            'exam_type' => $data['assignment']->exam_type_id,
            'subject'   => $data['assignment']->subject_id
        ]);

        return view('backend.admin.class_room.assignment.index', compact('data'));
    }

    public function create()
    {
        $data['title']                  = ___('common.Assignment');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.assignment"), "route" => "assignment.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']                = $this->classSetupRepo->all();
        return view('backend.admin.class_room.assignment.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('assignment.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['classes']               = $this->classSetupRepo->all();
        $data['sections']              = $this->sectionRepo->all();

        $data['subjects']              = $this->subjectRepo->all();
        $data['assignment']        = $this->repo->show($id);

        $data['title']                 = ___('common.Assignment');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.assignment"), "route" => "assignment.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $request = new Request([
            'class'     => $data['assignment']->classes_id,
            'section'   => $data['assignment']->section_id,
        ]);
        $request = new Request([
            'class'     => $data['assignment']->classes_id,
            'section'   => $data['assignment']->section_id,
            'exam_type' => $data['assignment']->exam_type_id,
            'subject'   => $data['assignment']->subject_id
        ]);

        return view('backend.admin.class_room.assignment.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('assignment.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {

        $result = $this->repo->destroy($id);
        if($result['status']):
            $success[0] = $result['message'];
            $success[1] = 'success';
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
            return response()->json($success);
        else:
            $success[0] = $result['message'];
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
            return response()->json($success);
        endif;
    }
}
