<?php

namespace App\Http\Requests\HumanResource\Staff;

use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'staff_id'     => 'required|unique:staff,staff_id,'.$this->id,
            'role'         => 'required',
            'designation'  => 'required',
            'department'   => 'required',
            'first_name'   => 'required|max:25',
            'email'        => 'required|unique:users,email,'.Request()->user_id,
            'gender'       => 'required',
            'dob'          => 'required',
            'phone'        => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:25',
            'status'       => 'required',
            'image'        => 'max:2048',
        ];
    }
}
