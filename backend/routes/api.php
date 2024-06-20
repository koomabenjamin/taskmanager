<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\CategoryController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('priorities', PriorityController::class);
    Route::apiResource('categories', CategoryController::class);
});
