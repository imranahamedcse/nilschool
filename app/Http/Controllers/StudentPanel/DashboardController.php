<?php

namespace App\Http\Controllers\StudentPanel;

use App\Http\Controllers\Controller;
use App\Models\Search;
use App\Repositories\StudentPanel\DashboardRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $repo;

    function __construct( DashboardRepository $repo)
    { 
        $this->repo = $repo; 
    }

    public function index(){
        $data = $this->repo->index();
        return view('student-panel.dashboard', compact('data'));
    }

    public function searchStudentMenuData(Request $request){
        try {
            $search = Search::query()
                    ->when(request()->filled('search'), fn ($q) => $q->where('title', 'like', '%' . $request->search . '%'))
                    ->where('user_type', 'Student')
                    ->take(10)
                    ->get()
                    ->map(function ($item) {
                        return [
                            'title' => $item->title,
                            'route_name' => route($item->route_name)
                        ];
                    });


            return response()->json($search);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
