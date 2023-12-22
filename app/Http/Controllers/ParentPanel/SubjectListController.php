<?php

namespace App\Http\Controllers\ParentPanel;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ParentPanel\SubjectListRepository;
use Illuminate\Http\Request;

class SubjectListController extends Controller
{
    private $repo;

    function __construct( SubjectListRepository $repo)
    {
        $this->repo = $repo;
    }
    
    public function index(){
        $data = $this->repo->index();

        $title = ___('common.Subject List');
        $data['headers']   = [
            "title"        => $title,
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.parent.subject-list', compact('data'));
    }
}
