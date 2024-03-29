<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Frontend\FrontendRepository;
use App\Models\WebsiteSetup\Academic;
use App\Models\WebsiteSetup\AcademicCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AcademicController extends Controller
{
    private $repo;

    function __construct(
        FrontendRepository $repo,
    )
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users'))
            abort(400);
        $this->repo         = $repo;
    }

    public function index()
    {
        $data = Academic::where('page_name', 'Academic')->first();
        return view('frontend.academic.academic', compact('data'));
    }
    public function blog()
    {
        $data = $this->repo->abouts();
        return view('frontend.academic.blog', compact('data'));
    }
    public function teacher()
    {
        $data = $this->repo->abouts();
        return view('frontend.academic.teacher', compact('data'));
    }
    public function calendar()
    {
        $items = AcademicCalendar::active()->orderBy('serial')->get();
        return view('frontend.academic.calendar', compact('items'));
    }
    public function curriculum()
    {
        $data = Academic::where('page_name', 'Our Curriculum')->first();
        return view('frontend.academic.curriculum', compact('data'));
    }
    public function facilities()
    {
        $data = Academic::where('page_name', 'Facilities')->first();
        return view('frontend.academic.facilities', compact('data'));
    }
    public function management()
    {
        $data = Academic::where('page_name', 'Management')->first();
        return view('frontend.academic.management', compact('data'));
    }
    public function serviceSupport()
    {
        $data = Academic::where('page_name', 'Services & Supports')->first();
        return view('frontend.academic.service_support', compact('data'));
    }
    public function syllabus()
    {
        $data = Academic::where('page_name', 'Syllabus')->first();
        return view('frontend.academic.syllabus', compact('data'));
    }

    public function notices()
    {
        $data['notices'] = $this->repo->notices();
        return view('frontend.academic.notices', compact('data'));
    }
    public function noticeDetail($id)
    {
        $data['allNotice'] = $this->repo->notices();
        $data['notice-board'] = $this->repo->noticeDetail($id);
        return view('frontend.academic.notice-detail', compact('data'));
    }
    public function gallery()
    {
        $data['galleryCategory']  = $this->repo->galleryCategory();
        $data['gallery']          = $this->repo->galleryAll();

        return view('frontend.academic.gallery', compact('data'));
    }
}
