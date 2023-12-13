<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fees\Collect\FeesCollectStoreRequest;
use App\Http\Requests\Fees\Collect\FeesCollectUpdateRequest;
use App\Http\Interfaces\Fees\FeesCollectInterface;
use App\Http\Repositories\Academic\ClassesRepository;
use App\Http\Repositories\Academic\SectionRepository;
use App\Http\Repositories\Fees\FeesMasterRepository;
use App\Http\Repositories\StudentInfo\StudentRepository;
use Illuminate\Http\Request;
use App\Http\Repositories\Academic\ClassSetupRepository;

class FeesCollectController extends Controller
{
    private $repo;
    private $classRepo;
    private $sectionRepo;
    private $studentRepo;
    private $feesMasterRepo;
    private $classSetupRepo;

    function __construct(
        FeesCollectInterface   $repo,
        ClassesRepository      $classRepo, 
        SectionRepository      $sectionRepo,
        ClassSetupRepository   $classSetupRepo,
        StudentRepository      $studentRepo,
        FeesMasterRepository   $feesMasterRepo,
        )
    {
        $this->repo              = $repo;  
        $this->classRepo         = $classRepo; 
        $this->sectionRepo       = $sectionRepo;
        $this->classSetupRepo    = $classSetupRepo;
        $this->studentRepo       = $studentRepo;
        $this->feesMasterRepo    = $feesMasterRepo;
    }
    
    public function index()
    {
        $data['title']              = ___('fees.fees_collect');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['fees-collect-search', 'class', 'section'],
            "create-permission" => '',
            "create-route"      => '',
        ];
        
        $data['fees_collects']      = $this->repo->getPaginateAll();
        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = [];

        return view('backend.admin.fees.collect.index', compact('data'));
    }

    public function create()
    {
        $data['title']        = ___('fees.fees_collect');
        return view('backend.admin.fees.collect.create', compact('data'));
        
    }

    public function collect($id)
    { // student id
        $data['title']          = ___('fees.Collect');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => ___('fees.fees_collect'), "route" => "fees-collect.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['student']        = $this->studentRepo->show($id);
        $data['fees_assigned']  = $this->repo->feesAssigned($id);

        // dd($data);
        return view('backend.admin.fees.collect.collect', compact('data'));
    }

    public function store(Request $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return back()->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['fees_collect']  = $this->repo->show($id);
        $data['title']         = ___('fees.fees_collect');
        return view('backend.admin.fees.collect.edit', compact('data'));
    }

    public function update(FeesCollectUpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('fees-collect.index')->with('success', $result['message']);
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

    public function getFeesCollectStudents(Request $request)
    {
        $data['title']    = ___('fees.fees_collect');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['fees-collect-search', 'class', 'section'],
            "create-permission" => '',
            "create-route"      => '',
        ];
        
        $data['students'] = $this->repo->getFeesAssignStudents($request);
        $data['classes']  = $this->classRepo->assignedAll();
        $data['sections'] = $this->classSetupRepo->getSections($request->class);
        $data['request']  = $request;

        return view('backend.admin.fees.collect.index', compact('data'));
    }

    public function feesShow(Request $request)
    {
        $data = $this->repo->feesShow($request);
   
        return view('backend.admin.fees.collect.fees-show', compact('data'));
    }


    
}
