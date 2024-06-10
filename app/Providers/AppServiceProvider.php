<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'auth' => function () {
                if (Auth::check()) {
                    return [
                        'user' => Auth::user()->only('id', 'name', 'email', 'role', 'account_id'),
                        'account' => Auth::user()->account, // account情報追加
                    ];
                }

                return null;
            },
        ]);
    }
}
