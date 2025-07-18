<?php

namespace App\Http\Controllers\HumanResource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\HumanResource\DepartmentInterface;
use App\Http\Interfaces\HumanResource\DesignationInterface;
use App\Http\Interfaces\HumanResource\StaffInterface;
use App\Http\Interfaces\Settings\GenderInterface;
use App\Http\Interfaces\UserManagement\PermissionInterface;
use App\Http\Interfaces\UserManagement\RoleInterface;
use App\Http\Requests\HumanResource\Staff\StoreRequest;
use App\Http\Requests\HumanResource\Staff\UpdateRequest;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class StaffController extends Controller
{

    private $user;
    private $permission;
    private $role;
    private $designation;
    private $department;
    private $gender;

    function __construct(
        StaffInterface $user,
        PermissionInterface $permission,
        RoleInterface $role,
        DesignationInterface $designation,
        DepartmentInterface $department,
        GenderInterface $gender,

        )
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->user         = $user;
        $this->permission   = $permission;
        $this->role         = $role;
        $this->designation  = $designation;
        $this->department   = $department;
        $this->gender       = $gender;
    }

    public function index()
    {
        $data['users'] = $this->user->all();

        $title             = ___('common.staff');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'user_create',
            "create-route" => 'staff.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.human_resource.staff.index', compact('data'));
    }

    public function create()
    {
        $data['title']         = ___('common.create_staff');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => ___("common.Staff"), "route" => "staff.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['permissions']   = $this->permission->all();
        $data['roles']         = $this->role->all();
        $data['designations']  = $this->designation->all();
        $data['departments']   = $this->department->all();
        $data['genders']       = $this->gender->all();
        return view('backend.admin.human_resource.staff.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->user->store( $request);
        if ($result) {
            return redirect()->route('staff.index')->with('success', ___('alert.user_created_successfully'));
        }
        return redirect()->route('staff.index')->with('danger',  ___('alert.something_went_wrong_please_try_again'));
    }

    public function edit($id)
    {
        $data['title']         = ___('common.update_staff');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => ___("common.Staff"), "route" => "staff.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['user']          = $this->user->show($id);
        $data['permissions']   = $this->permission->all();
        $data['roles']         = $this->role->all();
        $data['designations']  = $this->designation->all();
        $data['departments']   = $this->department->all();
        $data['genders']       = $this->gender->all();

        return view('backend.admin.human_resource.staff.edit', compact('data'));
    }

    public function show($id)
    {
        $data = $this->user->show($id);
        return view('backend.admin.human_resource.staff.show', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->user->update($request, $id);
        if ($result) {
            return redirect()->route('staff.index')->with('success', ___('alert.user_updated_successfully'));
        }
        return redirect()->route('staff.index')->with('danger',  ___('alert.something_went_wrong_please_try_again'));
    }

    public function delete($id)
    {
        if ($this->user->destroy($id)) :
            $success[0] = ___('alert.deleted_successfully');
            $success[1] = "Success";
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
        else :
            $success[0] = ___('alert.something_went_wrong_please_try_again');
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
        endif;
        return response()->json($success);
    }

    public function changeRole(Request $request)
    {
        $data['role_permissions'] = $this->role->show($request->role_id)->permissions;
        $data['permissions']      = $this->permission->all();
        return view('backend.admin.human_resource.staff.permissions', compact('data'))->render();
    }

    public function status(Request $request)
    {

        if ($request->type == 'active') {
            $request->merge([
                'status' => 1
            ]);
            $this->user->status($request);
        }

        if ($request->type == 'inactive') {
            $request->merge([
                'status' => 0
            ]);
            $this->user->status($request);
        }

        return response()->json(["message" => __("Status update successful")], Response::HTTP_OK);
    }

    public function deletes(Request $request)
    {
        $this->user->deletes($request);

        return response()->json(["message" => __('Delete successful.')], Response::HTTP_OK);
    }
}
