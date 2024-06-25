<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionApiController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\Api\ProfileApiController;

Route::prefix('v1')->group(function () {

    // Public routes
    // Route::post('login', [AuthenticatedSessionApiController::class, 'store'])->middleware('log.headers');
    Route::post('login', [AuthenticatedSessionApiController::class, 'store']);
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store']);
    Route::post('reset-password', [NewPasswordController::class, 'store']);
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['throttle:6,1'])->name('verification.send');
        
    // Route::get('/projects/all', [ProjectController::class, 'index']);
    
    // Authenticated routes
    Route::middleware(['auth:sanctum', EnsureFrontendRequestsAreStateful::class])->group(function () {
        Route::post('logout', [AuthenticatedSessionApiController::class, 'destroy']);

        // Route::apiResource('tasks', TaskController::class);
        // Show all tasks
        Route::get('/tasks/all', [TaskController::class, 'index']);
        // Create task
        Route::post('/tasks/create', [TaskController::class, 'store']);
        // Show specific task
        Route::get('/tasks/show/{task}', [TaskController::class, 'show']);
        // Update a task
        Route::match(['put', 'patch'], '/tasks/{task}/update', [TaskController::class, 'update']);
        // Delete a task
        Route::delete('/tasks/{task}/delete', [TaskController::class, 'destroy']);
        // Custom route to fetch soft-deleted tasks
        Route::get('/tasks/trashed/temp', [TaskController::class, 'trashed']);
        // Restore a single deleted task
        Route::post('/tasks/trashed/temp/{task}/restore', [TaskController::class, 'restore']);
        // Restore all deleted tasks
        Route::post('/tasks/trashed/temp/restore-all', [TaskController::class, 'restoreAll']);
        // Get all tasks past their implementation date.
        Route::get('tasks/past-implementation', [TaskController::class, 'tasksPastImplementationDate']);


        // Route::apiResource('projects', ProjectController::class);
        // View all projects
        Route::get('/projects/all', [ProjectController::class, 'index']);
        // Create a project
        Route::post('/projects/create', [ProjectController::class, 'store']);
        // View a single project
        Route::get('/projects/show/{project}', [ProjectController::class, 'show']);
        // Route::match(['put', 'patch'], '/projects/{task}/update', [ProjectController::class, 'update']);
        // Route::delete('/projects/{task}/delete', [ProjectController::class, 'destroy']);
        // Route::get('/projects/trashed/temp', [ProjectController::class, 'trashed']);
        // Route::post('/projects/trashed/temp/{project}/restore', [ProjectController::class, 'restore']);
        // Route::post('/projects/trashed/temp/restore-all', [ProjectController::class, 'restoreAll']);

        Route::apiResource('profiles', ProfileApiController::class)->only(['index', 'edit', 'update', 'destroy']);

    });
});
