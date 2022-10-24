<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\GroupStudentRepositoryInterface;
use App\Http\Resources\GroupStudentResource;
use App\Http\Resources\UniversalResource;
use App\Models\GroupStudent;
use App\Models\Student;

class GroupStudentRepository implements GroupStudentRepositoryInterface {
    function __construct(
        private GroupStudent $groupStudent,
        private Student $student
    ){}


    function getGroupStudents($id){
        $groupStudents = $this->groupStudent
            ->with(['student:id,first_name,last_name,phone_number'])
            ->where('group_id', $id)
            ->get();
        return GroupStudentResource::collection($groupStudents);
    }

    function getUnjoinedStudents($groupId, $search){
        $joinedStudents = $this->groupStudent->where('group_id', $groupId)->pluck('student_id')->toArray();
        $students = $this->student
            ->select('id', 'first_name', 'last_name')
            ->whereNotIn('id', $joinedStudents)
            ->where(function($query) use ($search){
                return $query->where('first_name', 'ILIKE', "%$search%")
                    ->orWhere('last_name', "ILIKE", "$search");
            })
            ->where('status', 'confirmed')
            ->take(5)
            ->get();
        return UniversalResource::collection($students);
    }

    function addStudent($request){
        $student = $this->groupStudent->create([
            'group_id' => $request->group_id,
            'student_id' => $request->student_id,
            'bonus' => $request->bonus ?? 0
        ]);
        return response()->json(['message' => "The new student has successfully added to this group"]);
    }

    function updateActive($id){
        $groupStudent = $this->groupStudent->where('id', $id)->first();
        $groupStudent->active = !$groupStudent->active;
        $groupStudent->save();
        return response()->json(['message' => "The new student has successfully updated"]);
    }
}
