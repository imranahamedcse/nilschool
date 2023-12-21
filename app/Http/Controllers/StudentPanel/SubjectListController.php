<?php

namespace App\Http\Controllers\StudentPanel;

use App\Http\Controllers\Controller;
use App\Http\Repositories\StudentPanel\SubjectListRepository;

class SubjectListController extends Controller
{
    private $repo;

    function __construct( SubjectListRepository $repo)
    {
        $this->repo = $repo;
    }
    public function index(){
        $subjectTeacher = $this->repo->index();

        $title = ___('common.Subject List');
        $data['headers']   = [
            "title"        => $title,
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.student.subject-list', compact('data','subjectTeacher'));
    }
}
