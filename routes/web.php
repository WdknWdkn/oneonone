<?php

use App\Http\Controllers\InterviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// ミドルウェアグループ内にInterviewControllerのルートを配置
Route::middleware('auth')->group(function () {
    Route::resource('interviews', InterviewController::class);
        // // Index: 面談一覧
        // Route::get('/interviews', [InterviewController::class, 'index'])->name('interviews.index');

        // // Create: 新規面談登録フォーム表示
        // Route::get('/interviews/create', [InterviewController::class, 'create'])->name('interviews.create');
    
        // // Store: 新規面談登録処理
        // Route::post('/interviews', [InterviewController::class, 'store'])->name('interviews.store');
    
        // // Show: 特定の面談詳細表示
        // Route::get('/interviews/{interview}', [InterviewController::class, 'show'])->name('interviews.show');
    
        // // Edit: 特定の面談編集フォーム表示
        // Route::get('/interviews/{interview}/edit', [InterviewController::class, 'edit'])->name('interviews.edit');
    
        // // Update: 特定の面談更新処理
        // Route::put('/interviews/{interview}', [InterviewController::class, 'update'])->name('interviews.update');
    
        // // Destroy: 特定の面談削除処理
        // Route::delete('/interviews/{interview}', [InterviewController::class, 'destroy'])->name('interviews.destroy');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/api.php';

require __DIR__.'/auth.php';
