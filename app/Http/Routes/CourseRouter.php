<?php

namespace App\Http\Routes;

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

class CourseRouter {
    static function routes(){
        Route::get('/courses', [CourseController::class, 'getAllCourses']);
        Route::post('/courses', [CourseController::class, 'createCourse']);
        Route::patch('/courses/{id}', [CourseController::class, 'updateCourse']);
        Route::patch('/courses/update_active/{id}', [CourseController::class, 'updateActive']);
    }
}
