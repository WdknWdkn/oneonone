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

    /**
     * interview_dateを日付ミューテータで扱う
     */
    protected $dates = ['interview_date'];
    
    public function getFormattedDateAttribute()
    {
        return $this->interview_date->format('Y-m-d');
    }

    /**
     * 面談を登録したユーザーを取得
     */
    public function interviewer()
    {
        return $this->belongsTo(User::class, 'interviewer_id');
    }
    public function interviewee()
    {
        return $this->belongsTo(User::class, 'interviewee_id');
    }   

    /**
     * 面談回答を取得
     */
    public function answers()
    {
        return $this->hasMany(InterviewAnswer::class);
    }
}
