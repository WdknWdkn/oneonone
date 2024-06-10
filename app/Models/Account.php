<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }

    public function templateItems()
    {
        return $this->hasMany(TemplateItem::class);
    }

    public function interviewTemplates()
    {
        return $this->hasMany(InterviewTemplate::class);
    }

    public function interviewAnswers()
    {
        return $this->hasMany(InterviewAnswer::class);
    }

    public function userDepartments()
    {
        return $this->hasMany(UserDepartment::class);
    }

    public function userPositions()
    {
        return $this->hasMany(UserPosition::class);
    }

    public function userDepartmentHistory()
    {
        return $this->hasMany(UserDepartmentHistory::class);
    }

    public function userPositionHistory()
    {
        return $this->hasMany(UserPositionHistory::class);
    }
}
