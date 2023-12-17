<?php

namespace App\Http\Controllers\Report;

use App\Enums\AccountHeadType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Accounts\AccountHeadInterface;
use App\Http\Interfaces\Report\AccountInterface;
use PDF;

class AccountController extends Controller
{
    private $repo;
    private $accountHeadRepo;

    function __construct(
        AccountInterface      $repo,
        AccountHeadInterface  $accountHeadRepo,
    )
    {
        $this->repo              = $repo;
        $this->accountHeadRepo   = $accountHeadRepo;
    }

    public function index()
    {
        $title             = ___('common.Transactions');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['account.search', 'transaction', 'account_head', 'date_range'],
            "create-permission"   => '',
            "create-route" => '',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Report"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['account_head'] = $this->accountHeadRepo->getIncomeHeads();
        return view('backend.admin.report.account', compact('data'));
    }

    public function search(Request $request)
    {
        $data                 = $this->repo->search($request);
        $title             = ___('common.Transactions');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['account.search', 'transaction', 'account_head', 'date_range'],
            "create-permission"   => '',
            "create-route" => '',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Report"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['request']      = $request;

        if($data['request']->type == AccountHeadType::INCOME)
            $data['account_head'] = $this->accountHeadRepo->getIncomeHeads();
        else
            $data['account_head'] = $this->accountHeadRepo->getExpenseHeads();

        return view('backend.admin.report.account', compact('data'));
    }

    public function getAccountTypes(Request $request){
        if($request->id == AccountHeadType::INCOME)
            return $this->accountHeadRepo->getIncomeHeads();
        else
            return $this->accountHeadRepo->getExpenseHeads();
    }

    public function generatePDF(Request $request)
    {
        $request = new Request([
            'type'         => $request->type,
            'head'         => $request->head,
            'dates'        => $request->dates,
        ]);

        $data              = $this->repo->searchPDF($request);

        $pdf = PDF::loadView('backend.admin.report.accountPDF', compact('data'));
        return $pdf->download('transaction'.'_'.date('d_m_Y').'.pdf');
    }
}
