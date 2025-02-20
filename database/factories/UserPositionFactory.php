<?php

namespace Database\Factories;

use App\Models\UserPosition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class UserPositionFactory extends Factory
{
    use HasAccount;

    protected $model = UserPosition::class;
    
    protected static $positions = ['部長', '課長', '主任', '担当'];

    public function definition(): array
    {
        return [
            'name' => static::$positions[array_rand(static::$positions)],
        ];
    }
}
