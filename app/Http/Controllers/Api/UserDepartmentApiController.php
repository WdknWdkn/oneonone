<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserDepartment;
use Illuminate\Http\Request;

class UserDepartmentApiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $departments = UserDepartment::all();
            return response()->json(['departments' => $departments]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }
}
