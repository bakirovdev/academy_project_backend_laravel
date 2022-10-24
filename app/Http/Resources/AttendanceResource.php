<?php

namespace App\Http\Resources;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

class AttendanceResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "date" => $this->date,
            "group_id" => $this->group_id,
            "start_time" => $this->start_time,
            "end_time" => $this->end_time,
            "students" => $this->students()
        ];
    }

    private function students(){
        $students = Config::get('students');
        $data = [];
        for ($i=0; $i < count($students) ; $i++) {
            $attendance = Attendance::where('group_id', $this->group_id)
                ->where('student_id', $students[$i]['id'])
                ->where('group_lesson_id', $this->id)
                ->first();
            $data[] = [
                "id" => $students[$i]['id'],
                "first_name" => $students[$i]['first_name'],
                "last_name" => $students[$i]['last_name'],
                "attend" => $attendance ? ($attendance->attend ? 1 : 0) : 0,
                "comment" => $attendance->comment ?? null,
            ];
        }
        return $data;
    }
}
