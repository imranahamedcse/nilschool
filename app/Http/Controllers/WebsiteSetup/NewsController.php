<?php

namespace App\Http\Controllers\WebsiteSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\WebsiteSetup\NewsInterface;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\WebsiteSetup\News\StoreRequest;
use App\Http\Requests\WebsiteSetup\News\UpdateRequest;

class NewsController extends Controller
{
    private $newsRepo;

    function __construct(NewsInterface $newsRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->newsRepo = $newsRepo;
    }

    public function index()
    {
        $data['news'] = $this->newsRepo->all();

        $title             = ___('common.News');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'news_create',
            "create-route" => 'news.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.website-setup.news.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add news');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.News"), "route" => "news.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.website-setup.news.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->newsRepo->store($request);
        if($result['status']){
            return redirect()->route('news.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit news');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.News"), "route" => "news.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['news']      = $this->newsRepo->show($id);
        return view('backend.admin.website-setup.news.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->newsRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('news.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->newsRepo->destroy($id);
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
