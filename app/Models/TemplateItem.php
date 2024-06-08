<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateItem extends Model
{
    use HasFactory;

    protected $fillable = ['template_id', 'question_text', 'question_type'];

    /**
     * 質問の種類
     */
    const QUESTION_TYPE_TEXT = 'text';
    const QUESTION_TYPE_TEXTAREA = 'textarea';
    const QUESTION_TYPE_NUMBER = 'number';

    /**
     *   質問の種類の選択肢
     */
    public static function questionTypes()
    {
        return [
            ['label' => 'テキスト（一行）', 'value' => self::QUESTION_TYPE_TEXT],
            ['label' => 'テキスト（複数行）', 'value' => self::QUESTION_TYPE_TEXTAREA],
            ['label' => '数値', 'value' => self::QUESTION_TYPE_NUMBER],
        ];
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function interviewAnswers()
    {
        return $this->hasMany(InterviewAnswer::class, 'template_item_id');
    }
}
