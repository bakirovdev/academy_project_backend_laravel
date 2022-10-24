<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentDebitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'student_debit' => $this->student_money ?? ['value' => 0, 'student_id' => $this->id],
            'group_students' => $this->group_students
        ];
    }
}
