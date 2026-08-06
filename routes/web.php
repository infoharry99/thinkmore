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
        
        // Case Management CRUD & Interactive Mobile Preview
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
