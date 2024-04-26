<?php

namespace App\Http\Repositories\UserManagement;

use App\Http\Interfaces\UserManagement\RoleInterface;
use App\Models\Role;

class RoleRepository implements RoleInterface
{

    private $model;

    public function __construct(Role $roleModel)
    {
        $this->model = $roleModel;
    }

    public function allActive()
    {
        return $this->model->active()->get();
    }

    public function all()
    {
        return Role::latest()->get();
    }

    public function store($request)
    {
        try {
            $roleStore              = new $this->model;
            $roleStore->name        = $request->name;
            $roleStore->status      = $request->status;
            $roleStore->permissions = $request->permissions;
            $roleStore->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update($request, $id)
    {
        try {
            $roleUpdate              = $this->model->findOrfail($id);
            $roleUpdate->name        = $request->name;
            $roleUpdate->status      = $request->status;
            $roleUpdate->permissions = $request->permissions;
            $roleUpdate->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            if($id <= 7)
                return false;

            $roleDestroy = $this->model->find($id);
            $roleDestroy->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
