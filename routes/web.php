<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class,'loginPage'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
       return view('dashboard');
    });

    Route::resource('/client', ClientController::class);
    Route::resource('/service', ServiceController::class);
    Route::resource('/filter', FilterController::class);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
