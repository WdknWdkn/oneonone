<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\User;
use App\Queries\InterviewQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewApiController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::guard('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $interviews = (new InterviewQuery($request))->apply();

        return response()->json(['interviews' => $interviews]);
    }
}
