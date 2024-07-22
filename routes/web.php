<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientFilterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class,'loginPage'])->name('loginPage');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::resource('clients', ClientController::class);
    Route::resource('client/{client}/filters',PointController::class)->names('client.points');
    Route::get('client/{client}/tasks', [TaskController::class, 'clientTasks'])->name('clients.tasks.index');
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('filters', FilterController::class);
    Route::resource('tasks', TaskController::class);
    Route::get('work_list',[PointController::class,'work_list'])->name('work.list');

    Route::get('my_profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('my_profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
