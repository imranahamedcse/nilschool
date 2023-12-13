<?php

namespace App\Http\Repositories\WebsiteSetup;

use App\Enums\Settings;
use App\Http\Interfaces\WebsiteSetup\ContactMessageInterface;
use App\Models\WebsiteSetup\Contact;

class ContactMessageRepository implements ContactMessageInterface{

    private $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('id','desc')->paginate(Settings::PAGINATE);
    }

}
