<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\InterviewTemplate;
use App\Models\InterviewAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewAnswerApiController extends Controller
{
    public function store(Request $request, $id)
    {
        if (Auth::user()->account_id === null) {
            return response()->json(['error' => 'Account not registered'], 403);
        }

        $interview = Interview::where('account_id', Auth::user()->account_id)->findOrFail($id);

        InterviewTemplate::create([
            'interview_id' => $interview->id,
            'template_id' => $request->selectedTemplateId,
        ]);

        foreach ($request->answers as $answer) {
            InterviewAnswer::create([
                'interview_id' => $interview->id,
                'template_item_id' => $answer['question_id'],
                'answer_text' => $answer['answer'],
                'account_id' => Auth::user()->account_id,
            ]);
        }

        return response()->json(['message' => '質問に回答しました。'], 200);
    }
}
