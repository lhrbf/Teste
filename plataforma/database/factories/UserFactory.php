<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'documento' => $this->faker->numerify('###.###.###-##'),
            'telefone' => $this->faker->phoneNumber(),
            'endereco' => $this->faker->address(),
        ];
    }
}
