<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CourseRepositoryInterface;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    function __construct(
        private CourseRepositoryInterface $courseRepository
    ){}

    public function getAllCourses(){
        return $this->courseRepository->getAllCourses();
    }
    public function createCourse(Request $request){
        return $this->courseRepository->createCourse($request);
    }
    public function updateCourse($id, Request $request){
        return $this->courseRepository->updateCourse($id, $request);
    }
    public function updateActive($id){
        return $this->courseRepository->updateActive($id);
    }
}
