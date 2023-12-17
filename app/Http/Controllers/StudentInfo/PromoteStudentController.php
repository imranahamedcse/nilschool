<?php

namespace App\Http\Controllers\StudentInfo;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Settings\SessionInterface;
use App\Http\Interfaces\StudentInfo\PromoteStudentInterface;
use App\Http\Requests\StudentInfo\PromoteStudent\SearchRequest;
use Illuminate\Http\Request;

class PromoteStudentController extends Controller
{
    private $repo, $classRepo, $sessionRepo, $classSetupRepo;

    function __construct(
        PromoteStudentInterface $repo,
        ClassesInterface        $classRepo,
        SessionInterface        $sessionRepo,
        ClassSetupInterface     $classSetupRepo,
    ) {
        $this->repo              = $repo;
        $this->classRepo         = $classRepo;
        $this->sessionRepo       = $sessionRepo;
        $this->classSetupRepo    = $classSetupRepo;
    }

    public function index()
    {
        $data['title']              = ___('common.Promote');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['student_categories'] = $this->repo->allActive();
        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = [];
        $data['sessions']           = $this->sessionRepo->allActive();
        $data['promoteClasses']     = [];
        $data['promoteSections']    = [];
        $students                   = [];
        $request                    = [];
        $results                    = [''];
        return view('backend.admin.student-info.promote-student.index', compact('data', 'students', 'results', 'request'));
    }

    public function search(SearchRequest $request)
    {
        $data['title']              = ___('common.Promote');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['student_categories'] = $this->repo->allActive();
        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = $this->classSetupRepo->getSections($request->class);
        $data['sessions']           = $this->sessionRepo->allActive();
        $data['promoteClasses']     = $this->classSetupRepo->promoteClasses($request->promote_session);
        $data['promoteSections']    = $this->classSetupRepo->promoteSections($request->promote_session, $request->promote_class);

        $items                      = $this->repo->search($request);
        $students                   = $items['data']['students'];
        $results                    = $items['data']['results'];


        return view('backend.admin.student-info.promote-student.index', compact('data', 'students', 'results', 'request'));
    }

    public function store(Request $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            $data['title']              = ___('common.Promote');
            $data['student_categories'] = $this->repo->allActive();
            $data['classes']            = $this->classRepo->assignedAll();
            $data['sections']           = $this->classSetupRepo->getSections($request->class);
            $data['sessions']           = $this->sessionRepo->allActive();
            $data['promoteClasses']     = $this->classSetupRepo->promoteClasses($request->promote_session);
            $data['promoteSections']    = $this->classSetupRepo->promoteSections($request->promote_session, $request->promote_class);

            return redirect()->route('promote-students.index')->with('success', $result['message']);
        }
        return redirect()->route('promote-students.index')->with('danger', $result['message'])->withInput();
    }

    public function getClass(Request $request)
    {
        return $this->repo->getClass($request);
    }

    public function getSections(Request $request)
    {
        return $this->repo->getSections($request);
    }
}
