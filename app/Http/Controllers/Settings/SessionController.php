<?php

namespace App\Http\Controllers\Settings;

use App\Models\Session;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Settings\SessionInterface;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Session\StoreRequest;
use App\Http\Requests\Session\UpdateRequest;

class SessionController extends Controller
{
    private $session;

    function __construct(SessionInterface $session)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->session       = $session;
    }

    public function index()
    {
        $data['sessions'] = $this->session->all();

        $title             = ___('common.Sessions');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'session_create',
            "create-route" => 'sessions.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.settings.session.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add session');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => ___("common.Sessions"), "route" => "sessions.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.settings.session.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->session->store($request);
        if($result['status']){
            return redirect()->route('sessions.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit session');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => ___("common.Sessions"), "route" => "sessions.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['session']        = $this->session->show($id);
        return view('backend.admin.settings.session.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->session->update($request, $id);
        if($result['status']){
            return redirect()->route('sessions.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->session->destroy($id);
        if($result['status']):
            $success[0] = $result['message'];
            $success[1] = 'success';
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
            return response()->json($success);
        else:
            $success[0] = $result['message'];
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
            return response()->json($success);
        endif;
    }

    public function changeSession(Request $request)
    {
        $setting = Setting::where('name', 'session')->update(
            ['value' => $request->id]
        );
        if($setting){
            return 1;
        }
        return 0;

    }
}
