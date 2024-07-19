<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientFilterController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginController::class,'loginPage'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
       return view('dashboard');
    });

    Route::resource('/client', ClientController::class);
    Route::resource('client/{client}/points',PointController::class)->names('client.points');
    Route::resource('/user', UserController::class);
    Route::resource('/service', ServiceController::class);
    Route::resource('/filters', FilterController::class);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
