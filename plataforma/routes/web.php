<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GraficoController;
use App\Http\Controllers\Api\GraficoInicial;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Get
Route::get('/', [LoginController::class, 'showLoginForm'])->middleware('guest');
Route::get('/cadastro', [UserController::class,'cadastroForm']);
Route::get('/grafico', [UserController::class,'pageGrafico'])->middleware('auth');
Route::get('/api/visitas', [UserController::class, 'numVisitas']);
Route::get('/api/logins', [UserController::class, 'numLogins']);
Route::get('/api/cadastros', [UserController::class, 'numCadastros']);
Route::get('/api/depositos', [UserController::class, 'numDepositos']);
Route::get('/api/ftds', [UserController::class, 'numFtds']);
Route::get('/api/valor-total-depositos', [UserController::class, 'valorTotalDep']);
Route::get('/api/valor-total-ftds', [UserController::class, 'valorTotalFtd']);
Route::get('/api/grafico/inicial', [GraficoInicial::class,'getGraficoInicial']);

// Post
Route::post('/api/grafico/filtro', [GraficoController::class, 'filtroData']);
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
