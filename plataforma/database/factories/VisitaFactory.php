<?php

namespace Database\Factories;

use App\Models\Visita;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitaFactory extends Factory
{
    protected $model = Visita::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'data_visita' => $this->faker->dateTimeThisYear(),
            'local' => $this->faker->city(),
        ];
    }
}