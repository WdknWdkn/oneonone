<?php

namespace Database\Factories;

use App\Models\UserPosition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class UserPositionFactory extends Factory
{
    use HasAccount;

    protected $model = UserPosition::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->japanesePosition(),
        ];
    }
}
