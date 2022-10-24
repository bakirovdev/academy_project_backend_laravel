<?php
namespace App\Http\Routes;

use App\Http\Controllers\GroupLessonController;
use Illuminate\Support\Facades\Route;

class GroupLessonRouter {
   public static function routes(){
        Route::get('attendance/{id}', [GroupLessonController::class, 'getAttendance']);
        Route::post('lessons', [GroupLessonController::class, 'startLesson']);
        Route::post('attendance', [GroupLessonController::class, 'attendance']);
   }
}
