<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Academic\Shift\ShiftStoreRequest;
use App\Http\Requests\Academic\Shift\ShiftUpdateRequest;
use App\Interfaces\Academic\ShiftInterface;
use Illuminate\Support\Facades\Schema;

class ShiftController extends Controller
{
    private $shift;

    function __construct(ShiftInterface $shift)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->shift       = $shift;
    }

    public function index()
    {
        $data['shift'] = $this->shift->getAll();
        $title             = ___('academic.shift');
        $data['headers']   = [
            "title"        => $title,
            "permission"   => 'shift_create',
            "create-route" => 'shift.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.admin.academic.shift.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('academic.Add shift');
        
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Shift"), "route" => "shift.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.academic.shift.create', compact('data'));
    }

    public function store(ShiftStoreRequest $request)
    {
        $result = $this->shift->store($request);
        if ($result['status']) {
            return redirect()->route('shift.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['shift']        = $this->shift->show($id);
        $data['title']        = ___('academic.Edit shift');
        
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Shift"), "route" => "shift.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.academic.shift.edit', compact('data'));
    }

    public function update(ShiftUpdateRequest $request, $id)
    {
        $result = $this->shift->update($request, $id);
        if ($result['status']) {
            return redirect()->route('shift.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->shift->destroy($id);
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
