<?php

namespace App\Http\Controllers\WebsiteSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\WebsiteSetup\CounterInterface;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\WebsiteSetup\Counter\StoreRequest;
use App\Http\Requests\WebsiteSetup\Counter\UpdateRequest;

class CounterController extends Controller
{
    private $counterRepo;

    function __construct(CounterInterface $counterRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->counterRepo                  = $counterRepo;
    }

    public function index()
    {
        $data['counter'] = $this->counterRepo->all();

        $title             = ___('common.Counter');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'counter_create',
            "create-route" => 'counter.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.website-setup.counter.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Create counter');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Counter"), "route" => "counter.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.website-setup.counter.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->counterRepo->store($request);
        if($result['status']){
            return redirect()->route('counter.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit counter');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Counter"), "route" => "counter.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['counter']      = $this->counterRepo->show($id);
        return view('backend.admin.website-setup.counter.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->counterRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('counter.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->counterRepo->destroy($id);
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
