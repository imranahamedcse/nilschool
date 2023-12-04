<?php

namespace App\Http\Controllers\ClassRoom;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Academic\ClassSetupRepository;
use App\Repositories\ClassRoom\PostRepository;
use App\Http\Requests\ClassRoom\Post\PostStoreRequest;
use App\Http\Requests\ClassRoom\Post\PostUpdateRequest;
use App\Repositories\Academic\ClassesRepository;
use App\Repositories\Academic\SectionRepository;
use App\Repositories\Academic\SubjectRepository;

class PostController extends Controller
{
    private $repo;
    private $classRepo;
    private $classSetupRepo;
    private $sectionRepo;
    private $subjectRepo;

    function __construct(
        PostRepository $repo, 
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
        $title              = ___('examination.Post');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['post.search', 'class', 'section', 'subject'],
            "create-permission"   => 'post_create',
            "create-route" => 'post.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections'] = [];
        $data['posts']    = $this->repo->getPaginateAll();
        return view('backend.admin.class_room.post.index', compact('data'));
    }

    public function search(Request $request)
    {
        $title              = ___('examination.Post');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['post.search', 'class', 'section', 'subject'],
            "create-permission"   => 'post_create',
            "create-route" => 'post.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections'] = [];
        $data['posts']    = $this->repo->searchMarkRegister($request);
        return view('backend.admin.class_room.post.index', compact('data'));
    }

    
    public function show(Request $request)
    {
        $data['post']        = $this->repo->show($request->id);

        
        $request = new Request([
            'class'     => $data['post']->classes_id,
            'section'   => $data['post']->section_id,
            'exam_type' => $data['post']->exam_type_id,
            'subject'   => $data['post']->subject_id
        ]);

        return view('backend.admin.class_room.post.index', compact('data'));
    }

    public function create()
    {
        $data['title']                  = ___('examination.Post');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.post"), "route" => "post.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']                = $this->classSetupRepo->all();
        return view('backend.admin.class_room.post.create', compact('data'));
    }

    public function store(postStoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('post.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['classes']               = $this->classSetupRepo->all();
        $data['sections']              = $this->sectionRepo->all();

        $data['subjects']              = $this->subjectRepo->all();
        $data['post']        = $this->repo->show($id);

        $data['title']                 = ___('examination.Post');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.post"), "route" => "post.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $request = new Request([
            'class'     => $data['post']->classes_id,
            'section'   => $data['post']->section_id,
        ]);
        $request = new Request([
            'class'     => $data['post']->classes_id,
            'section'   => $data['post']->section_id,
            'exam_type' => $data['post']->exam_type_id,
            'subject'   => $data['post']->subject_id
        ]);

        return view('backend.admin.class_room.post.edit', compact('data'));
    }

    public function update(postUpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('post.index')->with('success', $result['message']);
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
