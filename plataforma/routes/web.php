<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GraficoController;
use App\Http\Controllers\Api\GraficoInicial;


Route::get('/', [UserController::class, 'index']);
Route::get('/plataforma/resources/views/cadastro.blade.php', [UserController::class,'cadastroForm']);
Route::get('/plataforma/resources/views/grafico.blade.php', [UserController::class,'pageGrafico']);

Route::get('/api/visitas', [UserController::class, 'numVisitas']);
Route::get('/api/logins', [UserController::class, 'numLogins']);
Route::get('/api/cadastros', [UserController::class, 'numCadastros']);
Route::get('/api/depositos', [UserController::class, 'numDepositos']);
Route::get('/api/ftds', [UserController::class, 'numFtds']);
Route::get('/api/valor-total-depositos', [UserController::class, 'valorTotalDep']);
Route::get('/api/valor-total-ftds', [UserController::class, 'valorTotalFtd']);
Route::get('/api/grafico/inicial', [GraficoInicial::class,'getGraficoInicial']);
Route::post('/api/grafico/filtro', [GraficoController::class, 'filtroData']);
