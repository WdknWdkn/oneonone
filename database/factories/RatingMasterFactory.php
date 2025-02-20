<?php

namespace Database\Factories;

use App\Models\RatingMaster;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class RatingMasterFactory extends Factory
{
    use HasAccount;

    protected $model = RatingMaster::class;
    
    public function definition(): array
    {
        return [
            'rating_name' => $this->faker->randomElement(['S', 'A', 'B', 'C']),
            'description' => $this->faker->sentence,
        ];
    }
}
