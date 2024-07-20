<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientFilterController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class,'loginPage'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
       return view('dashboard');
    });

    Route::resource('/clients', ClientController::class);
    Route::resource('client/{client}/filters',PointController::class)->names('client.filter');
    Route::resource('/users', UserController::class);
    Route::resource('/services', ServiceController::class);
    Route::resource('/filters', FilterController::class);
    Route::get('/work_list',[PointController::class,'work_list'])->name('work.list');

    Route::get('/my_profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/my_profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
