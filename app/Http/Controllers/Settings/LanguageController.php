<?php

namespace App\Http\Controllers\Settings;

use App;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Settings\FlagIconInterface;
use App\Http\Interfaces\Settings\LanguageInterface;
use Illuminate\Support\Facades\Schema;
use App\Http\Interfaces\Settings\PermissionInterface;
use App\Http\Requests\Language\StoreRequest;
use App\Http\Requests\Language\UpdateRequest;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    private $language;
    private $permission;
    private $flagIcon;

    function __construct(LanguageInterface $languageInterface, PermissionInterface $permissionInterface, FlagIconInterface $flagIconInterface)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->language   = $languageInterface;
        $this->permission = $permissionInterface;
        $this->flagIcon   = $flagIconInterface;
    }

    public function index()
    {
        $title             = ___('common.languages');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'language_create',
            "create-route" => 'languages.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];
        $data['languages'] = $this->language->getAll();
        return view('backend.admin.settings.languages.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.create_language');
        $data['permissions'] = $this->permission->all();
        $data['flagIcons']   = $this->flagIcon->getAll();
        return view('backend.admin.settings.languages.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->language->store($request);
        if ($result) {
            return redirect()->route('languages.index')->with('success', ___('alert.language_created_successfully'));
        }
        return redirect()->route('languages.index')->with('danger', ___('alert.something_went_wrong_please_try_again'));
    }

    public function edit($id)
    {
        $data['language']    = $this->language->show($id);
        $data['title']       = ___('common.languages');
        $data['permissions'] = $this->permission->all();
        $data['flagIcons']   = $this->flagIcon->getAll();
        return view('backend.admin.settings.languages.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->language->update($request, $id);
        if ($result) {
            return redirect()->route('languages.index')->with('success', ___('alert.language_updated_successfully'));
        }
        return redirect()->route('languages.index')->with('danger', ___('alert.something_went_wrong_please_try_again'));
    }

    public function delete($id)
    {
        if ($this->language->destroy($id)) :
            $success[0] = ___('alert.deleted_successfully');
            $success[1] = "success";
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
        else :
            $success[0] = ___('alert.something_went_wrong_please_try_again');
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
        endif;
        return response()->json($success);
    }

    public function terms($id)
    {
        $data = $this->language->terms($id);
        return view('backend.admin.settings.languages.terms', compact('data'));
    }

    public function termsUpdate(Request $request, $code)
    {
        $result = $this->language->termsUpdate($request, $code);

        if ($result) {
            return redirect()->route('languages.index')->with('success', ___('alert.language_terms_updated_successfully'));
        }
        return redirect()->route('languages.index')->with('danger', ___('alert.something_went_wrong_please_try_again'));
    }

    public function changeModule(Request $request)
    {
        $path           = base_path('lang/' . $request->code);
        $jsonString     = file_get_contents(base_path("lang/$request->code/$request->module.json"));
        $data['terms']  = json_decode($jsonString, true);

        return view('backend.admin.settings.languages.ajax_terms', compact('data'))->render();
    }


    public function changeLanguage(Request $request)
    {
        $path = base_path('lang/' . $request->code);
        if (is_dir($path)) {
            Session::put('locale', $request->code);
            return 1;
        }
        return 0;
    }
}
