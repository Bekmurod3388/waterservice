<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientFilterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Mobile\MobileAgentController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\CheckTokenMiddleware;
use App\Http\Middleware\LoggerMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'loginPage'])->name('loginPage');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::get('mobile-login', [LoginController::class, 'mobileLogin']);


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('logs', [DashboardController::class, 'logs'])->name('logs.index');
    Route::get('map', [DashboardController::class, 'map'])->name('map.index');
    Route::get('markers', [DashboardController::class, 'getMarkers'])->name('map.markers');

    Route::resource('clients', ClientController::class);
    Route::resource('client/{client}/points', PointController::class)->names('client.points');

//    client tasks

    Route::get('client/{client}/tasks', [TaskController::class, 'clientTasks'])->name('clients.tasks.index');
    Route::post('client/tasks/create', [TaskController::class, 'clientTasksCreate'])->name('clients.tasks.create');

    Route::resource('users', UserController::class);
    Route::get('agents', [AgentController::class, 'index'])->name('agents.index');
    Route::post('agents/create-task', [AgentController::class, 'storeTask'])->name('agents.create_task');
    Route::resource('services', ServiceController::class);
    Route::resource('products', ProductController::class);
    Route::get('agents/{agent}/products',[AgentController::class,'products'])->name('agent.products');
    Route::post('agent/{agent}/products/store',[AgentController::class,'product_store'])->name('agent.products.store');
    Route::post('agent/{agent}/products/update/{product}',[AgentController::class,'product_update'])->name('agent.products.update');
    Route::get('agent/{agent}/tasks',[AgentController::class,'agent_tasks'])->name('agent.tasks');
    Route::resource('tasks', TaskController::class);
    Route::get('work/list', [PointController::class, 'workList'])->name('work.list');
    Route::put('work/change-expire/{point}', [PointController::class, 'changeExpireDate'])->name('work.change_expire_date');

    Route::get('my_profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('my_profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix('mobile/{token}')->middleware(CheckTokenMiddleware::class)->group(function () {

    Route::prefix('agent')->group(function () {
        Route::get('index', [MobileAgentController::class, 'index'])->name('mobile.agent.index');
        Route::get('task-items', [MobileAgentController::class, 'taskItems'])->name('mobile.agent.task_items');
        Route::get('products', [MobileAgentController::class, 'taskItems'])->name('mobile.agent.products');
        Route::get('history', [MobileAgentController::class, 'taskItems'])->name('mobile.agent.history');
        Route::get('settings', [MobileAgentController::class, 'taskItems'])->name('mobile.agent.settings');
    });

    Route::prefix('dealer')->group(function () {

    });
});
