<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Frontend\FrontendRepository;
use App\Http\Repositories\Settings\GenderRepository;
use App\Http\Repositories\Settings\ReligionRepository;
use App\Models\WebsiteSetup\Admission;
use App\Models\WebsiteSetup\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdmissionController extends Controller
{
    private $repo;
    private $religionRepo;
    private $genderRepo;

    function __construct(
        FrontendRepository $repo,
        ReligionRepository $religionRepo,
        GenderRepository   $genderRepo,
    )
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users'))
            abort(400);
        $this->repo         = $repo;
        $this->religionRepo = $religionRepo;
        $this->genderRepo   = $genderRepo;
    }

    public function index()
    {
        $data = Admission::where('page_name', 'Admission')->first();
        return view('frontend.admission.admission', compact('data'));
    }

    public function why()
    {
        $data = Admission::where('page_name', 'Why Our School')->first();
        return view('frontend.admission.why', compact('data'));
    }

    public function howTo()
    {
        $data = Admission::where('page_name', 'How to apply')->first();
        return view('frontend.admission.how_to', compact('data'));
    }

    public function process()
    {
        $data = Admission::where('page_name', 'Admission Process')->first();
        return view('frontend.admission.admission_process', compact('data'));
    }

    public function finance()
    {
        $data = Admission::where('page_name', 'Financial Assistances')->first();
        return view('frontend.admission.financial_assistances', compact('data'));
    }

    public function fees()
    {
        $data = Admission::where('page_name', 'Fees')->first();
        return view('frontend.admission.fees', compact('data'));
    }

    public function faq()
    {
        $items = FAQ::active()->orderBy('serial')->get();
        return view('frontend.admission.faq', compact('items'));
    }

    public function campus()
    {
        $data = Admission::where('page_name', 'Campus')->first();
        return view('frontend.admission.campus', compact('data'));
    }

    public function applyOnline()
    {
        $data = $this->repo->result();
        $data['religions']= $this->religionRepo->all();
        $data['genders']  = $this->genderRepo->all();
        return view('frontend.admission.apply_online', compact('data'));
    }

    public function storeApplyOnline(Request $request) {
        return $this->repo->storeApplyOnline($request);
    }
}
