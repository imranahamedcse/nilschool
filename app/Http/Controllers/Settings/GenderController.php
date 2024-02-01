<?php

namespace App\Http\Controllers\Settings;

use App\Models\Gender;
use Illuminate\Http\Request;
use App\Http\Interfaces\Settings\GenderInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Gender\StoreRequest;
use App\Http\Requests\Gender\UpdateRequest;

class GenderController extends Controller
{
    private $gender;

    function __construct(GenderInterface $gender)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->gender       = $gender;
    }

    public function index()
    {
        $data['genders'] = $this->gender->all();

        $title             = ___('common.Genders');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'gender_create',
            "create-route" => 'genders.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.settings.gender.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add gender');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => ___("common.Genders"), "route" => "genders.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.settings.gender.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->gender->store($request);
        if($result['status']){
            return redirect()->route('genders.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit gender');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => ___("common.Genders"), "route" => "genders.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['gender']        = $this->gender->show($id);
        return view('backend.admin.settings.gender.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->gender->update($request, $id);
        if($result['status']){
            return redirect()->route('genders.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->gender->destroy($id);
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
