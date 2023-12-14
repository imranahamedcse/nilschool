<?php

namespace App\Http\Repositories\StudentInfo;

use App\Models\Role;
use App\Models\User;
use App\Enums\Settings;
use App\Enums\ApiStatus;
use App\Traits\CommonHelperTrait;
use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\StudentInfo\ParentGuardian;
use App\Http\Interfaces\StudentInfo\ParentGuardianInterface;
use App\Models\StudentInfo\SessionClassStudent;
use App\Models\StudentInfo\Student;

class ParentGuardianRepository implements ParentGuardianInterface
{
    use ReturnFormatTrait;
    use CommonHelperTrait;

    private $model;

    public function __construct(ParentGuardian $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->active()->pluck('guardian_name', 'id')->toArray();
    }

    public function getPaginateAll()
    {
        return $this->model::latest()->paginate(Settings::PAGINATE);
    }

    public function searchParent($request)
    {
        // return $this->model::where('guardian_name', 'LIKE', "%{$request->keyword}%")
        // ->orWhere('guardian_email', 'LIKE', "%{$request->keyword}%")
        // ->orWhere('guardian_mobile', 'LIKE', "%{$request->keyword}%")
        // ->paginate(Settings::PAGINATE);
        $students = SessionClassStudent::query();
        $students = $students->where('session_id', setting('session'));

        if ($request->class != "") {
            $students = $students->where('classes_id', $request->class);
        }
        if ($request->section != "") {
            $students = $students->where('section_id', $request->section);
        }

        return $students->paginate(Settings::PAGINATE);
    }

    public function getParent($request)
    {
        return $this->model->where('guardian_name', 'like', '%' . $request->text . '%')->pluck('guardian_name', 'id')->toArray();
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $role                     = Role::find(5); // Guardian role id 5

            $user                     = new User();
            $user->name               = $request->guardian_name;
            $user->email              = $request->guardian_email;
            $user->phone              = $request->guardian_mobile;
            $user->password           = Hash::make('123456');
            $user->email_verified_at  = now();
            $user->role_id            = $role->id;
            $user->permissions        = $role->permissions;
            $user->upload_id          = $this->UploadImageCreate($request->guardian_image, 'backend/uploads/users');
            $user->save();

            $row                      = new $this->model;
            $row->user_id             = $user->id;
            $row->father_name         = $request->father_name;
            $row->father_mobile       = $request->father_mobile;
            $row->father_profession   = $request->father_profession;
            $row->mother_name         = $request->mother_name;
            $row->mother_mobile       = $request->mother_mobile;
            $row->mother_profession   = $request->mother_profession;
            $row->guardian_profession = $request->guardian_profession;
            $row->guardian_address    = $request->guardian_address;
            $row->guardian_relation   = $request->guardian_relation;
            $row->guardian_name       = $request->guardian_name;
            $row->guardian_email      = $request->guardian_email;
            $row->guardian_mobile     = $request->guardian_mobile;
            $row->guardian_image      = $user->upload_id;
            $row->father_image        = $this->UploadImageCreate($request->father_image, 'backend/uploads/users');
            $row->mother_image        = $this->UploadImageCreate($request->mother_image, 'backend/uploads/users');
            $row->status              = $request->status;
            $row->save();

            DB::commit();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
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
            $row                      = $this->model->find($id);

            $user                     = User::find($row->user_id);

            $role                     = Role::find($user->role_id);

            $user->name               = $request->guardian_name;
            $user->email              = $request->guardian_email;
            $user->phone              = $request->guardian_mobile;
            $user->upload_id          = $this->UploadImageUpdate($request->guardian_image, 'backend/uploads/users', $user->upload_id);
            $user->permissions        = $role->permissions;
            $user->save();

            $row->father_name         = $request->father_name;
            $row->father_mobile       = $request->father_mobile;
            $row->father_profession   = $request->father_profession;
            $row->mother_name         = $request->mother_name;
            $row->mother_mobile       = $request->mother_mobile;
            $row->mother_profession   = $request->mother_profession;
            $row->guardian_profession = $request->guardian_profession;
            $row->guardian_address    = $request->guardian_address;
            $row->guardian_relation   = $request->guardian_relation;
            $row->guardian_name       = $request->guardian_name;
            $row->guardian_email      = $request->guardian_email;
            $row->guardian_mobile     = $request->guardian_mobile;
            $row->guardian_image      = $user->upload_id;
            $row->father_image        = $this->UploadImageUpdate($request->father_image, 'backend/uploads/users', $row->father_image);
            $row->mother_image        = $this->UploadImageUpdate($request->mother_image, 'backend/uploads/users', $row->mother_image);
            $row->status              = $request->status;
            $row->save();

            DB::commit();
            return $this->responseWithSuccess(___('alert.updated_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $row = $this->model->find($id);
            $this->UploadImageDelete($row->father_image);
            $this->UploadImageDelete($row->mother_image);
            $row->delete();

            $user = User::find($row->user_id);
            $this->UploadImageDelete($user->upload_id);
            $user->delete();

            DB::commit();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function studentStore($request)
    {
        DB::beginTransaction();
        try {
            $role                     = Role::find(6); // student role id 6

            $user                     = new User();
            $user->name               = $request->first_name . ' ' . $request->last_name;
            $user->email              = $request->email != "" ? $request->email :  NULL;
            $user->phone              = $request->mobile != "" ? $request->mobile :  NULL;
            $user->admission_no       = $request->admission_no;
            $user->password           = Hash::make('123456');
            $user->email_verified_at  = now();
            $user->role_id            = $role->id;
            $user->permissions        = $role->permissions;
            $user->date_of_birth      = $request->date_of_birth;
            $user->upload_id          = $this->UploadImageCreate($request->image, 'backend/uploads/students');
            $user->save();

            $row                       = new Student();
            $row->user_id              = $user->id;
            $row->first_name           = $request->first_name;
            $row->last_name            = $request->last_name;
            $row->admission_no         = $request->admission_no;
            $row->roll_no              = $request->roll_no != "" ? $request->roll_no :  NULL;
            $row->mobile               = $request->mobile;
            $row->image_id             = $user->upload_id;
            $row->email                = $request->email;
            $row->dob                  = $request->date_of_birth;
            $row->religion_id          = $request->religion != "" ? $request->religion :  NULL;
            $row->gender_id            = $request->gender != "" ? $request->gender :  NULL;
            $row->blood_group_id       = $request->blood != "" ? $request->blood :  NULL;
            $row->admission_date       = $request->admission_date;
            $row->parent_guardian_id   = $request->parent != "" ? $request->parent :  NULL;
            $row->student_category_id  = $request->category != "" ? $request->category :  NULL;
            $row->status               = $request->status;
            $row->upload_documents     = $this->uploadDocuments($request);
            $row->save();

            $session_class                      = new SessionClassStudent();
            $session_class->session_id          = setting('session');
            $session_class->classes_id          = $request->class;
            $session_class->section_id          = $request->section != "" ? $request->section :  NULL;
            $session_class->shift_id            = $request->shift != "" ? $request->shift :  NULL;
            $session_class->student_id          = $row->id;
            $session_class->roll                = $request->roll_no;
            $session_class->save();

            DB::commit();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
