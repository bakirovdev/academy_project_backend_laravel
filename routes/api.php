<?php

use App\Http\Routes\CourseRouter;
use App\Http\Routes\GroupLessonRouter;
use App\Http\Routes\GroupRouter;
use App\Http\Routes\GroupStudentRouter;
use App\Http\Routes\GroupTeacherRouter;
use App\Http\Routes\OpenRouter;
use App\Http\Routes\RegionRouter;
use App\Http\Routes\StudentDebitRouter;
use App\Http\Routes\StudentRouter;
use App\Http\Routes\TimeRouter;
use App\Http\Routes\UserRouter;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    UserRouter::routes();
    RegionRouter::routes();
    StudentRouter::routes();
    CourseRouter::routes();
    TimeRouter::routes();
    GroupRouter::routes();
    GroupStudentRouter::routes();
    GroupTeacherRouter::routes();
    GroupLessonRouter::routes();
    StudentDebitRouter::routes();
});
OpenRouter::routes();
