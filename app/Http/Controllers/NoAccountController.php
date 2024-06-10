<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class NoAccountController extends Controller
{
    public function show()
    {
        return Inertia::render('NoAccount');
    }
}
