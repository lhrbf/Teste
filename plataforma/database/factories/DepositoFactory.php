<?php

namespace Database\Factories;

use App\Models\Deposito;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepositoFactory extends Factory
{
    protected $model = Deposito::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'valor' => $this->faker->randomFloat(2, 10, 1000),
            'data_deposito' => $this->faker->dateTimeThisYear(),
        ];
    }
}