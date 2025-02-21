<?php

namespace Database\Factories;

use App\Models\Template;
use App\Models\TemplateItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class TemplateFactory extends Factory
{
    use HasAccount;

    protected $model = Template::class;
    
    public function definition(): array
    {
        return [
            'template_name' => $this->faker->randomElement(['月次面談', '四半期面談', '年次面談']),
        ];
    }
    
    public function withItems($count = 3)
    {
        return $this->afterCreating(function (Template $template) use ($count) {
            TemplateItem::factory()
                ->count($count)
                ->forAccount($template->account)
                ->create(['template_id' => $template->id]);
        });
    }
}
