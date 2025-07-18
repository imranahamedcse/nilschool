<?php

namespace App\Http\Repositories\HumanResource;

use App\Http\Interfaces\HumanResource\StaffInterface;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\HumanResource\Staff;
use App\Traits\CommonHelperTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffRepository implements StaffInterface
{
    use CommonHelperTrait;
    private $model;

    public function __construct(Staff $model)
    {
        $this->model = $model;
    }

    public function index($request)
    {
        $data =  $this->model->query()->with('upload', 'designation');

        $where = array();

        if ($request->search) {
            $where[] = ['name', 'like', '%' . $request->search . '%'];
        }

        if ($request->from && $request->to) {
            $data = $data->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)->endOfDay()]);
        }

        if ($request->designation) {
            $data = $data->whereIn('designation_id', $request->designation);
        }

        $data = $data
            ->where($where)
            ->orderBy('id', 'DESC')
            ->paginate($request->show ?? 10);

        return $data;
    }

    public function status($request)
    {
        return $this->model->whereIn('id', $request->ids)->update(['status' => $request->status]);
    }

    public function deletes($request)
    {
        return $this->model->destroy((array)$request->ids);
    }

    public function allActive()
    {
        return $this->model->active()->where('role_id', 5)->get(); // Teacher role id 5
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
            $user->name               = $request->first_name;
            $user->email              = $request->email;
            $user->phone              = $request->phone;
            $user->password           = Hash::make('123456');
            $user->email_verified_at  = now();
            $user->role_id            = $request->role;
            $user->upload_id          = $this->UploadImageCreate($request->image, 'backend/uploads/users');
            $user->permissions        = $role->permissions;
            $user->save();

            $staff                          = new $this->model;
            $staff->user_id                 = $user->id;
            $staff->staff_id                = $request->staff_id;
            $staff->role_id                 = $request->role;
            $staff->designation_id          = $request->designation;
            $staff->department_id           = $request->department;
            $staff->first_name              = $request->first_name;
            $staff->last_name               = $request->last_name;
            $staff->father_name             = $request->father_name;
            $staff->mother_name             = $request->mother_name;
            $staff->email                   = $request->email;
            $staff->gender_id               = $request->gender;
            $staff->dob                     = $request->dob;
            $staff->joining_date            = $request->joining_date;
            $staff->phone                   = $request->phone;
            $staff->emergency_contact       = $request->emergency_contact;
            $staff->marital_status          = $request->marital_status;
            $staff->status                  = $request->status;
            $staff->current_address         = $request->current_address;
            $staff->permanent_address       = $request->permanent_address;
            $staff->basic_salary            = $request->basic_salary;
            $staff->upload_id               = $user->upload_id;

            $staff->upload_documents        = $this->uploadDocuments($request);

            $staff->save();
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

            $staff                    = $this->model->findOrfail($id);

            $user                     = User::find($staff->user_id);
            $user->name               = $request->first_name;
            $user->email              = $request->email;
            $user->phone              = $request->phone;
            $user->role_id            = $request->role;

            if ($request->image) {
                $user->upload_id          = $this->UploadImageCreate($request->image, 'backend/uploads/users');
            }

            $user->permissions        = $role->permissions;
            $user->save();

            $staff->user_id                 = $user->id;
            $staff->staff_id                = $request->staff_id;
            $staff->role_id                 = $request->role;
            $staff->designation_id          = $request->designation;
            $staff->department_id           = $request->department;
            $staff->first_name              = $request->first_name;
            $staff->last_name               = $request->last_name;
            $staff->father_name             = $request->father_name;
            $staff->mother_name             = $request->mother_name;
            $staff->email                   = $request->email;
            $staff->gender_id               = $request->gender;
            $staff->dob                     = $request->dob;
            $staff->joining_date            = $request->joining_date;
            $staff->phone                   = $request->phone;
            $staff->emergency_contact       = $request->emergency_contact;
            $staff->marital_status          = $request->marital_status;
            $staff->status                  = $request->status;
            $staff->current_address         = $request->current_address;
            $staff->permanent_address       = $request->permanent_address;
            $staff->basic_salary            = $request->basic_salary;
            $staff->upload_id               = $user->upload_id;

            $staff->upload_documents        = $this->uploadDocuments($request, $staff->upload_documents);

            $staff->save();
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function profileUpdate($request, $id)
    {
        try {
            $userUpdate                 = User::findOrfail($id);
            $userUpdate->name           = $request->name;
            $userUpdate->phone          = $request->phone;
            if(Auth::user()->role_id != 7)
                $userUpdate->date_of_birth  = $request->date_of_birth;
            $userUpdate->upload_id       = $this->UploadImageUpdate($request->image, 'backend/uploads/users', $userUpdate->upload_id);
            $userUpdate->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            $staff = $this->model->findOrfail($id);

            $user = User::find($staff->user_id);
            $this->UploadImageDelete($user->upload_id); // delete image & record
            $user->delete();

            $staff->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


    public function passwordUpdate($request, $id)
    {
        try {
            $userUpdate             = User::findOrfail($id);
            $userUpdate->password   = Hash::make($request->password);
            $userUpdate->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
