<?php

namespace App\Http\Controllers\Settings;

use App\Models\Religion;
use Illuminate\Http\Request;
use App\Http\Interfaces\Settings\ReligionInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Religion\StoreRequest;
use App\Http\Requests\Religion\UpdateRequest;

class ReligionController extends Controller
{
    private $religion;

    function __construct(ReligionInterface $religion)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->religion       = $religion;
    }

    public function index()
    {
        $data['religions'] = $this->religion->getAll();

        $title             = ___('common.Religions');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'religion_create',
            "create-route" => 'religions.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.settings.religion.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add religion');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => ___("common.Religions"), "route" => "religions.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.settings.religion.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->religion->store($request);
        if($result['status']){
            return redirect()->route('religions.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit religion');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => ___("common.Religions"), "route" => "religions.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['religion']        = $this->religion->show($id);
        return view('backend.admin.settings.religion.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->religion->update($request, $id);
        if($result['status']){
            return redirect()->route('religions.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->religion->destroy($id);
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
}
