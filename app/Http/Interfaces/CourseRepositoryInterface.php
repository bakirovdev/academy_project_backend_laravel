<?php

namespace App\Http\Interfaces;

interface CourseRepositoryInterface {
    function getAllCourses();
    function createCourse($request);
    function updateCourse($id, $request);
    function updateActive($id);
}
