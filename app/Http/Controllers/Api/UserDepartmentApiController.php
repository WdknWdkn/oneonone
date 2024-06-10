<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDepartmentApiController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->account_id === null) {
            return response()->json(['error' => 'Account not registered'], 403);
        }

        try {
            $departments = UserDepartment::where('account_id', Auth::user()->account_id)->get();
            return response()->json(['departments' => $departments]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }
}
