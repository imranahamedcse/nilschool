<?php

namespace App\Http\Controllers\WebsiteSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebsiteSetup\CounterRepository;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\WebsiteSetup\Counter\CounterStoreRequest;
use App\Http\Requests\WebsiteSetup\Counter\CounterUpdateRequest;

class CounterController extends Controller
{
    private $counterRepo;

    function __construct(CounterRepository $counterRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->counterRepo                  = $counterRepo;
    }

    public function index()
    {
        $data['counter'] = $this->counterRepo->getAll();
        $data['title'] = ___('settings.Counter');
        return view('website-setup.counter.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('website.Create counter');
        return view('website-setup.counter.create', compact('data'));
    }

    public function store(CounterStoreRequest $request)
    {
        $result = $this->counterRepo->store($request);
        if($result['status']){
            return redirect()->route('counter.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['counter']      = $this->counterRepo->show($id);
        $data['title']       = ___('website.Edit counter');
        return view('website-setup.counter.edit', compact('data'));
    }

    public function update(CounterUpdateRequest $request, $id)
    {
        $result = $this->counterRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('counter.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->counterRepo->destroy($id);
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
