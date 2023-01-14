<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CourseRepositoryInterface;
use App\Http\Resources\UniversalResource;
use App\Models\Course;

class CourseRepository implements CourseRepositoryInterface {
    function __construct(
        private Course $course
    ){}

    function getAllCourses()
    {
        return UniversalResource::collection($this->course->get());
    }

    function createCourse($request)
    {
        $this->course->create([
            'title' => $request->title,
        ]);

        return response()->json(['message' => 'The new course has successfully created'], 200);
    }

    function updateCourse($id, $request){
        $course = $this->course->find($id);
        $course->update([
            'title' => $request->title
        ]);
        $course->save();
        return response()->json(['message' => 'The new course has successfully updated'], 200);
    }

    function updateActive($id){
        $course = $this->course->find($id);
        $course->update([
            'active' => !$course->active
        ]);
        $course->save();
        return response()->json(['message' => 'The new course has successfully updated'], 200);
    }
}
