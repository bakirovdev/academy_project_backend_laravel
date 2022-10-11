<?php

namespace App\Http\Routes;

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

class StudentRouter {
    public static function routes(){
        Route::resource('students', StudentController::class);
        Route::patch('students', [StudentController::class, 'update']);
        Route::put('students/update_status/{id}', [StudentController::class, 'checkStudent']);
    }
}
