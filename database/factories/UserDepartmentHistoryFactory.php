<?php

namespace Database\Factories;

use App\Models\UserDepartmentHistory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class UserDepartmentHistoryFactory extends Factory
{
    use HasAccount;

    protected $model = UserDepartmentHistory::class;
    
    public function definition(): array
    {
        return [
            'start_date' => now()->subMonths(rand(1, 12)),
            'end_date' => null,
        ];
    }
}
