<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GraficoController;
use App\Http\Controllers\Api\GraficoInicial;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', [UserController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/cadastro', [UserController::class,'cadastroForm'])->name('cadastro');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
});

// Rotas de API para os dados
Route::get('/api/visitas', [UserController::class, 'numVisitas']);
Route::get('/api/logins', [UserController::class, 'numLogins']);
Route::get('/api/cadastros', [UserController::class, 'numCadastros']);
Route::get('/api/depositos', [UserController::class, 'numDepositos']);
Route::get('/api/ftds', [UserController::class, 'numFtds']);
Route::get('/api/grafico/filtro', [GraficoController::class,'filtroData']);
Route::get('/api/valor-total-depositos', [UserController::class, 'valorTotalDep']);
Route::get('/api/valor-total-ftds', [UserController::class, 'valorTotalFtd']);

// Rota POST para enviar o formulário de login
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:login');

// Rota POST para registrar um novo usuário
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Rota POST para logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rota GET para pegar dados e incluir no gráfico
Route::get('/api/grafico/inicial', [GraficoInicial::class, 'getGraficoInicial'])->middleware('auth');

Route::get('/grafico', [UserController::class, 'pageGrafico'])->name('grafico')->middleware('auth');
