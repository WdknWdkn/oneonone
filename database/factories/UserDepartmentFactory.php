<?php

namespace Database\Factories;

use App\Models\UserDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class UserDepartmentFactory extends Factory
{
    use HasAccount;

    protected $model = UserDepartment::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->japaneseDepartment(),
        ];
    }
}
