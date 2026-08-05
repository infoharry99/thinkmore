<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CaseController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes - ThinkClear Mobile Application (v1)
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    // Public Auth Routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/social-login', [AuthController::class, 'socialLogin']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

    // Protected Routes (Sanctum Bearer Token Required)
    Route::middleware('auth:sanctum')->group(function () {

        // User Auth & Profile
        Route::get('/user/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // Daily Curriculum Scenario & Reflection
        Route::get('/cases/today', [CaseController::class, 'todayCase']);
        Route::post('/cases/submit-reflection', [CaseController::class, 'submitReflection']);
        Route::post('/cases/increment-day', [CaseController::class, 'incrementDay']);
        Route::post('/cases/next-day', [CaseController::class, 'incrementDay']); // Alias for next-day

        // Foundation Feedback Survey (60-Day PDF 1 Spec)
        Route::post('/foundation-feedback', [FeedbackController::class, 'submitFeedback']);

        // Mobile Admin Management (Optional)
        Route::middleware('admin')->prefix('admin')->group(function () {
            Route::get('/cases', [AdminController::class, 'listCases']);
            Route::post('/cases', [AdminController::class, 'createCase']);
        });
    });
});
