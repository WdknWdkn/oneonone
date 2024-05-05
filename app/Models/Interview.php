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

    // 日付として扱う属性を指定
    protected $dates = ['interview_date'];

    // リレーション定義
    public function interviewer()
    {
        return $this->belongsTo(User::class, 'interviewer_id');
    }
    public function interviewee()
    {
        return $this->belongsTo(User::class, 'interviewee_id');
    }   
}
