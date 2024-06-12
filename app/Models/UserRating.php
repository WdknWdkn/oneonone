<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    use HasFactory;

    protected $table = 'user_ratings';

    protected $fillable = [
        'user_id',
        'rating_master_id',
        'rating_date',
        'reason',
        'account_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratingMaster()
    {
        return $this->belongsTo(RatingMaster::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
