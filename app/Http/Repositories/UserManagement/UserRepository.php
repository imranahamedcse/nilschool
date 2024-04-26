<?php

namespace App\Http\Repositories\UserManagement;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Http\Interfaces\UserManagement\UserInterface;
use App\Traits\CommonHelperTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    use CommonHelperTrait;
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function allActive()
    {
        return $this->model->active()->get();
    }

    public function all()
    {
        return $this->model->query()->orderBy('id', 'DESC')->get();
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $role                     = Role::find($request->role);

            $user                     = new User();
            $user->name               = $request->name;
            $user->email              = $request->email;
            $user->phone              = $request->phone;
            $user->password           = Hash::make($request->phone);
            $user->email_verified_at  = now();
            $user->role_id            = $request->role;
            $user->upload_id          = $this->UploadImageCreate($request->image, 'backend/uploads/users');
            $user->permissions        = $role->permissions;
            $user->save();

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $role                     = Role::find($request->role);

            $user                     = User::find($id);
            $user->name               = $request->name;
            $user->email              = $request->email;
            $user->phone              = $request->phone;
            $user->role_id            = $request->role;

            if ($request->image) {
                $user->upload_id          = $this->UploadImageCreate($request->image, 'backend/uploads/users');
            }

            $user->permissions        = $role->permissions;
            $user->save();

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            $user   = User::find($id);
            $this->UploadImageDelete($user->upload_id); // delete image & record
            $user->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

}
