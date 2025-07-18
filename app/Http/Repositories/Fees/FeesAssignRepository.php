<?php

namespace App\Http\Repositories\Fees;

use App\Models\Fees\FeesAssign;
use App\Models\Fees\FeesMaster;
use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\DB;
use App\Models\Fees\FeesAssignChildren;
use App\Http\Interfaces\Fees\FeesAssignInterface;
use App\Models\Fees\FeesAssignStudents;
use App\Models\Fees\FeesAssignStudentsChilds;
use App\Models\StudentInfo\SessionClassStudent;

class FeesAssignRepository implements FeesAssignInterface
{
    use ReturnFormatTrait;

    private $model;

    public function __construct(FeesAssign $model)
    {
        $this->model = $model;
    }

    public function allActive()
    {
        return $this->model->active()->get();
    }

    public function all()
    {
        return $this->model::latest()->where('session_id', setting('session'))->get();
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {

            if ($request->student_ids == null)
                return $this->responseWithError(___('alert.Please select student.'), []);

            $row                = new $this->model;
            $row->session_id    = setting('session');
            $row->classes_id      = $request->class;
            $row->section_id    = $request->section;
            $row->fees_group_id = $request->fees_group;
            $row->category_id   = $request->student_category == "" ? null : $request->student_category;
            $row->gender_id     = $request->gender == "" ? null : $request->gender;
            $row->save();

            foreach ($request->fees_type_ids as $fees_master) {

                foreach ($request->student_ids as $item) {
                    $feesChield                 = new FeesAssignChildren();
                    $feesChield->fees_assign_id = $row->id;
                    $feesChield->fees_master_id = $fees_master;
                    $feesChield->student_id     = $item;
                    $feesChield->save();
                }
            }

            foreach ($request->student_ids as $item) {
                $student                 = new FeesAssignStudents();
                $student->fees_assign_id = $row->id;
                $student->student_id     = $item;
                $student->save();

                foreach ($request->fees_type_ids as $fees_type) {
                    $studentChild                         = new FeesAssignStudentsChilds();
                    $studentChild->fees_assign_id         = $row->id;
                    $studentChild->fees_assign_student_id = $student->id;
                    $studentChild->fees_type_id           = $fees_type;
                    $studentChild->save();
                }
            }

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

            if ($request->student_ids == null)
                return $this->responseWithError(___('alert.Please select student.'), []);

            $row                = $this->model->findOrfail($id);
            $row->session_id    = setting('session');
            $row->classes_id    = $request->class;
            $row->section_id    = $request->section;
            $row->fees_group_id = $request->fees_group;
            $row->category_id   = $request->student_category == "" ? null : $request->student_category;
            $row->gender_id     = $request->gender == "" ? null : $request->gender;
            $row->save();

            $diff = array_diff($row->feesAssignChilds->pluck('student_id')->toArray(), $request->student_ids);
            FeesAssignChildren::where('fees_assign_id', $row->id)->whereIn('student_id', $diff)->delete();

            foreach ($request->fees_type_ids as $fees_master) {

                foreach ($request->student_ids as $item) {

                    $feesChield = FeesAssignChildren::where('fees_master_id', $fees_master)->where('student_id', $item)->first();
                    if(!$feesChield) {
                        $feesChield                 = new FeesAssignChildren();
                    }

                    $feesChield->fees_assign_id = $row->id;
                    $feesChield->fees_master_id = $fees_master;
                    $feesChield->student_id     = $item;
                    $feesChield->save();

                }
            }

            FeesAssignStudents::where('fees_assign_id', $row->id)->delete();

            foreach ($request->student_ids as $item) {
                $student                 = new FeesAssignStudents();
                $student->fees_assign_id = $row->id;
                $student->student_id     = $item;
                $student->save();

                foreach ($request->fees_type_ids as $fees_type) {
                    $studentChild                         = new FeesAssignStudentsChilds();
                    $studentChild->fees_assign_id         = $row->id;
                    $studentChild->fees_assign_student_id = $student->id;
                    $studentChild->fees_type_id           = $fees_type;
                    $studentChild->save();
                }
            }

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

    public function getFeesAssignStudents($request)
    {
        $students = SessionClassStudent::query();
        $students = $students->where('session_id', setting('session'))->where('classes_id', $request->class)->where('section_id', $request->section);

        if ($request->gender != "") {
            $students = $students->whereHas('student', function ($query) use ($request) {
                return $query->where('gender_id', $request->gender);
            });
        }

        if ($request->category != "") {
            $students = $students->whereHas('student', function ($query) use ($request) {
                return $query->where('student_category_id', $request->category);
            });
        }

        return $students->get();
    }

    public function groupTypes($request)
    {
        return FeesMaster::active()->where('fees_group_id', $request->id)->get();
    }
}
