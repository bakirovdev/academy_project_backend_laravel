<?php
namespace App\Http\Routes;

use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

class GroupRouter {

    public static function routes(){
        Route::get('/groups', [GroupController::class, 'getAllGroup']);
        Route::post('/groups', [GroupController::class, 'createGroup']);
        Route::patch('/groups/{id}', [GroupController::class, 'updateGroup']);
    }
}
