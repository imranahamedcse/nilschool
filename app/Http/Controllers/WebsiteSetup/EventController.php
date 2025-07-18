<?php

namespace App\Http\Controllers\WebsiteSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\WebsiteSetup\EventInterface;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\WebsiteSetup\Event\StoreRequest;
use App\Http\Requests\WebsiteSetup\Event\UpdateRequest;

class EventController extends Controller
{
    private $eventRepo;

    function __construct(EventInterface $eventRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->eventRepo                  = $eventRepo;
    }

    public function index()
    {
        $data['event'] = $this->eventRepo->all();

        $title             = ___('common.Event');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'event_create',
            "create-route" => 'event.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.website-setup.event.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Create event');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Event"), "route" => "event.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.website-setup.event.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->eventRepo->store($request);
        if ($result['status']) {
            return redirect()->route('event.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit event');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Event"), "route" => "event.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['event']      = $this->eventRepo->show($id);
        return view('backend.admin.website-setup.event.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->eventRepo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('event.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->eventRepo->destroy($id);
        if ($result['status']) :
            $success[0] = $result['message'];
            $success[1] = 'success';
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
            return response()->json($success);
        else :
            $success[0] = $result['message'];
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
            return response()->json($success);
        endif;
    }
}
