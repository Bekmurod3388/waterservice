<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientFilterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProductController;
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
    Route::resource('client/{client}/products',PointController::class)->names('client.points');

//    client tasks

    Route::get('client/{client}/tasks', [TaskController::class, 'clientTasks'])->name('clients.tasks.index');
    Route::post('client/tasks/create', [TaskController::class, 'clientTasksCreate'])->name('clients.tasks.create');

    Route::resource('users', UserController::class);
    Route::get('agents',[AgentController::class,'index'])->name('agents.index');
    Route::resource('services', ServiceController::class);
    Route::resource('products', ProductController::class);
    Route::resource('tasks', TaskController::class);
    Route::get('work_list',[PointController::class,'work_list'])->name('work.list');
    Route::put('work_list/store{id}',[PointController::class,'work_list_create'])->name('work.list.store');

    Route::get('my_profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('my_profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
