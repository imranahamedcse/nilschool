<?php

namespace App\Http\Requests\UserManagement\User;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'role'         => 'required',
            'name'         => 'required|max:25',
            'email'        => 'required|unique:users,email',
            'phone'        => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:25',
            'status'       => 'required',
            'image'        => 'max:2048',
        ];
    }
}
