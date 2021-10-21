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

    public function addDespesa()
    {
        return view('admin.despesas.add-despesas');
    }
}
