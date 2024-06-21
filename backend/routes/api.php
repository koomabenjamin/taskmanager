<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
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
    Route::post('login', [AuthenticatedSessionApiController::class, 'store']);
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store']);
    Route::post('reset-password', [NewPasswordController::class, 'store']);
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['throttle:6,1'])->name('verification.send');
    
    // Authenticated routes
    Route::middleware(['auth:sanctum', EnsureFrontendRequestsAreStateful::class])->group(function () {
        Route::post('logout', [AuthenticatedSessionApiController::class, 'destroy']);

        Route::apiResource('tasks', TaskController::class);
        Route::apiResource('projects', ProjectController::class);
        Route::apiResource('profiles', ProfileApiController::class)->only(['index', 'edit', 'update', 'destroy']);

        // Custom route to fetch soft-deleted tasks
        Route::get('tasks/trashed', [TaskController::class, 'trashed']);
    });
});
