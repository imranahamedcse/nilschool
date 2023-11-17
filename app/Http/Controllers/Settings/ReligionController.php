<?php

namespace App\Http\Controllers\Settings;

use App\Models\Religion;
use Illuminate\Http\Request;
use App\Interfaces\ReligionInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Religion\ReligionStoreRequest;
use App\Http\Requests\Religion\ReligionUpdateRequest;

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
        $data['title'] = ___('settings.religions');
        return view('backend.religion.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('settings.create_religion');
        return view('backend.religion.create', compact('data'));
    }

    public function store(ReligionStoreRequest $request)
    {
        $result = $this->religion->store($request);
        if($result['status']){
            return redirect()->route('religions.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['religion']        = $this->religion->show($id);
        $data['title']       = ___('settings.edit_religion');
        return view('backend.religion.edit', compact('data'));
    }

    public function update(ReligionUpdateRequest $request, $id)
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
