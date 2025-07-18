<?php

namespace App\Http\Repositories\Academic;

use App\Enums\ApiStatus;
use App\Traits\ReturnFormatTrait;
use App\Http\Interfaces\Academic\SubjectAssignInterface;
use App\Models\Academic\SubjectAssign;
use App\Models\Academic\SubjectAssignChildren;
use App\Models\Examination\ExamAssign;
use App\Models\Examination\MarksRegister;
use Illuminate\Support\Facades\DB;

class SubjectAssignRepository implements SubjectAssignInterface
{
    use ReturnFormatTrait;

    private $model;
    private $classSetupRepo;

    public function __construct(SubjectAssign $model, ClassSetupRepository $classSetupRepo)
    {
        $this->model          = $model;
        $this->classSetupRepo = $classSetupRepo;
    }

    public function allActive()
    {
        return $this->model->active()->where('session_id', setting('session'))->get();
    }

    public function all()
    {
        return $this->model::latest()->where('session_id', setting('session'))->get();
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {

            if($this->model::where('session_id', setting('session'))->where('classes_id', $request->class)->where('section_id', $request->section)->first()) {
                return $this->responseWithError(___('alert.There is already a class for this session.'), []);
            }

            $setup              = new $this->model;
            $setup->session_id  = setting('session');
            $setup->classes_id  = $request->class;
            $setup->section_id  = $request->section;
            $setup->status      = $request->status;
            $setup->save();
            foreach ($request->subjects ?? [] as $key => $item) {
                $row = new SubjectAssignChildren();
                $row->subject_assign_id   = $setup->id;
                $row->subject_id          = $item;
                $row->staff_id            = $request->teachers[$key];
                $row->save();
            }
            DB::commit();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function getSubjects($request)
    {
        $result = $this->model->active()->where('session_id', setting('session'))->where('classes_id', $request->classes_id)->where('section_id', $request->section_id)->first();
        return SubjectAssignChildren::with('subject')->where('subject_assign_id', @$result->id)->select('subject_id')->get();
    }

    public function show($id)
    {
        $row = $this->model->find($id);
        $subjects = [];
        $disabled = false;
        $redirect = true;
        foreach ($row->subjectTeacher as $key => $value) {
            $result = ExamAssign::where('session_id',$row->session_id)
                ->where('classes_id',$row->classes_id)
                ->where('section_id',$row->section_id)
                ->where('subject_id',$value->subject_id)
                ->first();

            $result ? $subjects[] = 1 : $subjects[] = 0;
            $result ? $disabled = true : null;
            if($redirect)
                $result ? $redirect = true : $redirect = false;
        }
        $data['row']            = $row;
        $data['assignSubjects'] = $subjects;
        $data['disabled']       = $disabled;
        $data['redirect']       = $redirect;

        return $data;
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {

            if($this->model::where('session_id', setting('session'))->where('classes_id', $request->class)->where('section_id', $request->section)->where('id', '!=', $id)->first()) {
                return $this->responseWithError(___('alert.There is already a class for this session.'), []);
            }

            $setup              = $this->model->find($id);
            $setup->session_id  = setting('session');
            $setup->classes_id  = $request->class;
            $setup->section_id  = $request->section;
            $setup->status      = $request->status;
            $setup->save();

            SubjectAssignChildren::where('subject_assign_id', $setup->id)->delete();

            foreach ($request->subjects ?? [] as $key => $item) {
                $row = new SubjectAssignChildren();
                $row->subject_assign_id   = $setup->id;
                $row->subject_id          = $item;
                $row->staff_id            = $request->teachers[$key];
                $row->save();
            }

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

            foreach ($row->subjectTeacher as $key => $value) {
                ExamAssign::where('session_id',$row->session_id)
                    ->where('classes_id',$row->classes_id)
                    ->where('section_id',$row->section_id)
                    ->where('subject_id',$value->subject_id)
                    ->delete();

                MarksRegister::where('session_id',$row->session_id)
                    ->where('classes_id',$row->classes_id)
                    ->where('section_id',$row->section_id)
                    ->where('subject_id',$row->subject_id)
                    ->delete();
            }

            $row->delete();
            DB::commit();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function checkSection($request)
    {
        if ($request->form_type == "update") {

            $result = $this->model->active()->where('id', '!=', $request->id)->where('session_id', setting('session'))->where('classes_id', $request->class)->where('section_id', $request->section)->first();
        } else {

            $result = $this->model->active()->where('session_id', setting('session'))->where('classes_id', $request->class)->where('section_id', $request->section)->first();
        }

        $data   = [];
        if($result) {
            $data['message']   = ___('common.already_assigned_for_this_section');
            $data['status']    = false;
            $data['sections']  = $this->classSetupRepo->getSections($request->class);
        } else {
            $data['message']   = '';
            $data['status']    = true;
            $data['sections']  = true;
        }

        return $data;
    }


    public function checkExamAssign($id){
        $row = $this->model->find($id);

        foreach ($row->subjectTeacher as $key => $value) {
            $result = ExamAssign::where('session_id',$row->session_id)
                ->where('classes_id',$row->classes_id)
                ->where('section_id',$row->section_id)
                ->where('subject_id',$value->subject_id)
                ->first();

            if($result)
                return true;
        }
        return false;
    }
}
