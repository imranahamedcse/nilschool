<?php

namespace App\Http\Repositories\Staff;
use App\Http\Interfaces\Settings\FlagIconInterface;
use App\Models\FlagIcon;
use App\Traits\CommonHelperTrait;

class FlagIconRepository implements FlagIconInterface
{
    use CommonHelperTrait;
    private $model;

    public function __construct(FlagIcon $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return FlagIcon::all();
    }

}
