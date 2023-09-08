<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaWebInicioController extends Controller
{
    public function index(){


        return view('PaginaWebInicio.index');

    }
}
