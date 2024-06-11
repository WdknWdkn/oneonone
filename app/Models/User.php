<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'current_department_id', 'current_position_id', 'role', 'account_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function interviewsAsInterviewer()
    {
        return $this->hasMany(Interview::class, 'interviewer_id');
    }

    public function interviewsAsInterviewee()
    {
        return $this->hasMany(Interview::class, 'interviewee_id');
    }

    public function department()
    {
        return $this->belongsTo(UserDepartment::class, 'current_department_id');
    }
    
    public function position()
    {
        return $this->belongsTo(UserPosition::class, 'current_position_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function userRatings()
    {
        return $this->hasMany(UserRating::class);
    }
    
}
