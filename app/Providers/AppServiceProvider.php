<?php

namespace App\Providers;

use App\Http\Interfaces\CourseRepositoryInterface;
use App\Http\Interfaces\GroupLessonRepositoryInterface;
use App\Http\Interfaces\GroupRepositoryInterface;
use App\Http\Interfaces\GroupStudentRepositoryInterface;
use App\Http\Interfaces\GroupTeacherRepositoryInterface;
use App\Http\Interfaces\StudentDebitRepositoryInterface;
use App\Http\Interfaces\StudentRepositoryInterface;
use App\Http\Interfaces\TimeRepositoryInterface;
use App\Http\Repositories\UserRepository;
use App\Http\Interfaces\UserRepositoryInterface;
use App\Http\Repositories\CourseRepository;
use App\Http\Repositories\GroupLessonRepository;
use App\Http\Repositories\GroupRepository;
use App\Http\Repositories\GroupStudentRepository;
use App\Http\Repositories\GroupTeacherRepository;
use App\Http\Repositories\StudentDebitRepository;
use App\Http\Repositories\StudentRepository;
use App\Http\Repositories\TimeRepository;
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
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(TimeRepositoryInterface::class, TimeRepository::class);
        $this->app->bind(GroupRepositoryInterface::class, GroupRepository::class);
        $this->app->bind(GroupStudentRepositoryInterface::class, GroupStudentRepository::class);
        $this->app->bind(GroupTeacherRepositoryInterface::class, GroupTeacherRepository::class);
        $this->app->bind(GroupLessonRepositoryInterface::class, GroupLessonRepository::class);
        $this->app->bind(StudentDebitRepositoryInterface::class, StudentDebitRepository::class);
    }
}
