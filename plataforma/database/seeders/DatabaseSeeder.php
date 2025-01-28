<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Deposito;
use App\Models\Cadastro;
use App\Models\Ftd;
use App\Models\Login;
use App\Models\Visita;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(450)->create();

        Deposito::factory(600)->create();

        Cadastro::factory(400)->create();

        Ftd::factory(300)->create();

        Login::factory(820)->create();

    }
}