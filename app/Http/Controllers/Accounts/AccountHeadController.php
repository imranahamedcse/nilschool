<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Accounts\AccountHeadInterface;
use App\Http\Requests\Accounts\Head\StoreRequest;
use App\Http\Requests\Accounts\Head\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AccountHeadController extends Controller
{
    private $headRepo;

    function __construct(AccountHeadInterface $headRepo)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->headRepo       = $headRepo;
    }

    public function index()
    {
        $data['account_head'] = $this->headRepo->getAll();

        $title             = ___('common.Head');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'account_head_create',
            "create-route" => 'account-head.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Account"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.accounts.head.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Account"), "route" => ""],
            ["title" => ___('common.Head'), "route" => "account-head.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.accounts.head.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->headRepo->store($request);
        if($result['status']){
            return redirect()->route('account-head.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Account"), "route" => ""],
            ["title" => ___('common.Head'), "route" => "account-head.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['account_head']        = $this->headRepo->show($id);
        return view('backend.admin.accounts.head.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->headRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('account-head.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->headRepo->destroy($id);
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
