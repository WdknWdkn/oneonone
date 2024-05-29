<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['interview_id', 'template_id'];

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }
    public function template()
    {
        return $this->belongsTo(Template::class);
    }    
}
