<?php

namespace App\Http\Controllers\WebsiteSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Repositories\WebsiteSetup\SliderRepository;
use App\Http\Requests\WebsiteSetup\Slider\SliderStoreRequest;
use App\Http\Requests\WebsiteSetup\Slider\SliderUpdateRequest;
use App\Http\Repositories\WebsiteSetup\SectionsRepository;

class SectionsController extends Controller
{
    private $sectionsRepo;

    function __construct(SectionsRepository $sectionsRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->sectionsRepo                  = $sectionsRepo;
    }

    public function index()
    {
        $data['sections'] = $this->sectionsRepo->getAll();

        $title             = ___('settings.Sections');
        $data['headers']   = [
            "title"        => $title
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.website-setup.sections.index', compact('data'));
    }

    public function edit($id)
    {
        $data['title']       = ___('website.Edit sections');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Sections"), "route" => "sections.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['sections']    = $this->sectionsRepo->show($id);
        return view('backend.admin.website-setup.sections.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->sectionsRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('sections.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function addSocialLink(Request $request)
    {
        return view('backend.admin.website-setup.sections.add_social_link')->render();
    }

    public function addChooseUs(Request $request)
    {
        return view('backend.admin.website-setup.sections.add_choose_us')->render();
    }

    public function addAcademicCurriculum(Request $request)
    {
        return view('backend.admin.website-setup.sections.add_academic_curriculum')->render();
    }


}
