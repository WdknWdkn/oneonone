<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPositionHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'user_position_id', 'start_date', 'end_date', 'account_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userPosition()
    {
        return $this->belongsTo(UserPosition::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
