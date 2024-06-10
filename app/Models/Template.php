<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ['template_name', 'account_id'];

    public function templateItems()
    {
        return $this->hasMany(TemplateItem::class);
    }

    public function interviewTemplates()
    {
        return $this->hasMany(InterviewTemplate::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
