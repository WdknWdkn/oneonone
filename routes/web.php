<?php

use App\Http\Controllers\{
    AccountController,
    AccountUserController,
    InterviewController,
    NoAccountController,
    ProfileController,
    RatingMasterController,
    TemplateController,
    UserController,
    UserDepartmentController,
    UserPositionController,
    UserRatingController
};
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
    Route::resource('templates', TemplateController::class);
    Route::resource('user-departments', UserDepartmentController::class);
    Route::resource('user-positions', UserPositionController::class);
    Route::resource('rating-masters', RatingMasterController::class);

    Route::prefix('accounts')->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('accounts.index');
        Route::get('/create', [AccountController::class, 'create'])->name('accounts.create');
        Route::post('/', [AccountController::class, 'store'])->name('accounts.store');
        Route::get('/{account}', [AccountController::class, 'show'])->name('accounts.show');
        Route::get('/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
        Route::patch('/{account}', [AccountController::class, 'update'])->name('accounts.update');
        Route::delete('/{account}', [AccountController::class, 'destroy'])->name('accounts.destroy');
        Route::post('/{account}/link-user', [AccountController::class, 'linkUser'])->name('accounts.link-user'); // 追加
    });

    Route::prefix('accounts/{account}/users')->group(function () {
        Route::get('/{user}/edit', [AccountUserController::class, 'edit'])->name('account.user.edit');
        Route::put('/{user}', [AccountUserController::class, 'update'])->name('account.user.update');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/interviews', [UserController::class, 'getUserInterviews'])->name('users.interviews');
        Route::put('/{user}/update-department', [UserController::class, 'updateDepartment'])->name('users.update-department');
        Route::put('/{user}/update-position', [UserController::class, 'updatePosition'])->name('users.update-position');

        Route::prefix('{user}/ratings')->group(function () {
            Route::get('/', [UserRatingController::class, 'index'])->name('user-ratings.index');
            Route::get('/create', [UserRatingController::class, 'create'])->name('user-ratings.create');
            Route::post('/', [UserRatingController::class, 'store'])->name('user-ratings.store');
            Route::get('/{rating}/edit', [UserRatingController::class, 'edit'])->name('user-ratings.edit');
            Route::put('/{rating}', [UserRatingController::class, 'update'])->name('user-ratings.update');
            Route::delete('/{rating}', [UserRatingController::class, 'destroy'])->name('user-ratings.destroy');
        });
    });

    Route::get('/api/users/{id}/interviews', [UserController::class, 'getUserInterviews']);

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
