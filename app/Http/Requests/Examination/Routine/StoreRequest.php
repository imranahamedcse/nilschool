<?php

namespace App\Http\Requests\Academic\Routine;

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
            'class'        => 'required',
            'section'      => 'required',
            'type'         => 'required',
            'date'         => 'required',
        ];
    }
}
