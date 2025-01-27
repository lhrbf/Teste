<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visita;

class VisitaSeeder extends Seeder{
    public function run(){
        Visita::factory(300)->create();
    }
}



