<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visita;
use Carbon\Carbon;

class VisitaSeeder extends Seeder
{
    public function run()
    {
        Visita::factory(400)->create()->each(function ($visita) {
            // Gerando uma data aleatória para cada visita nos últimos 3 meses
            $visita->update([
                'data_visita' => Carbon::yesterday()->subMonths(3)->addDays(rand(0, 90))->startOfDay(),
            ]);
        });
    }
};
