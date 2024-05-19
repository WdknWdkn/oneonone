<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Interview;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Interview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $interviewer = User::factory()->create();
        $interviewee = User::factory()->create();

        return [
            'interview_date' => fake()->date(),
            'interviewee_name' => $interviewee->name,
            'interviewee_id' => $interviewee->id,
            'interviewer_name' => $interviewer->name,
            'interviewer_id' => $interviewer->id,
            'interview_content' => fake()->sentence(),
            'notes' => fake()->sentence(),
        ];
    }
}