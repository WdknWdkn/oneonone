<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateItem extends Model
{
    use HasFactory;

    protected $fillable = ['template_id', 'question_text', 'question_type'];
    
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function interviewAnswers()
    {
        return $this->hasMany(InterviewAnswer::class, 'template_item_id');
    }
}
