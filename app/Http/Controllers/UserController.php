<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Interview;
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

    public function getUserInterviews($id)
    {
        $interviews = Interview::with([
            'interviewer',
            'interviewee',
            'interviewAnswers.templateItem'
        ])
        ->where('interviewer_id', $id)
        ->get();

        // dd($interviews);
        
        return response()->json(['interviews' => $interviews]);
    }
}
