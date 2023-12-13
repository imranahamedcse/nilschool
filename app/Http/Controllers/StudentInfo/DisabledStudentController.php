<?php

namespace App\Http\Controllers\StudentInfo;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentInfo\Inactive\SearchRequest;
use App\Http\Repositories\Academic\ClassesRepository;
use App\Http\Repositories\Academic\ClassSetupRepository;
use App\Http\Repositories\Academic\SectionRepository;
use App\Http\Repositories\StudentInfo\DisabledStudentRepository;
use Illuminate\Http\Request;

class DisabledStudentController extends Controller
{
    private $repo;
    private $classRepo;
    private $sectionRepo;
    private $classSetupRepo;

    function __construct(
        DisabledStudentRepository $repo,
        ClassesRepository         $classRepo,
        SectionRepository         $sectionRepo,
        ClassSetupRepository      $classSetupRepo
        )
    {
        $this->repo              = $repo;
        $this->classRepo         = $classRepo;
        $this->sectionRepo       = $sectionRepo;
        $this->classSetupRepo    = $classSetupRepo;
    }

    public function index()
    {
        $data['title']       = ___('student_info.disabled_list');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = [];
        $students                   = [];
        $request                    = [];
        return view('backend.admin.student-info.disabled-student.index', compact('data','students','request'));

    }

    public function search(SearchRequest $request)
    {
        $data['title']              = ___('student_info.disabled_list');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = $this->classSetupRepo->getSections($request->class);
        $students                   = $this->repo->search($request);
        return view('backend.admin.student-info.disabled-student.index', compact('data','students','request'));
    }
}
