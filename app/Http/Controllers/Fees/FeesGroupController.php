<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fees\Group\StoreRequest;
use App\Http\Requests\Fees\Group\UpdateRequest;
use App\Http\Interfaces\Fees\FeesGroupInterface;
use Illuminate\Http\Request;

class FeesGroupController extends Controller
{
    private $repo;

    function __construct(FeesGroupInterface $repo)
    {
        $this->repo       = $repo;
    }

    public function index()
    {
        $data['fees_groups'] = $this->repo->all();

        $title             = ___('common.fees_group');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'fees_group_create',
            "create-route" => 'fees-group.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.admin.fees.group.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('common.Add fees group');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => ___("common.Fees group"), "route" => "fees-group.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.fees.group.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('fees-group.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['fees_group']        = $this->repo->show($id);
        $data['title']       = ___('common.Edit fees group');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => ___("common.Fees group"), "route" => "fees-group.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.fees.group.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('fees-group.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {

        $result = $this->repo->destroy($id);
        if ($result['status']) :
            $success[0] = $result['message'];
            $success[1] = 'success';
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
            return response()->json($success);
        else :
            $success[0] = $result['message'];
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
            return response()->json($success);
        endif;
    }
}
