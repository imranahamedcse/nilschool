<?php

namespace App\Http\Requests\Dormitory\Room;

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
            'room_no' => 'required|max:255|unique:rooms,room_no,'.Request()->id,
            'status'  => 'required'
        ];
    }
}
