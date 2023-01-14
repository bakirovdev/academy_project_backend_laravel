<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\StudentRepositoryInterface;
use App\Http\Resources\StudentResource;
use App\Http\Resources\UniversalResource;
use App\Models\Student;

class StudentRepository implements StudentRepositoryInterface {

    protected Student $student;
    function __construct(Student $student){
        $this->student = $student;
    }

    function getAllStudents()
    {
        $dates = request('dates', []);
        $data = $this->student
            ->with(['region'])
            ->where(function($query) use ($dates){
                if (count($dates) > 1) {
                    return $query->whereBetween('created_at', $dates);
                }
            })
            ->paginate();
        return StudentResource::collection($data);
    }

    function createStudent($request){
        $this->student->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'region_id' => $request->region_id,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
        ]);
        return response()->json(['message' => 'New student just have created!!']);
    }

    function updateStudent($id, $request){
        $student = $this->student->where('id', $id)->first();
        $student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'region_id' => $request->region_id,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
        ]);
        $student->save();
        return response()->json(['message' => 'The user just has updated']);
    }

    function checkStudent($id, $status){
        $student = $this->student->where('id', $id)->first();
        if ($student->status == 'waiting') {
            $student->status = $status;
            $student->save();
            return response()->json(['message' => "The user just has $status"]);
        }
        return response()->json(['message' => "Already had $student->status"], 400);
    }
}
