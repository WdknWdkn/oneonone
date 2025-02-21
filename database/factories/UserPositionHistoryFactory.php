<?php

namespace Database\Factories;

use App\Models\UserPositionHistory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class UserPositionHistoryFactory extends Factory
{
    use HasAccount;

    protected $model = UserPositionHistory::class;
    
    public function definition(): array
    {
        return [
            'start_date' => now()->subMonths(rand(1, 12)),
            'end_date' => null,
        ];
    }
}
