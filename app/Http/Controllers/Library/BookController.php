<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Library\BookCategoryInterface;
use App\Http\Interfaces\Library\BookInterface;
use App\Http\Requests\Library\Book\StoreRequest;
use App\Http\Requests\Library\Book\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BookController extends Controller
{
    private $Repo, $categoryRepo;

    function __construct(BookInterface $Repo, BookCategoryInterface $categoryRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->Repo                  = $Repo;
        $this->categoryRepo  = $categoryRepo;
    }

    public function index()
    {
        $data['book'] = $this->Repo->getAll();
        $title              = ___('common.Book');

        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'book_create',
            "create-route" => 'book.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.library.book.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Create book');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => ___("common.Book"), "route" => "book.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['categories']  = $this->categoryRepo->all();
        return view('backend.admin.library.book.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->Repo->store($request);
        if ($result['status']) {
            return redirect()->route('book.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit book');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => ___("common.Book"), "route" => "book.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['book']        = $this->Repo->show($id);
        $data['categories']  = $this->categoryRepo->all();
        return view('backend.admin.library.book.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->Repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('book.index')->with('success', $result['message']);
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
}
