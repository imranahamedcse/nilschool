<?php

namespace App\Repositories\WebsiteSetup;

use App\Enums\Settings;
use Illuminate\Support\Facades\DB;
use App\Interfaces\WebsiteSetup\DepartmentContactInterface;
use App\Models\WebsiteSetup\DepartmentContact;
use App\Traits\CommonHelperTrait;
use App\Traits\ReturnFormatTrait;

class DepartmentContactRepository implements DepartmentContactInterface{

    use ReturnFormatTrait;
    use CommonHelperTrait;
    private $depContact;

    public function __construct(DepartmentContact $depContact)
    {
        $this->depContact = $depContact;
    }

    public function all()
    {
        return $this->depContact->active()->get();
    }

    public function getAll()
    {
        return $this->depContact->orderBy('id', 'desc')->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $row                   = new $this->depContact;
            $row->name             = $request->name;
            $row->phone            = $request->phone;
            $row->email            = $request->email;
            $row->upload_id        = $this->UploadImageCreate($request->image, 'backend/uploads/contact_info');
            $row->status           = $request->status;
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
        return $this->depContact->find($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $row                   = $this->depContact->findOrfail($id);
            $row->name             = $request->name;
            $row->phone            = $request->phone;
            $row->email            = $request->email;
            $row->upload_id        = $this->UploadImageUpdate($request->image, 'backend/uploads/contact_info', $row->upload_id);
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
            $row = $this->depContact->find($id);
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
