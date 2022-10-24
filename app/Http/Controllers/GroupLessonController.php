<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\GroupLessonRepositoryInterface;
use Illuminate\Http\Request;

class GroupLessonController extends Controller
{
    function __construct(
        private GroupLessonRepositoryInterface $lessonRepository
    ){}

    function startLesson(Request $request){
        return $this->lessonRepository->startLesson($request);
    }

    function attendance(Request $request){
        return $this->lessonRepository->attendance($request);
    }

    function getAttendance( $id){
        return $this->lessonRepository->getAttendance($id);
    }
}
