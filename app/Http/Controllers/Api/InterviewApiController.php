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
        $interviews = (new InterviewQuery($request))->apply();
        return response()->json(['interviews' => $interviews]);
    }

    public function destroy(Request $request, $id)
    {
        $interview = Interview::findOrFail($id);
        $interview->delete();
        return response()->json(['success' => true]);
    }
}
