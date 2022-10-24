<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "active" => $this->active,
            "end" => $this->end,
            "Course" => $this->course,
            'group_price' => $this->groupPrice ?? [],
            'GroupTeacher' => $this->groupTeacherUser() ?? []
        ];
    }

    private function groupTeacherUser(){
        $data = [];
        if (count($this->groupTeacher) > 0) {
            foreach($this->groupTeacher as $teacher){
                $data[] = ['id'=> $teacher->user->id, 'full_name' => $teacher->user->full_name, 'active' => $teacher->active, 'date' => $teacher->created_at];
            };
        }
        return $data;
    }
}
