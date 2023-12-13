<?php

namespace App\Http\Repositories\StudentInfo;

use App\Models\Role;
use App\Models\User;
use App\Enums\Settings;
use App\Traits\CommonHelperTrait;
use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\DB;
use App\Models\StudentInfo\Student;
use Illuminate\Support\Facades\Hash;
use App\Models\StudentInfo\ParentGuardian;
use App\Models\WebsiteSetup\OnlineAdmission;
use App\Models\StudentInfo\SessionClassStudent;
use App\Http\Interfaces\StudentInfo\OnlineAdmissionInterface;

class OnlineAdmissionRepository implements OnlineAdmissionInterface
{
    use ReturnFormatTrait;
    use CommonHelperTrait;

    private $model;

    public function __construct(OnlineAdmission $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('id','desc')->paginate(Settings::PAGINATE);
    }

    public function searchStudents($request)
    {
        $result = $this->model;

        if($request->class != "") {
            $result = $result->where('classes_id', $request->class);
        }
        if($request->section != "") {
            $result = $result->where('section_id', $request->section);
        }

        return $result->paginate(Settings::PAGINATE);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $role                     = Role::find(7); // Guardian role id 7

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

            $parent                      = new ParentGuardian();
            $parent->user_id             = $user->id;
            $parent->father_name         = $request->father_name;
            $parent->father_mobile       = $request->father_mobile;
            $parent->father_profession   = $request->father_profession;
            $parent->mother_name         = $request->mother_name;
            $parent->mother_mobile       = $request->mother_mobile;
            $parent->mother_profession   = $request->mother_profession;
            $parent->guardian_profession = $request->guardian_profession;
            $parent->guardian_address    = $request->guardian_address;
            $parent->guardian_relation   = $request->guardian_relation;
            $parent->guardian_name       = $request->guardian_name;
            $parent->guardian_email      = $request->guardian_email;
            $parent->guardian_mobile     = $request->guardian_mobile;
            $parent->guardian_image      = $user->upload_id;
            $parent->father_image        = $this->UploadImageCreate($request->father_image, 'backend/uploads/users');
            $parent->mother_image        = $this->UploadImageCreate($request->mother_image, 'backend/uploads/users');
            $parent->status              = $request->status;
            $parent->save();
            // End parent information


            // Student information
            $role                     = Role::find(6);// student role id 6

            $user                     = new User();
            $user->name               = $request->first_name.' '.$request->last_name;
            $user->email              = $request->email != ""? $request->email :  NULL;
            $user->phone              = $request->mobile != ""? $request->mobile :  NULL;
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
            $row->religion_id          = $request->religion != ""? $request->religion :  NULL;
            $row->gender_id            = $request->gender != ""? $request->gender :  NULL;
            $row->blood_group_id       = $request->blood != ""? $request->blood :  NULL;
            $row->admission_date       = $request->admission_date;
            $row->parent_guardian_id   = $parent->id;
            $row->student_category_id  = $request->category != ""? $request->category :  NULL;
            $row->status               = $request->status;
            $row->upload_documents     = $this->uploadDocuments($request);
            $row->save();

            $session_class                      = new SessionClassStudent();
            $session_class->session_id          = setting('session');
            $session_class->classes_id          = $request->class;
            $session_class->section_id          = $request->section != ""? $request->section :  NULL;
            $session_class->shift_id            = $request->shift != ""? $request->shift :  NULL;
            $session_class->student_id          = $row->id;
            $session_class->roll                = $request->roll_no;
            $session_class->save();
            // End student information

            $row = OnlineAdmission::find($request->online_admission_id);
            $row->delete();

            DB::commit();
            return $this->responseWithSuccess(___('alert.Approved successfully'), []);
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
            $row->delete();
            DB::commit();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

}
