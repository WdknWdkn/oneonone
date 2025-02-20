<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserDepartment;
use App\Models\UserPosition;
use App\Models\UserDepartmentHistory;
use App\Models\UserPositionHistory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Database\Factories\Traits\HasAccount;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    use HasAccount;

    protected static ?string $password;
    
    protected $model = User::class;
    
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'user',
        ];
    }
    
    public function withDepartmentHistory()
    {
        return $this->afterCreating(function (User $user) {
            $department = UserDepartment::factory()->forAccount($user->account)->create();
            UserDepartmentHistory::factory()->create([
                'user_id' => $user->id,
                'user_department_id' => $department->id,
                'start_date' => now()->subMonths(rand(1, 12)),
                'account_id' => $user->account_id,
            ]);
        });
    }
    
    public function withPositionHistory()
    {
        return $this->afterCreating(function (User $user) {
            $position = UserPosition::factory()->forAccount($user->account)->create();
            UserPositionHistory::factory()->create([
                'user_id' => $user->id,
                'user_position_id' => $position->id,
                'start_date' => now()->subMonths(rand(1, 12)),
                'account_id' => $user->account_id,
            ]);
        });
    }
    
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
