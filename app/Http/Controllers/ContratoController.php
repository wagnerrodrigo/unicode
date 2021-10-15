<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function index()
    {
        //$fornecedores = Despesa::all();
        return view('admin.contratos.list-contratos');
    }
}
