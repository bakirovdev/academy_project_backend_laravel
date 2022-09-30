<?php

namespace App\Http\Routes;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

class UserRouter {
    public static function routes(){
        Route::resource('users', UserController::class);
    }
}
