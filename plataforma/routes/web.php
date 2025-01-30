<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GraficoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PageController;

// Rota GET pagina inicial
Route::get('/', [PageController::class, 'index']);

// Rota GET protegida para mostrar o gráfico
Route::get('/grafico', [PageController::class, 'pageGrafico'])->name('grafico');//->middleware('auth');

// Rotas GET para as páginas de cadastro e login. Obs: Apenas para não autenticados
/*Route::middleware('guest')->group(function () {
    Route::get('/cadastro', [PageController::class,'cadastroForm'])->name('cadastro');
    Route::get('/entrar', [PageController::class, 'showLoginForm'])->name('entrar');
});*/

// Rotas GET de API para os dados
Route::get('/api/visitas', [UserController::class, 'numVisitas']);
Route::get('/api/logins', [UserController::class, 'numLogins']);
Route::get('/api/cadastros', [UserController::class, 'numCadastros']);
Route::get('/api/depositos', [UserController::class, 'numDepositos']);
Route::get('/api/ftds', [UserController::class, 'numFtds']);
Route::get('/api/valor-total-depositos', [UserController::class, 'valorTotalDep']);
Route::get('/api/valor-total-ftds', [UserController::class, 'valorTotalFtd']);

// Rotas POST de API para os dados
Route::post('/api/grafico/filtro', [GraficoController::class,'filtroData']);

// Rota POST para enviar o formulário de login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Rota POST para registrar um novo usuário
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Rota POST para logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
