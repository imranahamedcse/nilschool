<?php

namespace App\Http\Controllers\WebsiteSetup;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\WebsiteSetup\SubscribeInterface;
use Illuminate\Support\Facades\Schema;

class SubscribeController extends Controller
{
    private $repo;

    function __construct(SubscribeInterface $repo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->repo                  = $repo;
    }

    public function index()
    {
        $data['subscribe'] = $this->repo->all();

        $title             = ___('common.Subscription');
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
