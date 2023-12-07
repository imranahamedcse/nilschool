<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\Expense\ExpenseStoreRequest;
use App\Http\Requests\Accounts\Expense\ExpenseUpdateRequest;
use App\Repositories\Accounts\AccountHeadRepository;
use App\Repositories\Accounts\ExpenseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ExpenseController extends Controller
{
    private $expenseRepo, $accountHeadRepository;

    function __construct(ExpenseRepository $expenseRepo, AccountHeadRepository $accountHeadRepository)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->expenseRepo                 = $expenseRepo; 
        $this->accountHeadRepository       = $accountHeadRepository; 
    }

    public function index()
    {
        $data['expense'] = $this->expenseRepo->getAll();

        $title             = ___('account.Expense');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'expense_create',
            "create-route" => 'expense.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Account"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.accounts.expense.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('account.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Account"), "route" => ""],
            ["title" => ___('account.Expense'), "route" => "expense.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['heads']       = $this->accountHeadRepository->getExpenseHeads();
        return view('backend.admin.accounts.expense.create', compact('data'));
    }

    public function store(ExpenseStoreRequest $request)
    {
        $result = $this->expenseRepo->store($request);
        if($result['status']){
            return redirect()->route('expense.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('account.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Account"), "route" => ""],
            ["title" => ___('account.Expense'), "route" => "expense.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['heads']       = $this->accountHeadRepository->getExpenseHeads();
        $data['expense']     = $this->expenseRepo->show($id);
        return view('backend.admin.accounts.expense.edit', compact('data'));
    }

    public function update(ExpenseUpdateRequest $request, $id)
    {
        $result = $this->expenseRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('expense.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->expenseRepo->destroy($id);
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
