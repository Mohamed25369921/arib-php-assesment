<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('redirect.role')->name('home');

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Admin Routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::resource('users', UserController::class);
    });
    
    
    // Manager Routes
    Route::middleware(['role:manager|admin'])->group(function () {
        Route::resource('departments', DepartmentController::class);
        Route::resource('employees', EmployeeController::class);
        Route::get('tasks/assign', [TaskController::class, 'selectEmployee'])->name('tasks.assign');
        Route::get('tasks/assign/{employee}', [TaskController::class, 'create'])->name('tasks.create');
        Route::get('tasks/create/{id}', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('tasks/store', [TaskController::class, 'store'])->name('tasks.store');
        Route::post('tasks/update-status/{id}', [TaskController::class, 'updateStatus'])->name('tasks.update.status');
    });
    
    // Employee Routes
    Route::middleware(['role:employee|admin|manager'])->group(function () {
        Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    });
    
});