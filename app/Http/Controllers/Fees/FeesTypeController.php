<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fees\Type\StoreRequest;
use App\Http\Requests\Fees\Type\UpdateRequest;
use App\Http\Interfaces\Fees\FeesTypeInterface;
use Illuminate\Http\Request;

class FeesTypeController extends Controller
{
    private $repo;

    function __construct(FeesTypeInterface $repo)
    {
        $this->repo       = $repo;
    }

    public function index()
    {
        $data['fees_types'] = $this->repo->all();

        $title             = ___('common.fees_type');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'fees_type_create',
            "create-route" => 'fees-type.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.fees.type.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('common.Add fees type');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => ___("common.Fees type"), "route" => "fees-type.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.fees.type.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('fees-type.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['fees_type']        = $this->repo->show($id);
        $data['title']       = ___('common.Edit fees type');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => ___("common.Fees type"), "route" => "fees-type.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.fees.type.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('fees-type.index')->with('success', $result['message']);
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
