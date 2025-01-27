<?php

namespace Database\Factories;

use App\Models\Login;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoginFactory extends Factory
{
    protected $model = Login::class;

    public function definition()
    {
        return [
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'last_login_at' => $this->faker->dateTimeThisMonth(),
        ];
    }
}