<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'interview_date',
        'interviewer_name',
        'interviewer_id',
        'interviewee_name',
        'interviewee_id',
        'interview_content',
        'notes'
    ];
    protected $dates = ['interview_date'];
    
    public function interviewer()
    {
        return $this->belongsTo(User::class, 'interviewer_id');
    }
    
    public function interviewee()
    {
        return $this->belongsTo(User::class, 'interviewee_id');
    }

    public function interviewTemplates()
    {
        return $this->hasMany(InterviewTemplate::class);
    }

    public function interviewAnswers()
    {
        return $this->hasMany(InterviewAnswer::class);
    }
}
