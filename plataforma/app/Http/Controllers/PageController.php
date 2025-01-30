<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index'); 
    }

    public function pageGrafico()
    {
        return view('grafico');
    }

    public function cadastroForm()
    {
        return view('cadastro');
    }

    public function showLoginForm()
    {
        return view('entrar');
    }
}
