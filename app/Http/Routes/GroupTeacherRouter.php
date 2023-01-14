<?php
namespace App\Http\Routes;

use App\Http\Controllers\GroupTeacherController;
use Illuminate\Support\Facades\Route;

class GroupTeacherRouter {
   public static function routes(){
        Route::get('group_teacher/{id}', [GroupTeacherController::class, 'getGroupTeachers']);
        Route::post('group_teacher', [GroupTeacherController::class, 'addTeacher']);
   }
}
