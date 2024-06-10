<?php

use App\Http\Controllers\InterviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDepartmentController;
use App\Http\Controllers\UserPositionController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\NoAccountController;

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

Route::middleware('auth')->group(function () {
    Route::resource('interviews', InterviewController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('templates', TemplateController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/api/users/{user}/interviews', [UserController::class, 'getUserInterviews']);

    Route::put('/users/{user}/update-department', [UserController::class, 'updateDepartment'])->name('users.update-department');
    Route::put('/users/{user}/update-position', [UserController::class, 'updatePosition'])->name('users.update-position');
    
    Route::resource('user-departments', UserDepartmentController::class);
    Route::resource('user-positions', UserPositionController::class);

    Route::resource('accounts', AccountController::class);

    Route::get('/no-account', [NoAccountController::class, 'show'])->name('no-account');

});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'auth' => [
            'user' => Auth::user(),
            'account' => Auth::user()->account,
        ],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/api.php';
require __DIR__.'/auth.php';
