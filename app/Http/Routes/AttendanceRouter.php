<?php
namespace App\Http\Routes;

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

class AttendanceRouter {
   public static function routes(){
        Route::post('attendances', [AttendanceController::class, 'createAttendance']);
   }
}
