<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterviewAnswerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:template_items,id',
            'answers.*.answer' => 'required|string|max:255',
        ];
    }
}
