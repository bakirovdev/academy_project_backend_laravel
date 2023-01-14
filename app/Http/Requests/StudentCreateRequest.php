<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required|date',
            'region_id' => 'required',
            'gender' => 'required|in:male,female',
        ];
    }
}
