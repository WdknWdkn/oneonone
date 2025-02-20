<?php

namespace Database\Factories;

use App\Models\UserRating;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class UserRatingFactory extends Factory
{
    use HasAccount;

    protected $model = UserRating::class;
    
    public function definition(): array
    {
        return [
            'rating_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'reason' => $this->faker->optional()->sentence,
        ];
    }
}
