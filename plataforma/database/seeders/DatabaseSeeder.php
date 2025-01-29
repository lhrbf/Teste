<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Deposito;
use App\Models\Cadastro;
use App\Models\Ftd;
use App\Models\Login;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(150)->create();

        Deposito::factory(250)->create();

        Cadastro::factory(150)->create();

        Ftd::factory(170)->create();

        Login::factory(320)->create();

    }
}