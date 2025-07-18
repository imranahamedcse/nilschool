<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Settings\GenderRepository;
use Illuminate\Support\Facades\Schema;
use App\Http\Repositories\Settings\ReligionRepository;
use App\Http\Repositories\Frontend\FrontendRepository;
use App\Http\Requests\Frontend\SearchResultRequest;
use App\Http\Repositories\Report\MarksheetRepository;
use App\Http\Repositories\StudentInfo\StudentRepository;
use PDF;

class FrontendController extends Controller
{
    private $repo;
    private $religionRepo;
    private $genderRepo;
    private $marksheetRepo;
    private $studentRepo;

    function __construct(
        FrontendRepository $repo,
        ReligionRepository $religionRepo,
        GenderRepository   $genderRepo,
        MarksheetRepository    $marksheetRepo,
        StudentRepository      $studentRepo,
    )
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users'))
            abort(400);
        $this->repo         = $repo;
        $this->religionRepo = $religionRepo;
        $this->genderRepo   = $genderRepo;
        $this->marksheetRepo      = $marksheetRepo;
        $this->studentRepo        = $studentRepo;
    }

    public function index()
    {
        $data['sliders']          = $this->repo->sliders();
        $data['counters']         = $this->repo->counters();
        $data['galleryCategory']  = $this->repo->galleryCategory();
        $data['gallery']          = $this->repo->gallery();
        $data['latestNews']       = $this->repo->latestNews();
        $data['comingEvents']     = $this->repo->comingEvents();

        return view('frontend.home', compact('data'));
    }

    // Result
    public function getClasses(Request $request){
        $data = $this->repo->getClasses($request); // session id
        return response()->json($data);
    }
    public function getSections(Request $request){
        $data = $this->repo->getSections($request); // class id
        return response()->json($data);
    }
    public function getExamType(Request $request)
    {
        $result = $this->repo->getExamType($request);
        return response()->json($result, 200);
    }
    
    public function about()
    {
        $data                = $this->repo->abouts();
        $data['title']       = ___('common.About us');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "frontend.home"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('frontend.about', compact('data'));
    }

    // Blog
    public function news()
    {
        $data['news']        = $this->repo->news();
        $data['title']       = ___('common.News');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "frontend.home"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('frontend.news', compact('data'));
    }
    public function newsDetail($id)
    {
        $data['allNews'] = $this->repo->news();
        $data['news']    = $this->repo->newsDetail($id);
        $data['title']       = ___('common.News details');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "frontend.home"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('frontend.news-detail', compact('data'));
    }

    // Event
    public function events()
    {
        $data['events']      = $this->repo->events();
        $data['news']        = $this->repo->news();
        $data['title']       = ___('common.Events');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "frontend.home"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('frontend.events', compact('data'));
    }
    public function eventDetail($id)
    {
        $data['allEvent'] = $this->repo->events();
        $data['event']    = $this->repo->eventDetail($id);
        $data['title']       = ___('common.Event details');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "frontend.home"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('frontend.event-detail', compact('data'));
    }

    // Contact
    public function contact()
    {
        $data['contactInfo'] = $this->repo->contactInfo();
        $data['depContact']  = $this->repo->depContact();
        $data['title']       = ___('common.Contact Us');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "frontend.home"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('frontend.contact', compact('data'));
    }

    // onlineAdmission
    public function onlineAdmission()
    {
        $data = $this->repo->result();
        $data['religions']= $this->religionRepo->all();
        $data['genders']  = $this->genderRepo->all();
        $data['title']       = ___('common.Online admission');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "frontend.home"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('frontend.online-admission', compact('data'));
    }

    public function storeOnlineAdmission(Request $request) {
        return $this->repo->onlineAdmission($request);
    }

    public function storeContact(Request $request)
    {
        return $this->repo->contact($request);
    }

    public function storeSubscribe(Request $request)
    {
        return $this->repo->subscribe($request);
    }
}
