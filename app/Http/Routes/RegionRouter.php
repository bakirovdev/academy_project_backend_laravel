<?php

namespace App\Http\Routes;

use App\Http\Controllers\RegionController;
use App\Models\Region;
use Illuminate\Support\Facades\Route;

class RegionRouter {
    public static function routes(){
        Route::get('regions/active_region', [RegionController::class, 'index']);
    }
}
