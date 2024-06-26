<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'account_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
