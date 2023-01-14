<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateGroupRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "course_id" => 'required',
            "times" => 'required|array',
            "title" => 'required'
        ];
    }
}
