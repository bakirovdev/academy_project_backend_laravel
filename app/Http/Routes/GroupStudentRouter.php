<?php
namespace App\Http\Routes;

use App\Http\Controllers\GroupStudentController;
use Illuminate\Support\Facades\Route;

class GroupStudentRouter {
   public static function routes(){
        Route::get('group_students/un_joined_student', [GroupStudentController::class, 'getUnjoinedStudents']);
        Route::get('group_students/{id}', [GroupStudentController::class, 'getGroupStudents']);
        Route::patch('group_students/update_active/{id}', [GroupStudentController::class, 'updateActive']);
        Route::post('group_students', [GroupStudentController::class, 'addStudent']);
   }
}
