<?php

namespace App\Http\Controllers\Settings;

use App\Models\BloodGroup;
use Illuminate\Http\Request;
use App\Interfaces\BloodGroupInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\BloodGroup\BloodGroupStoreRequest;
use App\Http\Requests\BloodGroup\BloodGroupUpdateRequest;
use Illuminate\Support\Facades\Schema;

class BloodGroupController extends Controller
{
    private $bloodGroup;

    function __construct(BloodGroupInterface $bloodGroup)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->bloodGroup       = $bloodGroup; 
    }

    public function index()
    {
        $data['bloodGroup'] = $this->bloodGroup->getAll();

        $title             = ___('settings.Blood groups');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'blood_group_create',
            "create-route" => 'blood-groups.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.settings.blood_group.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('settings.Add blood group');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => ___("common.Blood groups"), "route" => "blood-groups.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.settings.blood_group.create', compact('data'));
    }

    public function store(BloodGroupStoreRequest $request)
    {
        $result = $this->bloodGroup->store($request);
        if($result['status']){
            return redirect()->route('blood-groups.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('settings.Edit blood group');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => ___("common.Blood groups"), "route" => "blood-groups.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['bloodGroup']        = $this->bloodGroup->show($id);
        return view('backend.admin.settings.blood_group.edit', compact('data'));
    }

    public function update(BloodGroupUpdateRequest $request, $id)
    {
        $result = $this->bloodGroup->update($request, $id);
        if($result['status']){
            return redirect()->route('blood-groups.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->bloodGroup->destroy($id);
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
