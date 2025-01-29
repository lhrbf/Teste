<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Deposito;
use App\Models\Cadastro;
use App\Models\Ftd;
use App\Models\Login;
use App\Models\Visita;
use Carbon\Carbon;

class TresMeses extends Seeder
{
    public function run()
    {
        // Criando 250 depósitos com as datas ajustadas para 3 meses atrás
        Deposito::factory(250)->create()->each(function ($deposito) {
            $deposito->update([
                'data_deposito' => Carbon::yesterday()->subMonths(3)->endOfDay(),
            ]);
        });

        // Criando 170 registros Ftd com as datas ajustadas para 3 meses atrás
        Ftd::factory(170)->create()->each(function ($ftd) {
            $ftd->update([
                'data_ftd' => Carbon::yesterday()->subMonths(3),
            ]);
        });

        // Criando 320 logins com as datas ajustadas para 3 meses atrás
        Login::factory(320)->create()->each(function ($login) {
            $login->update([
                'last_login_at' => Carbon::yesterday()->subMonths(3)->setTime(8, 30, 0),
            ]);
        });
        Visita::factory(400)->create()->each(function ($visita) {
             $visita->update([
                'data_visita' => Carbon::yesterday()->subMonths(3)->addDays(rand(0, 90))->startOfDay(),
            ]);
        });
    }
}