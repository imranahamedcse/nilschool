<?php

namespace App\Http\Repositories\Staff;
use App\Models\Permission;
use App\Http\Interfaces\Settings\PermissionInterface;

class PermissionRepository implements PermissionInterface {

    public function all()
    {
        return Permission::all();
    }

    public function get($id)
    {

    }

    public function save($role, $data)
    {

    }

    public function store(array $data)
    {

    }

    public function update($id, array $data)
    {

    }

    public function delete($id)
    {

    }
}
