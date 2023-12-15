<?php

namespace App\Http\Repositories\Academic;

use App\Enums\Settings;
use App\Http\Interfaces\Academic\SubjectInterface;
use App\Models\Academic\Subject;
use App\Traits\ReturnFormatTrait;

class SubjectRepository implements SubjectInterface
{
    use ReturnFormatTrait;
    private $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function allActive()
    {
        return $this->subject->active()->get();
    }

    public function all()
    {
        return $this->subject->latest()->get();
    }

    public function store($request)
    {
        try {
            $row              = new $this->subject;
            $row->name        = $request->name;
            $row->code        = $request->code;
            $row->type        = $request->type;
            $row->status      = $request->status;
            $row->save();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function show($id)
    {
        return $this->subject->find($id);
    }

    public function update($request, $id)
    {
        try {
            $row              = $this->subject->findOrfail($id);
            $row->name        = $request->name;
            $row->code        = $request->code;
            $row->type        = $request->type;
            $row->status      = $request->status;
            $row->save();
            return $this->responseWithSuccess(___('alert.updated_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function destroy($id)
    {
        try {
            $row = $this->subject->find($id);
            $row->delete();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
