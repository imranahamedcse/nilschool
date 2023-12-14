<?php

namespace App\Http\Controllers\StudentInfo;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentInfo\PromoteStudent\SearchRequest;
use App\Http\Repositories\Academic\ClassesRepository;
use App\Http\Repositories\Academic\ClassSetupRepository;
use App\Http\Repositories\Academic\SectionRepository;
use App\Http\Repositories\Settings\SessionRepository;
use App\Http\Repositories\StudentInfo\PromoteStudentRepository;
use Illuminate\Http\Request;

class PromoteStudentController extends Controller
{
    private $repo;
    private $classRepo;
    private $sectionRepo;
    private $sessionRepo;
    private $classSetupRepo;

    function __construct(
        PromoteStudentRepository $repo,
        ClassesRepository        $classRepo,
        SectionRepository        $sectionRepo,
        SessionRepository        $sessionRepo,
        ClassSetupRepository     $classSetupRepo,
        )
    {
        $this->repo              = $repo;
        $this->classRepo         = $classRepo;
        $this->sectionRepo       = $sectionRepo;
        $this->sessionRepo       = $sessionRepo;
        $this->classSetupRepo    = $classSetupRepo;
    }

    public function index()
    {
        $data['title']              = ___('student_info.Promote');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['student_categories'] = $this->repo->allActive();
        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = [];
        $data['sessions']           = $this->sessionRepo->all();
        $data['promoteClasses']     = [];
        $data['promoteSections']    = [];
        $students                   = [];
        $request                    = [];
        $results                    = [''];
        return view('backend.admin.student-info.promote-student.index', compact('data','students','results','request'));

    }

    public function search(SearchRequest $request)
    {
        $data['title']              = ___('student_info.Promote');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['student_categories'] = $this->repo->allActive();
        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = $this->classSetupRepo->getSections($request->class);
        $data['sessions']           = $this->sessionRepo->all();
        $data['promoteClasses']     = $this->classSetupRepo->promoteClasses($request->promote_session);
        $data['promoteSections']    = $this->classSetupRepo->promoteSections($request->promote_session, $request->promote_class);

        $items                      = $this->repo->search($request);
        $students                   = $items['data']['students'];
        $results                    = $items['data']['results'];


        return view('backend.admin.student-info.promote-student.index', compact('data','students','results','request'));
    }

    public function store(Request $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            $data['title']              = ___('student_info.Promote');
            $data['student_categories'] = $this->repo->allActive();
            $data['classes']            = $this->classRepo->assignedAll();
            $data['sections']           = $this->classSetupRepo->getSections($request->class);
            $data['sessions']           = $this->sessionRepo->all();
            $data['promoteClasses']     = $this->classSetupRepo->promoteClasses($request->promote_session);
            $data['promoteSections']    = $this->classSetupRepo->promoteSections($request->promote_session, $request->promote_class);

            return redirect()->route('promote_students.index')->with('success', $result['message']);
        }
        return redirect()->route('promote_students.index')->with('danger', $result['message'])->withInput();
    }

    public function getClass(Request $request){
        return $this->repo->getClass($request);
    }

    public function getSections(Request $request){
        return $this->repo->getSections($request);
    }

}
