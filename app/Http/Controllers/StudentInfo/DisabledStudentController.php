<?php

namespace App\Http\Controllers\StudentInfo;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\StudentInfo\DisabledStudentInterface;
use App\Http\Requests\StudentInfo\Inactive\SearchRequest;
use Illuminate\Http\Request;

class DisabledStudentController extends Controller
{
    private $repo, $classRepo, $classSetupRepo;

    function __construct(
        DisabledStudentInterface $repo,
        ClassesInterface         $classRepo,
        ClassSetupInterface      $classSetupRepo
    ) {
        $this->repo              = $repo;
        $this->classRepo         = $classRepo;
        $this->classSetupRepo    = $classSetupRepo;
    }

    public function index()
    {
        $title             = ___('common.inactive_list');
        $data['headers']   = [
            "title"        => $title,
            "filter"       => ['disabled-students.search', 'class', 'section'],
        ];
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = [];
        $students                   = [];
        $request                    = [];
        return view('backend.admin.student-info.disabled-student.index', compact('data', 'students', 'request'));
    }

    public function search(SearchRequest $request)
    {
        $title             = ___('common.inactive_list');
        $data['headers']   = [
            "title"        => $title,
            "filter"       => ['disabled-students.search', 'class', 'section'],
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = $this->classSetupRepo->getSections($request->class);
        $data['request']  = $request;
        $students                   = $this->repo->search($request);
        return view('backend.admin.student-info.disabled-student.index', compact('data', 'students', 'request'));
    }
}
