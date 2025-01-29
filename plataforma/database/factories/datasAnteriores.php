<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class UsuarioFactory extends Factory
{
    public function definition()
    {
        return [
            'data_ftd' => Carbon::yesterday()->subMonths(3),
            'last_login_at' => Carbon::yesterday()->subMonths(3)->setTime(8, 30, 0),
            'data_visita' => Carbon::yesterday()->subMonths(3)->startOfDay(),
            'data_deposito' => Carbon::yesterday()->subMonths(3)->endOfDay(),
        ];
    }
}