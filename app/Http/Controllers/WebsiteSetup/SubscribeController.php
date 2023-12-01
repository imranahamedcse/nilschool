<?php

namespace App\Http\Controllers\WebsiteSetup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Repositories\WebsiteSetup\SubscribeRepository;

class SubscribeController extends Controller
{
    private $repo;

    function __construct(SubscribeRepository $repo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->repo                  = $repo;
    }

    public function index()
    {
        $data['subscribe'] = $this->repo->all();

        $title             = ___('settings.Subscription');
        $data['headers']   = [
            "title"        => $title,
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.website-setup.subscribe.index', compact('data'));
    }
}
