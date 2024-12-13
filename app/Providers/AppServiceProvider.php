<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\DepartmentRepositoryInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use App\Repositories\TaskRepositoryInterface;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
