<?php

namespace App\Http\Controllers\Dormitory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dormitory\RoomType\StoreRequest;
use App\Http\Requests\Dormitory\RoomType\UpdateRequest;
use App\Interfaces\Dormitory\RoomTypeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class RoomTypeController extends Controller
{
    private $repo;

    function __construct(RoomTypeInterface $repo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->repo       = $repo;
    }

    public function index()
    {
        $data['room_type'] = $this->repo->getAll();

        $title             = ___('account.Room Type');
        $data['headers']   = [
            "title"        => $title,
            "create-permission" => 'room_type_create',
            "create-route" => 'room-type.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.dormitory.room_type.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('account.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => ___('common.Room Type'), "route" => "room-type.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.dormitory.room_type.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('room-type.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('account.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => ___('common.Room Type'), "route" => "room-type.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['room_type']        = $this->repo->show($id);
        return view('backend.admin.dormitory.room_type.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('room-type.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->repo->destroy($id);
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

