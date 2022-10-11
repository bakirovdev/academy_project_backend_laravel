<?php

use App\Http\Routes\CourseRouter;
use App\Http\Routes\OpenRouter;
use App\Http\Routes\RegionRouter;
use App\Http\Routes\StudentRouter;
use App\Http\Routes\TimeRouter;
use App\Http\Routes\UserRouter;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    UserRouter::routes();
    RegionRouter::routes();
    StudentRouter::routes();
    CourseRouter::routes();
    TimeRouter::routes();
});
OpenRouter::routes();
