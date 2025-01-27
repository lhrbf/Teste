<?php

namespace Database\Factories;

use App\Models\Ftd;
use Illuminate\Database\Eloquent\Factories\Factory;

class FtdFactory extends Factory
{
    protected $model = Ftd::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'descricao' => $this->faker->sentence(),
            'valor' => $this->faker->randomFloat(2, 50, 500),
            'data_ftd' => $this->faker->dateTimeThisYear(),
        ];
    }
}