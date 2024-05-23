<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Queries\InterviewQuery;
use Illuminate\Http\Request;

class InterviewApiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $interviews = (new InterviewQuery($request))->apply();
            return response()->json(['interviews' => $interviews]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
        
    }

    public function destroy(Request $request, $id)
    {
        $interview = Interview::findOrFail($id);
        $interview->delete();
        return response()->json(['success' => true]);
    }
}
