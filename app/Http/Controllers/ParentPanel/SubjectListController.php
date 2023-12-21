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
        return view('backend.parent.subject-list', compact('data'));
    }

    public function search(Request $request)
    {
        $data = $this->repo->search($request);
        return view('backend.parent.subject-list', compact('data'));
    }
}
