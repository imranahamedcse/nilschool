<?php

namespace App\Repositories\ClassRoom;

use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ClassRoom\PostInterface;
use App\Models\ClassRoom\Post;

class PostRepository implements PostInterface
{
    use ReturnFormatTrait;

    private $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->active()->where('session_id', setting('session'))->get();
    }

    public function getPaginateAll()
    {
        return $this->model::latest()->where('session_id', setting('session'))->paginate(10);
    }

    public function searchMarkRegister($request)
    {
        $rows = $this->model::query();
        $rows = $rows->where('session_id', setting('session'));
        if($request->class != "") {
            $rows = $rows->where('classes_id', $request->class);
        }
        if($request->section != "") {
            $rows = $rows->where('section_id', $request->section);
        }
        if($request->exam_type != "") {
            $rows = $rows->where('exam_type_id', $request->exam_type);
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
            $row->classes_id         = $request->class;
            $row->section_id       = $request->section;
            $row->subject_id       = $request->subject;
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
            $row->delete();
            DB::commit();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
