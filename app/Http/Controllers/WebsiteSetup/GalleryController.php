<?php

namespace App\Http\Controllers\WebsiteSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\WebsiteSetup\GalleryCategoryInterface;
use App\Http\Interfaces\WebsiteSetup\GalleryInterface;
use App\Http\Requests\WebsiteSetup\Gallery\StoreRequest;
use App\Http\Requests\WebsiteSetup\Gallery\UpdateRequest;
use Illuminate\Support\Facades\Schema;

class GalleryController extends Controller
{
    private $Repo, $categoryRepo;

    function __construct(GalleryInterface $Repo, GalleryCategoryInterface $categoryRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->Repo  = $Repo;
        $this->categoryRepo  = $categoryRepo;
    }

    public function index()
    {
        $data['gallery'] = $this->Repo->all();

        $title             = ___('common.Images');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'gallery_create',
            "create-route" => 'gallery.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.website-setup.gallery.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Create Image');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Images"), "route" => "gallery.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['categories']  = $this->categoryRepo->allActive();
        return view('backend.admin.website-setup.gallery.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->Repo->store($request);
        if($result['status']){
            return redirect()->route('gallery.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit Image');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Images"), "route" => "gallery.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['gallery']     = $this->Repo->show($id);
        $data['categories']  = $this->categoryRepo->allActive();
        return view('backend.admin.website-setup.gallery.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->Repo->update($request, $id);
        if($result['status']){
            return redirect()->route('gallery.index')->with('success', $result['message']);
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
