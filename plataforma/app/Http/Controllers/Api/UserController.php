<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cadastro;
use App\Models\Deposito;
use App\Models\Ftd;
use App\Models\Login;
use App\Models\Visita;

class UserController extends Controller
{
    public function index(){
        return view('index'); 
    }

    public function pageGrafico(){
        return view('grafico');
    }

    public function cadastroForm(){
        return view('cadastro');
    }

    public function showLoginForm()
    {
        return view('entrar');
    }
    
    public function numUsers(){
        $totalUsuarios = User::count();
        return response()->json(['totalUsuarios' => $totalUsuarios]);
    }

    public function numLogins(){
        $totalLogins = Login::count();
        return response()->json(['totalLogins' => $totalLogins]);
    }

    public function numCadastros(){
        $totalCadastros = Cadastro::count();
        return response()->json(['totalCadastros' => $totalCadastros]);
    }

    public function numVisitas(){
        $totalVisitas = Visita::count();
        return response()->json(['totalVisitas' => $totalVisitas]);
    }

    public function numDepositos(){
        $totalDepositos = Deposito::count();
        return response()->json(['totalDepositos' => $totalDepositos]);
    }

    public function numFtds(){
        $totalFtds = Ftd::count();
        return response()->json(['totalFtds' => $totalFtds]);
    }

    public function valorTotalDep(){
        $valorTotalDepositos = Deposito::sum('valor');
        return response()->json(['valorTotalDepositos'=> $valorTotalDepositos]);
    }

    public function valorTotalFtd(){
        $valorTotalFtds = Ftd::sum('valor');
        return response()->json(['valorTotalFtds'=> $valorTotalFtds]);
    }   
}