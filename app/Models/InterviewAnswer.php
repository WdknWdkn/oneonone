<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['interview_id', 'template_item_id', 'answer_text', 'account_id'];

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function templateItem()
    {
        return $this->belongsTo(TemplateItem::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
