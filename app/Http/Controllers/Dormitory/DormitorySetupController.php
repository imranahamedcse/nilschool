<?php

namespace App\Http\Controllers\Dormitory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dormitory\Setup\StoreRequest;
use App\Http\Requests\Dormitory\Setup\UpdateRequest;
use App\Http\Interfaces\Dormitory\DormitoryInterface;
use App\Http\Interfaces\Dormitory\DormitorySetupInterface;
use App\Http\Interfaces\Dormitory\RoomInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DormitorySetupController extends Controller
{
    private $repo, $dormitoryRepo, $roomRepo;

    function __construct(
        DormitorySetupInterface $repo,
        DormitoryInterface $dormitoryRepo,
        RoomInterface $roomRepo,
    ) {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->repo = $repo;
        $this->dormitoryRepo = $dormitoryRepo;
        $this->roomRepo = $roomRepo;
    }

    public function index()
    {
        $data['dormitory_setup'] = $this->repo->getAll();

        $title             = ___('common.Dormitory Setup');
        $data['headers']   = [
            "title"        => $title,
            "create-permission" => 'dormitory_setup_create',
            "create-route" => 'dormitory-setup.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.dormitory.dormitory_setup.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => ___('common.Dormitory Setup'), "route" => "dormitory-setup.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['dormitories'] = $this->dormitoryRepo->all();
        $data['rooms'] = $this->roomRepo->all();
        return view('backend.admin.dormitory.dormitory_setup.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('dormitory-setup.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => ___('common.Dormitory Setup'), "route" => "dormitory-setup.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['dormitory_setup'] = $this->repo->show($id);
        $data['dormitories'] = $this->dormitoryRepo->all();
        $data['rooms'] = $this->roomRepo->all();

        $data['setup_rooms'] = array_unique($data['dormitory_setup']->rooms->pluck('room_id')->toArray());

        return view('backend.admin.dormitory.dormitory_setup.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('dormitory-setup.index')->with('success', $result['message']);
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

    public function getDormitoryRoom(Request $request){
        return $this->repo->getDormitoryRoom($request->id);
    }
}
