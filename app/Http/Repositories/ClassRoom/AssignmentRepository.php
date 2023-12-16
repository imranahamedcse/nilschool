<?php

namespace App\Http\Repositories\ClassRoom;

use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\ClassRoom\AssignmentInterface;
use App\Models\ClassRoom\Assignment;
use App\Traits\CommonHelperTrait;

class AssignmentRepository implements AssignmentInterface
{
    use ReturnFormatTrait;
    use CommonHelperTrait;

    private $model;

    public function __construct(Assignment $model)
    {
        $this->model = $model;
    }

    public function allActive()
    {
        return $this->model->active()->where('session_id', setting('session'))->get();
    }

    public function all()
    {
        return $this->model::latest()->where('session_id', setting('session'))->get();
    }

    public function search($request)
    {
        $rows = $this->model::query();
        $rows = $rows->where('session_id', setting('session'));
        if($request->class != "") {
            $rows = $rows->where('classes_id', $request->class);
        }
        if($request->section != "") {
            $rows = $rows->where('section_id', $request->section);
        }
        if($request->subject != "") {
            $rows = $rows->where('subject_id', $request->subject);
        }
        return $rows->paginate(10);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $row                   = new $this->model;
            $row->session_id       = setting('session');
            $row->classes_id       = $request->class;
            $row->section_id       = $request->section;
            $row->subject_id       = $request->subject;
            $row->mark             = $request->mark;
            $row->assigned_date    = $request->assigned_date;
            $row->submission_date  = $request->submission_date;
            $row->upload_id        = $this->UploadImageCreate($request->document, 'backend/uploads/assignment');
            $row->description      = $request->description;
            $row->status           = $request->status;
            $row->assigned_by      = auth()->user()->id;
            $row->save();

            DB::commit();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
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
            $row                   = $this->model->find($id);
            $row->session_id       = setting('session');
            $row->classes_id       = $request->class;
            $row->section_id       = $request->section;
            $row->subject_id       = $request->subject;
            $row->mark             = $request->mark;
            $row->assigned_date    = $request->assigned_date;
            $row->submission_date  = $request->submission_date;
            $row->upload_id        = $this->UploadImageUpdate($request->document, 'backend/uploads/assignment', $row->upload_id);
            $row->description      = $request->description;
            $row->status           = $request->status;
            $row->save();

            DB::commit();
            return $this->responseWithSuccess(___('alert.updated_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $row = $this->model->find($id);
            $this->UploadImageDelete($row->upload_id);
            $row->delete();
            DB::commit();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
