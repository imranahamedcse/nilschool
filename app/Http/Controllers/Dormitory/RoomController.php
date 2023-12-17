<?php

namespace App\Http\Controllers\Dormitory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dormitory\Room\StoreRequest;
use App\Http\Requests\Dormitory\Room\UpdateRequest;
use App\Http\Interfaces\Dormitory\RoomInterface;
use App\Http\Interfaces\Dormitory\RoomTypeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class RoomController extends Controller
{
    private $repo, $typeRepo;

    function __construct(
        RoomInterface $repo,
        RoomTypeInterface $typeRepo
    )
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->repo           = $repo;
        $this->typeRepo       = $typeRepo;
    }

    public function index()
    {
        $data['room'] = $this->repo->getAll();

        $title             = ___('common.Room');
        $data['headers']   = [
            "title"        => $title,
            "create-permission" => 'room_create',
            "create-route" => 'room.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.admin.dormitory.room.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => ___('common.Room'), "route" => "room.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['types'] = $this->typeRepo->getAll();
        return view('backend.admin.dormitory.room.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('room.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => ___('common.Room'), "route" => "room.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['room']        = $this->repo->show($id);
        $data['types'] = $this->typeRepo->getAll();
        return view('backend.admin.dormitory.room.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('room.index')->with('success', $result['message']);
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

    public function getRoom(Request $request){
        return $this->repo->getRoom($request->id);
    }
}

