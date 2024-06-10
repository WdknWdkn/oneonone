<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

abstract class Controller
{
    protected function ensureAccountId()
    {
        if (Auth::user()->account_id === null) {
            return redirect()->route('no-account')->send();
        }
    }
}
