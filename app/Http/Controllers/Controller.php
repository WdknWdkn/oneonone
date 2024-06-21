<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function notEnsureUser()
    {
        if (Auth::user()->role === 'user') {
            abort(403, '権限が付与されていません。');
        }
    }

    protected function ensureAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, '権限が付与されていません。');
        }
    }

    protected function ensureAccountId()
    {
        if (Auth::user()->account_id === null) {
            return redirect()->route('no-account')->send();
        }
    }

    protected function ensureAuthorizedAccount($accountId)
    {
        if (Auth::user()->account_id !== $accountId) {
            abort(403, 'Unauthorized action.');
        }
    }

    protected function authorizeAction($accountId = null)
    {
        $user = Auth::user();
        if ($user->role === 'user') {
            abort(403, '権限が付与されていません。');
        }

        if ($accountId !== null && $user->role !== 'admin' && $user->account_id !== $accountId) {
            abort(403, 'Unauthorized action.');
        }
    }
}
