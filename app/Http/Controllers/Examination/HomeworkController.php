<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Academic\ClassSetupRepository;
use App\Repositories\Examination\HomeworkRepository;
use App\Http\Requests\Examination\Homework\HomeworkStoreRequest;
use App\Http\Requests\Examination\Homework\HomeworkUpdateRequest;
use App\Repositories\Academic\ClassesRepository;
use App\Repositories\Academic\SectionRepository;
use App\Repositories\Academic\SubjectRepository;

class HomeworkController extends Controller
{
    private $repo;
    private $classRepo;
    private $classSetupRepo;
    private $sectionRepo;
    private $subjectRepo;

    function __construct(
        HomeworkRepository $repo, 
        ClassSetupRepository $classSetupRepo, 
        ClassesRepository $classRepo, 
        SectionRepository $sectionRepo, 
        SubjectRepository $subjectRepo,
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
        $title              = ___('examination.Homework');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['homework.search', 'class', 'section', 'subject'],
            "create-permission"   => 'homework_create',
            "create-route" => 'homework.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections'] = [];
        $data['homeworks']    = $this->repo->getPaginateAll();
        return view('backend.admin.examination.homework.index', compact('data'));
    }

    public function search(Request $request)
    {
        $title              = ___('examination.Homework');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['homework.search', 'class', 'section', 'subject'],
            "create-permission"   => 'homework_create',
            "create-route" => 'homework.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections'] = [];
        $data['homeworks']    = $this->repo->searchMarkRegister($request);
        return view('backend.admin.examination.homework.index', compact('data'));
    }

    
    public function show(Request $request)
    {
        $data['homework']        = $this->repo->show($request->id);

        
        $request = new Request([
            'class'     => $data['homework']->classes_id,
            'section'   => $data['homework']->section_id,
            'exam_type' => $data['homework']->exam_type_id,
            'subject'   => $data['homework']->subject_id
        ]);

        return view('backend.admin.examination.homework.index', compact('data'));
    }

    public function create()
    {
        $data['title']                  = ___('examination.homework');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.Homework"), "route" => "homework.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']                = $this->classSetupRepo->all();
        return view('backend.admin.examination.homework.create', compact('data'));
    }

    public function store(HomeworkStoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('homework.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['classes']               = $this->classSetupRepo->all();
        $data['sections']              = $this->sectionRepo->all();

        $data['subjects']              = $this->subjectRepo->all();
        $data['homework']        = $this->repo->show($id);

        $data['title']                 = ___('examination.homework');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.Homework"), "route" => "homework.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $request = new Request([
            'class'     => $data['homework']->classes_id,
            'section'   => $data['homework']->section_id,
        ]);
        $request = new Request([
            'class'     => $data['homework']->classes_id,
            'section'   => $data['homework']->section_id,
            'exam_type' => $data['homework']->exam_type_id,
            'subject'   => $data['homework']->subject_id
        ]);

        return view('backend.admin.examination.homework.edit', compact('data'));
    }

    public function update(HomeworkUpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('homework.index')->with('success', $result['message']);
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
