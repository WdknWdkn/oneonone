<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPositionApiController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->account_id === null) {
            return response()->json(['error' => 'Account not registered'], 403);
        }

        try {
            $positions = UserPosition::where('account_id', Auth::user()->account_id)->get();
            return response()->json(['positions' => $positions]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }
}
