<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Accounts\AccountHeadInterface;
use App\Http\Interfaces\Accounts\IncomeInterface;
use App\Http\Requests\Accounts\Income\StoreRequest;
use App\Http\Requests\Accounts\Income\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class IncomeController extends Controller
{
    private $incomeRepo, $accountHeadRepo;

    function __construct(IncomeInterface $incomeRepo, AccountHeadInterface $accountHeadRepo)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->incomeRepo                  = $incomeRepo;
        $this->accountHeadRepo       = $accountHeadRepo;
    }

    public function index()
    {
        $data['income'] = $this->incomeRepo->getAll();

        $title             = ___('account.Income');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'income_create',
            "create-route" => 'income.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Account"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.accounts.income.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('account.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Account"), "route" => ""],
            ["title" => ___('account.Income'), "route" => "income.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['heads']       = $this->accountHeadRepo->getIncomeHeads();
        return view('backend.admin.accounts.income.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->incomeRepo->store($request);
        if($result['status']){
            return redirect()->route('income.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('account.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Account"), "route" => ""],
            ["title" => ___('account.Income'), "route" => "income.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['heads']       = $this->accountHeadRepo->getIncomeHeads();
        $data['income']      = $this->incomeRepo->show($id);
        return view('backend.admin.accounts.income.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->incomeRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('income.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->incomeRepo->destroy($id);
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
