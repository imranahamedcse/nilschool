<?php

namespace App\Http\Controllers\ParentPanel;

use App\Http\Controllers\Controller;
use App\Models\Search;
use App\Models\StudentInfo\ParentGuardian;
use Illuminate\Http\Request;
use App\Models\StudentInfo\Student;
use App\Http\Repositories\ParentPanel\DashboardRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    private $repo;

    function __construct(DashboardRepository $repo)
    {
        $this->repo               = $repo;
    }

    public function index()
    {
        $data = $this->repo->index();
        return view('backend.parent.dashboard', compact('data'));
    }

    public function search(Request $request)
    {
        $data = $this->repo->search($request);
        return view('backend.parent.dashboard', compact('data'));
    }

    public function searchParentMenuData(Request $request){
        try {
            $search = Search::query()
                    ->when(request()->filled('search'), fn ($q) => $q->where('title', 'like', '%' . $request->search . '%'))
                    ->where('user_type', 'Parent')
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
