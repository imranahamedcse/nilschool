<?php

namespace App\Repositories\WebsiteSetup;

use App\Models\Event;
use App\Enums\Settings;
use Illuminate\Support\Facades\DB;
use App\Interfaces\WebsiteSetup\EventInterface;
use App\Traits\ReturnFormatTrait;
use App\Traits\CommonHelperTrait;

class EventRepository implements EventInterface{

    use ReturnFormatTrait;
    use CommonHelperTrait;
    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function all()
    {
        return $this->event->where('session_id', setting('session'))->active()->get();
    }

    public function getAll()
    {
        return $this->event->where('session_id', setting('session'))->orderBy('id', 'desc')->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $row                   = new $this->event;
            $row->session_id       = setting('session');
            $row->title            = $request->title;
            $row->description      = $request->description;
            $row->date             = $request->date;
            $row->start_time       = $request->start_time;
            $row->end_time         = $request->end_time;
            $row->address          = $request->address;
            $row->upload_id        = $this->UploadImageCreate($request->image, 'backend/uploads/event', $row->upload_id);
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
        return $this->event->find($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $row                   = $this->event->findOrfail($id);
            $row->title            = $request->title;
            $row->description      = $request->description;
            $row->date             = $request->date;
            $row->start_time       = $request->start_time;
            $row->end_time         = $request->end_time;
            $row->address          = $request->address;
            $row->upload_id        = $this->UploadImageUpdate($request->image, 'backend/uploads/event', $row->upload_id);
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
            $row = $this->event->find($id);
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
