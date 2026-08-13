<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminWebController;

/*
|--------------------------------------------------------------------------
| Web Routes - ThinkClear Admin Portal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Alias 'login' route to admin.login for Laravel default auth middleware
Route::get('/login', [AdminWebController::class, 'showLoginForm'])->name('login');

// Admin Auth Routes (Guest)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminWebController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminWebController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminWebController::class, 'logout'])->name('admin.logout');

    // Authenticated Admin Only Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminWebController::class, 'dashboard'])->name('admin.dashboard');
        
        // Admin Profile & Password Settings
        Route::get('/profile', [AdminWebController::class, 'profileShow'])->name('admin.profile');
        Route::put('/profile', [AdminWebController::class, 'profileUpdate'])->name('admin.profile.update');
        Route::put('/profile/password', [AdminWebController::class, 'passwordUpdate'])->name('admin.profile.password');

        // Foundation Program Days Management (Phase 1 Days 1–20)
        Route::get('/foundation', [AdminWebController::class, 'foundationIndex'])->name('admin.foundation.index');
        Route::get('/foundation/create', [AdminWebController::class, 'foundationCreate'])->name('admin.foundation.create');
        Route::post('/foundation', [AdminWebController::class, 'foundationStore'])->name('admin.foundation.store');
        Route::get('/foundation/{id}/edit', [AdminWebController::class, 'foundationEdit'])->name('admin.foundation.edit');
        Route::put('/foundation/{id}', [AdminWebController::class, 'foundationUpdate'])->name('admin.foundation.update');
        Route::get('/foundation/{id}/preview', [AdminWebController::class, 'foundationPreview'])->name('admin.foundation.preview');
        Route::delete('/foundation/{id}', [AdminWebController::class, 'foundationDestroy'])->name('admin.foundation.destroy');
        Route::post('/foundation/seed', [AdminWebController::class, 'foundationReSeed'])->name('admin.foundation.seed');

        // Case Management CRUD & Interactive Mobile Preview (Legacy)
        Route::get('/cases', [AdminWebController::class, 'casesIndex'])->name('admin.cases.index');
        Route::get('/cases/create', [AdminWebController::class, 'casesCreate'])->name('admin.cases.create');
        Route::post('/cases', [AdminWebController::class, 'casesStore'])->name('admin.cases.store');
        Route::get('/cases/{id}/edit', [AdminWebController::class, 'casesEdit'])->name('admin.cases.edit');
        Route::get('/cases/{id}/preview', [AdminWebController::class, 'casesPreview'])->name('admin.cases.preview');
        Route::put('/cases/{id}', [AdminWebController::class, 'casesUpdate'])->name('admin.cases.update');

        // Foundation Feedback Survey Reports (PDF 1)
        Route::get('/feedbacks', [AdminWebController::class, 'feedbacksIndex'])->name('admin.feedbacks.index');

        // Student Progress Tracker
        Route::get('/users', [AdminWebController::class, 'usersIndex'])->name('admin.users.index');
    });
});
