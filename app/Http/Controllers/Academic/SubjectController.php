<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Academic\Subject\StoreRequest;
use App\Http\Requests\Academic\Subject\UpdateRequest;
use App\Http\Interfaces\Academic\SubjectInterface;
use Illuminate\Support\Facades\Schema;

class SubjectController extends Controller
{
    private $subject;

    function __construct(SubjectInterface $subject)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->subject       = $subject;
    }

    public function index()
    {
        $data['subject'] = $this->subject->all();

        $title = ___('common.subject');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'subject_create',
            "create-route" => 'subject.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.academic.subject.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.create_subject');

        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.academic.subject.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->subject->store($request);
        if ($result['status']) {
            return redirect()->route('subject.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['subject']        = $this->subject->show($id);
        $data['title']       = ___('common.edit_subject');

        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.academic.subject.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->subject->update($request, $id);
        if ($result['status']) {
            return redirect()->route('subject.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->subject->destroy($id);
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
