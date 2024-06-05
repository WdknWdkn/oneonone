<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Queries\UserQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $userQuery = new UserQuery($request);
        $users = $userQuery->apply();
        $params = $userQuery->getParams();

        return Inertia::render('Users/Index', [
            'users' => $users,
            'params' => $params,
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return Inertia::render('Users/Detail', ['user' => $user]);
    }
}
