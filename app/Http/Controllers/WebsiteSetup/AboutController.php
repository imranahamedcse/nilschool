<?php

namespace App\Http\Controllers\WebsiteSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\WebsiteSetup\AboutInterface;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\WebsiteSetup\About\StoreRequest;
use App\Http\Requests\WebsiteSetup\About\UpdateRequest;

class AboutController extends Controller
{
    private $aboutRepo;

    function __construct(AboutInterface $aboutRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->aboutRepo                  = $aboutRepo;
    }

    public function index()
    {
        $data['about'] = $this->aboutRepo->all();

        $title             = ___('common.About');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'about_create',
            "create-route" => 'about.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.website-setup.about.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add about');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.About"), "route" => "about.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.website-setup.about.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->aboutRepo->store($request);
        if($result['status']){
            return redirect()->route('about.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit about');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.About"), "route" => "about.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['about']      = $this->aboutRepo->show($id);
        return view('backend.admin.website-setup.about.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->aboutRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('about.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->aboutRepo->destroy($id);
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
