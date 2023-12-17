<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\StudentInfo\StudentInterface;
use App\Http\Requests\Transport\TransportStudent\StoreRequest;
use App\Http\Requests\Transport\TransportStudent\UpdateRequest;
use App\Http\Interfaces\Transport\TransportStudentInterface;
use App\Http\Interfaces\Transport\PickupPointInterface;
use App\Http\Interfaces\Transport\RouteInterface;
use App\Http\Interfaces\Transport\VehicleInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class TransportStudentController extends Controller
{
    private $repo, $pickupPointRepo, $routeRepo, $vehicleRepo, $classRepo, $classSetupRepo, $studentRepo;

    function __construct(
        TransportStudentInterface $repo,
        PickupPointInterface $pickupPointRepo,
        RouteInterface $routeRepo,
        VehicleInterface $vehicleRepo,
        ClassesInterface $classRepo,
        ClassSetupInterface $classSetupRepo,
        StudentInterface $studentRepo,
    )
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->repo            = $repo;
        $this->pickupPointRepo = $pickupPointRepo;
        $this->routeRepo       = $routeRepo;
        $this->vehicleRepo     = $vehicleRepo;
        $this->classRepo       = $classRepo;
        $this->classSetupRepo  = $classSetupRepo;
        $this->studentRepo     = $studentRepo;
    }

    public function index()
    {
        $data['transport_student'] = $this->repo->getAll();
        $title             = ___('common.Transport setup');
        $data['headers']   = [
            "title"        => $title,
            "create-permission" => 'transport_student_create',
            "create-route" => 'transport-student.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.transport.transport_student.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Transport setup'), "route" => "transport-student.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['route'] = $this->routeRepo->getAll();
        $data['pickup_points'] = [];
        $data['vehicles'] = [];

        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = [];
        $data['students']           = [];

        return view('backend.admin.transport.transport_student.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('transport-student.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Transport setup'), "route" => "transport-student.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['transport_student'] = $this->repo->show($id);

        $data['route']        = $this->routeRepo->getAll();
        $data['pickup_points'] = $this->pickupPointRepo->getAll();
        $data['vehicles']      = $this->vehicleRepo->getAll();

        $request = new Request([
            'class'   => $data['transport_student']->class_id,
            'section' => $data['transport_student']->section_id,
        ]);

        $data['classes']      = $this->classRepo->assignedAll();
        $data['sections']     = $this->classSetupRepo->getSections($request->class);
        $data['students']     = $this->studentRepo->getStudents($request);

        return view('backend.admin.transport.transport_student.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('transport-student.index')->with('success', $result['message']);
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

