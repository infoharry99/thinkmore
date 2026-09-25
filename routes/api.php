<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CaseController;
use App\Http\Controllers\Api\FoundationFeedbackController;
use App\Http\Controllers\Api\FoundationController;
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

    // Public Curriculum Introductions
    Route::get('/foundation/introductions', [FoundationController::class, 'getIntroductions']);
    Route::get('/foundation/phase/{phase_number}/intro', [FoundationController::class, 'getPhaseIntro']);

    // Protected Routes (Sanctum Bearer Token Required)
    Route::middleware('auth:sanctum')->group(function () {

        // User Auth & Profile
        Route::get('/user/profile', [AuthController::class, 'profile']);
        Route::post('/user/profile', [AuthController::class, 'updateProfile']);
        Route::put('/user/profile', [AuthController::class, 'updateProfile']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // Foundation & Application Curriculum Program APIs (/api/v1/foundation/...)
        Route::prefix('foundation')->group(function () {
            // Introductions
            Route::get('/introductions', [FoundationController::class, 'getIntroductions']);
            Route::get('/phase/{phase_number}/intro', [FoundationController::class, 'getPhaseIntro']);

            // Progress & Unlocking Status
            Route::get('/progress', [FoundationController::class, 'getProgress']);

            // General Curriculum Days (Days 1–60)
            Route::get('/days/{day_number}', [FoundationController::class, 'getDayContent']);
            Route::post('/days/{day_number}/responses', [FoundationController::class, 'submitDayResponses']);
            Route::get('/days/{day_number}/responses', [FoundationController::class, 'getSavedResponses']);

            // Phase 1 Specific Aliases (Days 1–20)
            Route::get('/phase1/days/{day_number}', [FoundationController::class, 'getDayContent']);
            Route::post('/phase1/days/{day_number}/responses', [FoundationController::class, 'submitDayResponses']);
            Route::get('/phase1/days/{day_number}/responses', [FoundationController::class, 'getSavedResponses']);

            // Phase 2 Specific Aliases (Days 21–40)
            Route::get('/phase2/days/{day_number}', [FoundationController::class, 'getDayContent']);
            Route::post('/phase2/days/{day_number}/responses', [FoundationController::class, 'submitDayResponses']);
            Route::get('/phase2/days/{day_number}/responses', [FoundationController::class, 'getSavedResponses']);
        });

        // Daily Curriculum Scenario & Reflection (Legacy / Case endpoints)
        Route::get('/cases/today', [CaseController::class, 'todayCase']);
        Route::post('/cases/submit-reflection', [CaseController::class, 'submitReflection']);
        Route::post('/cases/increment-day', [CaseController::class, 'incrementDay']);
        Route::post('/cases/next-day', [CaseController::class, 'incrementDay']);

        // Foundation Feedback Survey (60-Day PDF 1 Spec)
        Route::post('/foundation-feedback', [FoundationFeedbackController::class, 'submitFeedback']);

        // Mobile Admin Management
        Route::middleware('admin')->prefix('admin')->group(function () {
            Route::get('/cases', [AdminController::class, 'listCases']);
            Route::post('/cases', [AdminController::class, 'createCase']);
        });
    });
});
