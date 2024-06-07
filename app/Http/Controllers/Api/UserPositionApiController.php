<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserPosition;
use Illuminate\Http\Request;

class UserPositionApiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $positions = UserPosition::all();
            return response()->json(['positions' => $positions]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }
}
