<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['interview_id', 'template_item_id', 'answer_text'];

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function templateItem()
    {
        return $this->belongsTo(TemplateItem::class, 'template_item_id');
    }
}
