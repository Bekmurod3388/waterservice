<?php

use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\DealerController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Middleware\LoggerMiddleware;
use Illuminate\Support\Facades\Route;


Route::post('/login', [LoginController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

    Route::put('updateProfile', [LoginController::class, 'updateProfile'])->middleware('auth:sanctum');
    Route::post('set-location', [LocationController::class, 'setLocation']);
    Route::put('point/location', [LocationController::class, 'setPointLocation']);


    // AGENT API
    Route::get('tasks', [AgentController::class, 'getTasks']);
    Route::get('tasks/{task}', [AgentController::class, 'task']);
    Route::post('tasks/{task}/complete', [AgentController::class, 'complete']);
    Route::post('tasks/{task}/verify', [AgentController::class, 'verify']);
    Route::get('tasks/competed', [AgentController::class, 'completedTasks']);

    // DEALER API
    Route::get('demos', [DealerController::class, 'getDemos']);
    Route::post('demo/{point}/cancel', [DealerController::class, 'cancel']);
    Route::post('demo/{point}/sold', [DealerController::class, 'sold']);
});
