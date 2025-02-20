<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Interview;
use App\Models\Template;
use App\Models\InterviewAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class InterviewFactory extends Factory
{
    use HasAccount;

    protected $model = Interview::class;

    public function definition()
    {
        $interviewer = User::factory()->create();
        $interviewee = User::factory()->create();

        return [
            'interview_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'interviewee_name' => $interviewee->name,
            'interviewee_id' => $interviewee->id,
            'interviewer_name' => $interviewer->name,
            'interviewer_id' => $interviewer->id,
            'interview_content' => fake()->sentence(),
            'notes' => fake()->sentence(),
        ];
    }

    public function withAnswers($template = null)
    {
        return $this->afterCreating(function (Interview $interview) use ($template) {
            $template = $template ?? Template::factory()->withItems()->create([
                'account_id' => $interview->account_id
            ]);
            
            foreach ($template->templateItems as $item) {
                InterviewAnswer::factory()->create([
                    'interview_id' => $interview->id,
                    'template_item_id' => $item->id,
                    'account_id' => $interview->account_id,
                ]);
            }
        });
    }
}
