<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Interfaces\UserManagement\PermissionInterface;
use App\Http\Interfaces\UserManagement\RoleInterface;
use App\Http\Requests\UserManagement\Role\StoreRequest;
use App\Http\Requests\UserManagement\Role\UpdateRequest;

class RoleController extends Controller
{
    private $role;
    private $permission;

    function __construct(RoleInterface $role, PermissionInterface $permission)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->role       = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $data['roles'] = $this->role->all();

        $title             = ___('common.roles');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'role_create',
            "create-route" => 'roles.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.user_management.roles.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.create_role');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => ___("common.Roles"), "route" => "roles.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['permissions'] = $this->permission->all();
        return view('backend.admin.user_management.roles.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->role->store($request);
        if($result){
            return redirect()->route('roles.index')->with('success', ___('alert.role_created_successfully'));
        }
        return redirect()->route('roles.index')->with('danger', ___('alert.something_went_wrong_please_try_again') );
    }

    public function edit($id)
    {
        if($id == 1)
            return redirect()->route('users.index')->with('danger',  ___('alert.something_went_wrong_please_try_again'));

        $data['title']       = ___('common.roles');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => ___("common.Roles"), "route" => "roles.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['role']        = $this->role->show($id);
        $data['permissions'] = $this->permission->all();
        return view('backend.admin.user_management.roles.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        if($id == 1)
            return redirect()->route('users.index')->with('danger',  ___('alert.something_went_wrong_please_try_again'));

        $result = $this->role->update($request, $id);
        if($result){
            return redirect()->route('roles.index')->with('success', ___('alert.role_updated_successfully'));
        }
        return redirect()->route('roles.index')->with('danger', ___('alert.something_went_wrong_please_try_again'));
    }

    public function delete($id)
    {
        if($id == 1)
            return redirect()->route('users.index')->with('danger',  ___('alert.something_went_wrong_please_try_again'));

        if($this->role->destroy($id)):
            $success[0] = ___('alert.deleted_successfully');
            $success[1] = 'success';
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
            return response()->json($success);
        else:
            $success[0] = ___('alert.something_went_wrong_please_try_again');
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
            return response()->json($success);
        endif;
    }
}
