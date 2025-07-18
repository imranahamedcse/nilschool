<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Library\BookCategoryInterface;
use App\Http\Requests\Library\BookCategory\StoreRequest;
use App\Http\Requests\Library\BookCategory\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BookCategoryController extends Controller
{
    private $Repo;

    function __construct(BookCategoryInterface $Repo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->Repo                  = $Repo;
    }

    public function index()
    {
        $data['book_category'] = $this->Repo->getAll();

        $title = ___('common.Book category');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'book_category_create',
            "create-route" => 'book-category.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.library.book-category.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add book category');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => ___("common.Book category"), "route" => "book-category.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.library.book-category.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->Repo->store($request);
        if ($result['status']) {
            return redirect()->route('book-category.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit book Category');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Library"), "route" => ""],
            ["title" => ___("common.Book category"), "route" => "book-category.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['book_category']      = $this->Repo->show($id);
        return view('backend.admin.library.book-category.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->Repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('book-category.index')->with('success', $result['message']);
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
