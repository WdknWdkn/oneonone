<?php

namespace Database\Factories;

use App\Models\InterviewAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class InterviewAnswerFactory extends Factory
{
    use HasAccount;

    protected $model = InterviewAnswer::class;
    
    public function definition(): array
    {
        return [
            'answer_text' => $this->faker->paragraph,
        ];
    }
}
