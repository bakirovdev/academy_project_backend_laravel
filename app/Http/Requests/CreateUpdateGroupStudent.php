<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateGroupStudent extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'group_id' => 'required|integer',
            'student_id' => 'required|integer',
            'bonus' => 'required|numeric'
        ];
    }
}
