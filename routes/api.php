<?php

use App\Http\Routes\OpenRouter;
use App\Http\Routes\UserRouter;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    UserRouter::routes();
});
OpenRouter::routes();
