<?php

namespace App\Http\Controllers\Dormitory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dormitory\Student\StoreRequest;
use App\Http\Requests\Dormitory\Student\UpdateRequest;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Dormitory\DormitoryInterface;
use App\Http\Interfaces\Dormitory\DormitorySetupInterface;
use App\Http\Interfaces\Dormitory\DormitoryStudentInterface;
use App\Http\Interfaces\Dormitory\RoomInterface;
use App\Http\Interfaces\StudentInfo\StudentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DormitoryStudentController extends Controller
{
    private $repo, $classRepo, $classSetupRepo, $studentRepo, $dormitoryRepo, $setupRepo, $roomRepo;

    function __construct(
        DormitoryStudentInterface $repo,
        ClassesInterface $classRepo,
        ClassSetupInterface $classSetupRepo,
        StudentInterface $studentRepo,
        DormitoryInterface $dormitoryRepo,
        DormitorySetupInterface $setupRepo,
        RoomInterface $roomRepo,
    )
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->repo            = $repo;
        $this->classRepo       = $classRepo;
        $this->classSetupRepo  = $classSetupRepo;
        $this->studentRepo     = $studentRepo;
        $this->dormitoryRepo   = $dormitoryRepo;
        $this->setupRepo       = $setupRepo;
        $this->roomRepo        = $roomRepo;
    }

    public function index()
    {
        $data['dormitory_student'] = $this->repo->getAll();

        $title             = ___('common.Student');
        $data['headers']   = [
            "title"        => $title,
            "create-permission" => 'dormitory_student_create',
            "create-route" => 'dormitory-student.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.dormitory.dormitory_student.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => ___('common.Student'), "route" => "dormitory-student.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']         = $this->classRepo->assignedAll();
        $data['sections']        = [];
        $data['students']        = [];

        $data['dormitories']     = $this->dormitoryRepo->getAll();
        $data['rooms']           = [];
        $data['seats']           = [];

        return view('backend.admin.dormitory.dormitory_student.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('dormitory-student.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Dormitory"), "route" => ""],
            ["title" => ___('common.Student'), "route" => "dormitory-student.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['dormitory_student'] = $this->repo->show($id);

        $request = new Request([
            'class'   => $data['dormitory_student']->class_id,
            'section' => $data['dormitory_student']->section_id,
        ]);

        $data['classes']      = $this->classRepo->assignedAll();
        $data['sections']     = $this->classSetupRepo->getSections($request->class);
        $data['students']     = $this->studentRepo->getStudents($request);

        $data['dormitories']     = $this->dormitoryRepo->getAll();

        $data['rooms']           = $this->setupRepo->getRoom($data['dormitory_student']->dormitory_id);
        $data['seats']           = $this->roomRepo->show($data['dormitory_student']->room_id);

        return view('backend.admin.dormitory.dormitory_student.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('dormitory-student.index')->with('success', $result['message']);
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

