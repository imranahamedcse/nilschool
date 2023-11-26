<?php

namespace App\Repositories\StudentInfo;

use App\Models\Role;
use App\Models\User;
use App\Enums\Settings;
use App\Enums\ApiStatus;
use App\Traits\CommonHelperTrait;
use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\DB;
use App\Models\StudentInfo\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Models\StudentInfo\SessionClassStudent;
use App\Interfaces\StudentInfo\StudentInterface;

class StudentRepository implements StudentInterface
{
    use ReturnFormatTrait;
    use CommonHelperTrait;

    private $model;

    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->active()->get();
    }

    public function getStudents($request)
    {
        return  SessionClassStudent::query()
                ->where('session_id', setting('session'))
                ->where('classes_id', $request->class)
                ->where('section_id', $request->section)
                ->when(request()->filled('gender'), function ($q) use ($request) {
                    $q->whereHas('student', fn ($q) => $q->where('gender_id', $request->gender));
                })
                ->with('student')
                ->get();
    }


    public function getPaginateAll()
    {
        return SessionClassStudent::where('session_id', setting('session'))->latest()->get();
    }
    public function getSessionStudent($id)
    {
        return SessionClassStudent::where('id', $id)->first();
    }


    public function searchStudents($request)
    {
        $students = SessionClassStudent::query();
        $students = $students->where('session_id', setting('session'));

        if($request->class != "") {
            $students = $students->where('classes_id', $request->class);
        }
        if($request->section != "") {
            $students = $students->where('section_id', $request->section);
        }

        return $students->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
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

            $row                       = new $this->model;
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
            $row->parent_guardian_id   = $request->parent != ""? $request->parent :  NULL;
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

            $user                     = User::where('id',$row->user_id)->first();

            $role                     = Role::find($user->role_id);
            
            $user->name               = $request->first_name.' '.$request->last_name;
            $user->email              = $request->email != ""? $request->email :  NULL;
            $user->phone              = $request->mobile != ""? $request->mobile :  NULL;
            $user->date_of_birth      = $request->date_of_birth;
            $user->admission_no       = $request->admission_no;
            $user->upload_id          = $this->UploadImageUpdate($request->image, 'backend/uploads/students', $user->upload_id);
            $user->permissions        = $role->permissions; 
            $user->save();

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
            $row->parent_guardian_id   = $request->parent != ""? $request->parent :  NULL;
            $row->student_category_id  = $request->category != ""? $request->category :  NULL;
            $row->status               = $request->status;
            $row->upload_documents     = $this->uploadDocuments($request, $row->upload_documents);
            $row->save();

            $session_class                      = SessionClassStudent::where('session_id', setting('session'))->where('student_id', $row->id)->first();
            $session_class->classes_id          = $request->class;
            $session_class->section_id          = $request->section != ""? $request->section :  NULL;
            $session_class->shift_id            = $request->shift != ""? $request->shift :  NULL;
            $session_class->student_id          = $row->id;
            $session_class->roll                = $request->roll_no;
            $session_class->save();

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
            $row  = $this->model->find($id);
            $user = User::find($row->user_id);
            $this->UploadImageDelete($user->upload_id);

            foreach ($row->upload_documents ?? [] as $doc) {
                $this->UploadImageDelete($doc['file']);
            }
            $user->delete(); // when user delete auto delete student, session class student table's row

            DB::commit();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
