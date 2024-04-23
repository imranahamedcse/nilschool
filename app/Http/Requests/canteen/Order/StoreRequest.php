<?php

namespace App\Http\Requests\Canteen\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $r)
    {
        return [
            'product'      => 'required',
            'member'       => 'required',
            'issue_date'   => 'required|date',
            'return_date'  => 'required|date|after_or_equal:issue_date',
            'phone'        => 'required'
        ];
    }
}
