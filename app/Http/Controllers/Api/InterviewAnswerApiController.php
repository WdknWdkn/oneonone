<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\InterviewTemplate;
use App\Models\InterviewAnswer;
use Illuminate\Http\Request;

class InterviewAnswerApiController extends Controller
{
    public function store(Request $request, $id)
    {
        $interview = Interview::findOrFail($id);

        InterviewTemplate::create([
            'interview_id' => $interview->id,
            'template_id' => $request->selectedTemplateId,
        ]);

        foreach ($request->answers as $answer) {
            InterviewAnswer::create([
                'interview_id' => $interview->id,
                'template_item_id' => $answer['question_id'],
                'answer_text' => $answer['answer'],
            ]);
        }

        return response()->json(['message' => '質問に回答しました。'], 200);
    }
}
