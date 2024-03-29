<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Frontend\FrontendRepository;
use App\Http\Repositories\ParentPanel\MarksheetRepository;
use App\Http\Repositories\StudentInfo\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Frontend\SearchResultRequest;
use App\Models\WebsiteSetup\DownloadableForm;
use App\Models\WebsiteSetup\LessonPlan;
use App\Models\WebsiteSetup\Information;
use PDF;

class InformationController extends Controller
{
    private $repo;
    private $marksheetRepo;
    private $studentRepo;

    function __construct(
        FrontendRepository     $repo,
        MarksheetRepository    $marksheetRepo,
        StudentRepository    $studentRepo,
    )
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users'))
            abort(400);
        $this->repo           = $repo;
        $this->marksheetRepo  = $marksheetRepo;
        $this->studentRepo    = $studentRepo;
    }

    public function index()
    {
        $data = Information::where('page_name', 'Information')->first();
        return view('frontend.information.information', compact('data'));
    }

    public function career()
    {
        $data = Information::where('page_name', 'Career')->first();
        return view('frontend.information.career', compact('data'));
    }

    public function downloadableForms()
    {
        $forms = DownloadableForm::active()->orderBy('serial')->paginate(15);
        return view('frontend.information.downloadable_forms', compact('forms'));
    }

    public function lessonPlan()
    {
        $plans = LessonPlan::active()->orderBy('serial')->paginate(15);
        return view('frontend.information.lesson_plan', compact('plans'));
    }

    public function payment()
    {
        $data = Information::where('page_name', 'Payment')->first();
        return view('frontend.information.payment', compact('data'));
    }

    public function result()
    {
        $data = $this->repo->result();
        $data['result'] = null;
        return view('frontend.information.result', compact('data'));
    }

    public function searchResult(SearchResultRequest $request){
        $data = $this->repo->searchResult($request);
        if(!$data)
        {
            $data = $this->repo->result();
            $data['result'] = "Result not found!";
            return view('frontend.information.result', compact('data'));
        }
        $data['request'] = $request;
        return view('frontend.information.search_result', compact('data'));
    }

    public function downloadPDF($id, $type, $class, $section)
    {
        $request = new Request([
            'student'   => $id,
            'exam_type' => $type,
            'class'     => $class,
            'section'   => $section,
        ]);

        $data['student']      = $this->studentRepo->show($request->student);
        $data['resultData']   = $this->marksheetRepo->search($request);

        $pdf = PDF::loadView('backend.report.marksheetPDF', compact('data'));
        return $pdf->download('marksheet'.'_'.date('d_m_Y').'_'.@$data['student']->first_name .'_'. @$data['student']->last_name .'.pdf');
    }
}
