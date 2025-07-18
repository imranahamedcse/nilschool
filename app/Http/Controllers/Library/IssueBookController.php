<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Library\IssueBookInterface;
use App\Http\Requests\Library\IssueBook\StoreRequest;
use App\Http\Requests\Library\IssueBook\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class IssueBookController extends Controller
{
    private $Repo;

    function __construct(IssueBookInterface $Repo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->Repo                  = $Repo;
    }

    public function index()
    {
        $data['issue_book'] = $this->Repo->getAll();

        $title = ___('common.Issue book');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'issue_book_create',
            "create-route" => 'issue-book.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.library.issue-book.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add issue book');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => ___("common.Issue book"), "route" => "issue-book.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.library.issue-book.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->Repo->store($request);
        if ($result['status']) {
            return redirect()->route('issue-book.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit issue book');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => ___("common.Issue book"), "route" => "issue-book.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['issue_book']  = $this->Repo->show($id);
        $data['user']        = $this->Repo->getUser($data['issue_book']->user_id);
        $data['book']        = $this->Repo->getBook($data['issue_book']->book_id);
        return view('backend.admin.library.issue-book.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->Repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('issue-book.index')->with('success', $result['message']);
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
    public function getBook(Request $request)
    {
        $result = $this->Repo->getBooks($request);
        return response()->json($result);
    }

    public function return($id)
    {
        $result = $this->Repo->return($id);
        if ($result['status']) {
            return redirect()->route('issue-book.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function search(Request $request)
    {
        $title = ___('common.Issue book');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'issue_book_create',
            "create-route" => 'issue-book.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['issue_book'] = $this->Repo->searchResult($request);
        $data['request']    = $request;

        return view('backend.admin.library.issue-book.index', compact('data'));
    }
}
