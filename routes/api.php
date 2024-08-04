<?php

use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Middleware\LoggerMiddleware;
use Illuminate\Support\Facades\Route;


Route::post('/login',[LoginController::class,'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',[LoginController::class,'logout'])->middleware('auth:sanctum');
    Route::put('/updateProfile', [LoginController::class, 'updateProfile'])->middleware('auth:sanctum');

    Route::get('/tasks', [AgentController::class, 'getTasks']);
    Route::get('/tasks/{task}',[AgentController::class,'task']);
    Route::get('/services',[ServiceController::class,'getServices']);

    Route::post('set-location', [LocationController::class, 'setLocation']);

    Route::put('point/location', [LocationController::class, 'setPointLocation']);
});
