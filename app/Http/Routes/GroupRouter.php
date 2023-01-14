<?php
namespace App\Http\Routes;

use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

class GroupRouter {

    public static function routes(){
        Route::get('/groups', [GroupController::class, 'getAllGroup']);
        Route::get('/groups/{id}', [GroupController::class, 'findGroup']);
        Route::get('/group/user', [GroupController::class, 'getAuthGroup']);
        Route::patch('/groups/{id}', [GroupController::class, 'updateGroup']);
        Route::post('/groups', [GroupController::class, 'createGroup']);
    }
}
