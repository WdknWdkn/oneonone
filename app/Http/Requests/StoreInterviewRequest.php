<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // アクセス制御が不要な場合はtrueを返します
    }

    public function rules()
    {
        return [
            'interview_date' => 'required|date',
            'interviewer_id' => 'required|integer|exists:users,id',
            'interviewer_name' => 'required|string|max:255',
            'interviewee_id' => 'required|integer|exists:users,id',
            'interviewee_name' => 'required|string|max:255',
            'interview_content' => 'required|string',
            'notes' => 'nullable|string',
        ];
    }
}
