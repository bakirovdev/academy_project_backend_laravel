<?php

namespace App\Http\Routes;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

class UserRouter {
    public static function routes(){
        Route::resource('users', UserController::class);
        Route::put('users/update_active/{id}', [UserController::class, 'updateActive']);
    }
}
