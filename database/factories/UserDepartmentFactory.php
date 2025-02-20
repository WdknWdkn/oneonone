<?php

namespace Database\Factories;

use App\Models\UserDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Traits\HasAccount;

class UserDepartmentFactory extends Factory
{
    use HasAccount;

    protected $model = UserDepartment::class;
    
    protected static $departments = ['営業部', '開発部', '人事部', '総務部', 'マーケティング部'];

    public function definition(): array
    {
        return [
            'name' => static::$departments[array_rand(static::$departments)],
        ];
    }
}
