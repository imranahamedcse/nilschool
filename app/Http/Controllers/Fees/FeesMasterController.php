<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Requests\Fees\Master\StoreRequest;
use App\Http\Requests\Fees\Master\UpdateRequest;
use App\Http\Interfaces\Fees\FeesGroupInterface;
use App\Http\Interfaces\Fees\FeesMasterInterface;
use App\Http\Interfaces\Fees\FeesTypeInterface;
use Illuminate\Http\Request;

class FeesMasterController extends Controller
{
    private $repo;
    private $type;
    private $group;
    private $classRepo;

    function __construct(FeesMasterInterface $repo, FeesTypeInterface $type, FeesGroupInterface $group, ClassesInterface $classRepo)
    {
        $this->repo       = $repo;
        $this->type       = $type;
        $this->group      = $group;
        $this->classRepo  = $classRepo;
    }

    public function index()
    {
        $data['fees_masters'] = $this->repo->all();

        $title             = ___('common.fees_master');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'fees_master_create',
            "create-route" => 'fees-master.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.fees.master.index', compact('data'));
    }

    public function getAllTypes(Request $request)
    {
        $types = $this->repo->groupTypes($request);
        return view('backend.admin.fees.master.fees-types', compact('types'))->render();
    }

    public function create()
    {
        $data['title']        = ___('common.Add fees master');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => ___("common.Fees master"), "route" => "fees-master.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['fees_types']   = $this->type->allActive();
        $data['fees_groups']  = $this->group->allActive();
        return view('backend.admin.fees.master.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('fees-master.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']        = ___('common.Edit fees master');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Fees"), "route" => ""],
            ["title" => ___("common.Fees master"), "route" => "fees-master.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['fees_master']  = $this->repo->show($id);
        $data['fees_types']   = $this->type->allActive();
        $data['fees_groups']  = $this->group->allActive();

        return view('backend.admin.fees.master.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('fees-master.index')->with('success', $result['message']);
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
