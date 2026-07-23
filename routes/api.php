<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CaseController;
use App\Http\Controllers\Api\FoundationFeedbackController;
use App\Http\Controllers\Api\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes for ThinkClear Backend v1
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    // Authentication Routes (Public)
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Authenticated App Routes (Sanctum Token Protected)
    Route::middleware('auth:sanctum')->group(function () {

        // User Profile & Logout
        Route::get('/user/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // Case Engine & Daily Practice
        Route::get('/cases/today', [CaseController::class, 'todayCase']);
        Route::post('/cases/submit-reflection', [CaseController::class, 'submitReflection']);

        // Foundation Course Feedback Survey (PDF 1 Spec)
        Route::post('/foundation-feedback', [FoundationFeedbackController::class, 'store']);
        Route::get('/foundation-feedback/check', [FoundationFeedbackController::class, 'checkSubmitted']);

        // Admin Panel Endpoints
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard']);
            Route::get('/cases', [AdminController::class, 'listCases']);
            Route::post('/cases', [AdminController::class, 'createCase']);
        });

    });

});
