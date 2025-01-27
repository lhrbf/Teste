<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cadastro;
use App\Models\Deposito;
use App\Models\Ftd;
use App\Models\Login;
use App\Models\Visita;

class GraficoInicial extends Controller
{
    public function getGraficoInicial()
    {
        $totalDepositos = Deposito::count();
        $totalVisitas = Visita::count();
        $totalCadastros = Cadastro::count();
        $totalFtds = Ftd::count();
        $totalLogins = Login::count();

        return response()->json([
            'success' => true,
            'message' => 'Dados filtrados com sucesso.',
            'data' => [
                'totalDepositos' => $totalDepositos,
                'totalVisitas' => $totalVisitas,
                'totalCadastros' => $totalCadastros,
                'totalFtds' => $totalFtds,
                'totalLogins' => $totalLogins,
            ],
        ]);
    }
}