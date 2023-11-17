<?php

namespace App\Repositories\WebsiteSetup;

use App\Models\Counter;
use App\Enums\Settings;
use Illuminate\Support\Facades\DB;
use App\Interfaces\WebsiteSetup\CounterInterface;
use App\Traits\CommonHelperTrait;
use App\Traits\ReturnFormatTrait;

class CounterRepository implements CounterInterface{

    use ReturnFormatTrait;
    use CommonHelperTrait;
    private $counter;

    public function __construct(Counter $counter)
    {
        $this->counter = $counter;
    }

    public function all()
    {
        return $this->counter->active()->get();
    }

    public function getAll()
    {
        return $this->counter->orderBy('serial')->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $row                   = new $this->counter;
            $row->name             = $request->name;
            $row->total_count      = $request->total_count;
            $row->upload_id        = $this->UploadImageCreate($request->image, 'backend/uploads/counters');
            $row->status           = $request->status;
            $row->serial           = $request->serial;
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
        return $this->counter->find($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $row                   = $this->counter->findOrfail($id);
            $row->name             = $request->name;
            $row->total_count      = $request->total_count;
            $row->upload_id        = $this->UploadImageUpdate($request->image, 'backend/uploads/counters', $row->upload_id);
            $row->status           = $request->status;
            $row->serial           = $request->serial;
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
            $row = $this->counter->find($id);
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
