<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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
}
