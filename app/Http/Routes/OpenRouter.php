<?php

namespace App\Http\Routes;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

class OpenRouter {
    public static function routes(){
        Route::post('login', [UserController::class, 'authUser']);
    }
}
