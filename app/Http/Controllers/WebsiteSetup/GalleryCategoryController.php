<?php

namespace App\Http\Controllers\WebsiteSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebsiteSetup\GalleryCategory\GalleryCategoryStoreRequest;
use App\Http\Requests\WebsiteSetup\GalleryCategory\GalleryCategoryUpdateRequest;
use App\Http\Repositories\WebsiteSetup\GalleryCategoryRepository;
use Illuminate\Support\Facades\Schema;

class GalleryCategoryController extends Controller
{
    private $Repo;


    function __construct(GalleryCategoryRepository $Repo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->Repo                  = $Repo;
    }

    public function index()
    {
        $data['gallery_category'] = $this->Repo->getAll();

        $title             = ___('settings.Gallery category');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'gallery_category_create',
            "create-route" => 'gallery-category.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.website-setup.gallery-category.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('website.Add Gallery Category');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Gallery category"), "route" => "gallery-category.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.website-setup.gallery-category.create', compact('data'));
    }

    public function store(GalleryCategoryStoreRequest $request)
    {
        $result = $this->Repo->store($request);
        if($result['status']){
            return redirect()->route('gallery-category.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('website.Edit Gallery Category');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Gallery category"), "route" => "gallery-category.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['gallery_category']      = $this->Repo->show($id);
        return view('backend.admin.website-setup.gallery-category.edit', compact('data'));
    }

    public function update(GalleryCategoryUpdateRequest $request, $id)
    {
        $result = $this->Repo->update($request, $id);
        if($result['status']){
            return redirect()->route('gallery-category.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->Repo->destroy($id);
        if($result['status']):
            $success[0] = $result['message'];
            $success[1] = 'success';
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
            return response()->json($success);
        else:
            $success[0] = $result['message'];
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
            return response()->json($success);
        endif;
    }
}
