<?php

namespace Database\Factories;

use App\Models\TemplateItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class TemplateItemFactory extends Factory
{
    use HasAccount;

    protected $model = TemplateItem::class;
    
    public function definition(): array
    {
        return [
            'question_text' => $this->faker->sentence . '?',
            'question_type' => $this->faker->randomElement(['text', 'rating', 'boolean']),
        ];
    }
}
