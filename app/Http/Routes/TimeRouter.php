<?php

namespace App\Http\Routes;

use App\Http\Controllers\TimeController;
use Illuminate\Support\Facades\Route;

class TimeRouter {
    static function routes(){
        Route::get('/times', [TimeController::class, 'getAllTimes']);
        Route::post('/times', [TimeController::class, 'createTime']);
        Route::patch('/times/{id}', [TimeController::class, 'updateTime']);
        Route::patch('/times/update_active/{id}', [TimeController::class, 'updateActive']);
    }
}
