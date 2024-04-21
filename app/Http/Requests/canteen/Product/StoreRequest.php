<?php

namespace App\Http\Requests\Canteen\Product;

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
            'name'            => 'required|unique:products,name',
            'category'        => 'required',
            'sku'             => 'required',
            'price'           => 'required',
            'quantity'        => 'required',
            'status'          => 'required',
            'description'     => 'required'
        ];
    }
}
