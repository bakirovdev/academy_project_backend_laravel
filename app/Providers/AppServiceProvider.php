<?php

namespace App\Providers;

use App\Http\Interfaces\StudentRepositoryInterface;
use App\Http\Repositories\UserRepository;
use App\Http\Interfaces\UserRepositoryInterface;
use App\Http\Repositories\StudentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
    }
}
