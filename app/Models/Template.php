<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ['template_name'];

    public function templateItems()
    {
        return $this->hasMany(TemplateItem::class);
    }

    public function interviewTemplates()
    {
        return $this->hasMany(InterviewTemplate::class);
    }
}
