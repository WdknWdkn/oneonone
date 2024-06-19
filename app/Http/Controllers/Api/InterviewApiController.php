<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Queries\InterviewQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewApiController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->account_id === null) {
            return response()->json(['error' => 'Account not registered'], 403);
        }

        try {
            // クエリビルダーを取得
            $query = (new InterviewQuery($request))->apply();

            // ユーザーの役割に応じてフィルタリング
            if (Auth::user()->role === 'user') {
                $query->where('interviewer_id', Auth::user()->id);
            }

            // account_id でフィルタリングし、インタビューを取得
            $interviews = $query->where('account_id', Auth::user()->account_id)->get();
            return response()->json(['interviews' => $interviews]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        if (Auth::user()->account_id === null) {
            return response()->json(['error' => 'Account not registered'], 403);
        }

        $interview = Interview::where('account_id', Auth::user()->account_id)->findOrFail($id);
        $interview->delete();
        return response()->json(['success' => true]);
    }
}
