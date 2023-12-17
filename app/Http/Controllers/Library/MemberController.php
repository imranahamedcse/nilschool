<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Library\MemberCategoryInterface;
use App\Http\Interfaces\Library\MemberInterface;
use App\Http\Requests\Library\Member\StoreRequest;
use App\Http\Requests\Library\Member\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MemberController extends Controller
{
    private $Repo, $categoryRepo;

    function __construct(MemberInterface $Repo, MemberCategoryInterface $categoryRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->Repo = $Repo;
        $this->categoryRepo  = $categoryRepo;
    }

    public function index()
    {
        $data['member'] = $this->Repo->getAll();

        $title             = ___('common.Member');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'member_create',
            "create-route" => 'member.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.library.member.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Create member');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => ___("common.Member"), "route" => "member.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['categories']  = $this->categoryRepo->all();
        return view('backend.admin.library.member.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->Repo->store($request);
        if ($result['status']) {
            return redirect()->route('member.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit member');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => ___("common.Member"), "route" => "member.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['member']      = $this->Repo->show($id);
        $data['user']        = $this->Repo->getUser($data['member']->user_id);
        $data['categories']  = $this->categoryRepo->all();
        return view('backend.admin.library.member.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->Repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('member.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->Repo->destroy($id);
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

    public function getMember(Request $request)
    {
        $result = $this->Repo->getMember($request);
        return response()->json($result);
    }
}
