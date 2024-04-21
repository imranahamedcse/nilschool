<?php

namespace App\Http\Controllers\Canteen;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Canteen\OrderInterface;
use App\Http\Interfaces\Canteen\ProductInterface;
use App\Http\Requests\Canteen\Order\StoreRequest;
use App\Http\Requests\Canteen\Order\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class OrderController extends Controller
{
    private $Repo, $productRepo;

    function __construct(OrderInterface $Repo, ProductInterface $productRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->Repo                  = $Repo;
        $this->productRepo           = $productRepo;
    }

    public function index()
    {
        $data['order'] = $this->Repo->getAll();

        $title = ___('common.Order');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'order_create',
            "create-route" => 'order.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Canteen"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.canteen.order.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add Order');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Canteen"), "route" => ""],
            ["title" => ___("common.Order"), "route" => "order.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['items'] = $this->productRepo->all();

        return view('backend.admin.canteen.order.create', compact('data'));
    }

    public function addNewItem(Request $request)
    {
        $item = $this->productRepo->show($request->id);
        return view('backend.admin.canteen.order.add_new_item', compact('item'))->render();
    }

    public function store(Request $request)
    {
        dd($request->all());
        $result = $this->Repo->store($request);
        if ($result['status']) {
            return redirect()->route('order.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit Order');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Canteen"), "route" => ""],
            ["title" => ___("common.Order"), "route" => "order.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['order']  = $this->Repo->show($id);
        $data['user']        = $this->Repo->getUser($data['order']->user_id);
        $data['book']        = $this->Repo->getBook($data['order']->book_id);
        return view('backend.admin.canteen.order.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->Repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('order.index')->with('success', $result['message']);
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
            return redirect()->route('order.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function search(Request $request)
    {
        $title = ___('common.Order');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'order_create',
            "create-route" => 'order.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Canteen"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['order'] = $this->Repo->searchResult($request);
        $data['request']    = $request;

        return view('backend.admin.canteen.order.index', compact('data'));
    }
}
