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
        User::factory(200)->create();

        Deposito::factory(300)->create();

        Cadastro::factory(200)->create();

        Ftd::factory(180)->create();

        Login::factory(310)->create();

    }
}