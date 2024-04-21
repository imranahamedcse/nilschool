<?php

namespace App\Http\Controllers\Canteen;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Canteen\ProductCategoryInterface;
use App\Http\Interfaces\Canteen\ProductInterface;
use App\Http\Requests\Canteen\Product\StoreRequest;
use App\Http\Requests\Canteen\Product\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    private $Repo, $categoryRepo;

    function __construct(ProductInterface $Repo, ProductCategoryInterface $categoryRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->Repo                  = $Repo;
        $this->categoryRepo  = $categoryRepo;
    }

    public function index()
    {
        $data['product'] = $this->Repo->getAll();
        $title              = ___('common.Product');

        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'product_create',
            "create-route" => 'product.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Canteen"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.canteen.product.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Create product');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Canteen"), "route" => ""],
            ["title" => ___("common.Product"), "route" => "product.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['categories']  = $this->categoryRepo->all();
        return view('backend.admin.canteen.product.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->Repo->store($request);
        if ($result['status']) {
            return redirect()->route('product.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit product');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Canteen"), "route" => ""],
            ["title" => ___("common.Product"), "route" => "product.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['product']        = $this->Repo->show($id);
        $data['categories']  = $this->categoryRepo->all();
        return view('backend.admin.canteen.product.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->Repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('product.index')->with('success', $result['message']);
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
