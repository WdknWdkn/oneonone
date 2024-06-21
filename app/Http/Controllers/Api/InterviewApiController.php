<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Queries\InterviewQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewApiController extends Controller
{
    public function __construct()
    {
        $this->ensureAccountId();
    }

    public function index(Request $request)
    {
        try {
            $query = (new InterviewQuery($request))->apply();

            if (Auth::user()->role === 'user') {
                $query->where('interviewer_id', Auth::user()->id);
            }

            $interviews = $query->where('account_id', Auth::user()->account_id)->get();
            return response()->json(['interviews' => $interviews]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        $interview = Interview::where('account_id', Auth::user()->account_id)->findOrFail($id);
        $interview->delete();
        return response()->json(['success' => true]);
    }
}
