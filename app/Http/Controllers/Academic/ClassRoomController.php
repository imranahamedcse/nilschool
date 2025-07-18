<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\Academic\ClassRoomInterface;
use App\Http\Requests\Academic\Room\StoreRequest;
use App\Http\Requests\Academic\Room\UpdateRequest;

class ClassRoomController extends Controller
{
    private $repo;

    function __construct(ClassRoomInterface $repo)
    {
        $this->repo       = $repo;
    }

    public function index()
    {
        $data['class_rooms'] = $this->repo->all();

        $title             = ___('common.class_room');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'class_room_create',
            "create-route" => 'class-room.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.academic.class-room.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('common.Add class room');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Class room"), "route" => "class-room.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.academic.class-room.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {

        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('class-room.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit class room');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Class room"), "route" => "class-room.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['class_room']        = $this->repo->show($id);
        return view('backend.admin.academic.class-room.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('class-room.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {

        $result = $this->repo->destroy($id);
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
