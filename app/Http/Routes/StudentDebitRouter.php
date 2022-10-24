<?php
namespace App\Http\Routes;

use App\Http\Controllers\StudentDebitController;
use Illuminate\Support\Facades\Route;

class StudentDebitRouter {
   public static function routes(){
        Route::get('/student_debits/students', [StudentDebitController::class, 'getStudents']);
        Route::post('/student_debits/payment', [StudentDebitController::class, 'payment']);
   }
}
