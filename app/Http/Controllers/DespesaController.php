<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$fornecedores = Despesa::all();
        return view('admin.despesas.lista-despesas');
    }

    public function despesaFornecedor()
    {
        return view('admin.despesas.add-despesa-fornecedor');
    }

    public function despesaEmpregado()
    {
        return view('admin.despesas.add-despesa-empregado');
    }

    public function store()
    {
        return view('admin.despesas.add-despesas');
    }
}
