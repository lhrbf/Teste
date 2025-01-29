<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Login;
use App\Models\Cadastro;
use App\Models\Visita;
use App\Models\Deposito;
use App\Models\Ftd;
use App\Http\Controllers\Controller;

class GraficoController extends Controller
{
    public function filtroData(Request $request)
    {
        $validated = $request->validate([
            'periodo' => 'required|integer|in:1,2,3,4,5',
            'startDate' => 'nullable|date|date_format:Y-m-d',
            'endDate' => 'nullable|date|date_format:Y-m-d',
        ]);

        $periodo = $validated['periodo'];
        $startDate = $validated['startDate'];
        $endDate = $validated['endDate'] ? Carbon::parse($validated['endDate']) : Carbon::today()->endOfDay();

        $dataInicio = $startDate ? Carbon::parse($startDate) : $this->getDataInicioPorPeriodo($periodo);

        $logins = Login::whereBetween('last_login_at', [$dataInicio, $endDate])->count() ?? 0;
        $cadastros = Cadastro::whereBetween('created_at', [$dataInicio, $endDate])->count() ?? 0;
        $visitas = Visita::whereBetween('data_visita', [$dataInicio, $endDate])->count() ?? 0;
        $depositos = Deposito::whereBetween('created_at', [$dataInicio, $endDate])->count() ?? 0;
        $ftds = Ftd::whereBetween('data_ftd', [$dataInicio, $endDate])->count() ?? 0;

        return response()->json([
            'success' => true,
            'message' => 'Dados filtrados com sucesso.',
            'data' => [
                'depositos' => $depositos,
                'visitas' => $visitas,
                'ftds' => $ftds,
                'logins' => $logins,
                'cadastros' => $cadastros,
            ],
        ]);
    }

    /**
     * Data inicial com base no período.
     *
     * @param int $periodo
     * @return Carbon
     */
    private function getDataInicioPorPeriodo(int $periodo)
    {
        switch ($periodo) {
            case 1:
                return Carbon::today()->startOfDay();
            case 2:
                return Carbon::yesterday()->startOfDay();
            case 3:
                return Carbon::now()->subDays(7)->startOfDay();
            case 4:
                return Carbon::now()->subMonth()->startOfDay();
            case 5:
                return Carbon::now()->subMonths(3)->startOfDay();
            default:
                throw new \InvalidArgumentException('Período inválido.');
        }
    }
}
