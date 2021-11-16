<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
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
        $despesas = Despesa::selectAll();

        $despesasAtivas = [];
        $despesasInativas = [];

        for ($i = 0; $i < count($despesas); $i++) {
            if ($despesas[$i]->dt_fim === null) {
                $despesasAtivas[] = $despesas[$i];
            } else {
                $despesasInativos[] = $despesas[$i];
            };
        }

        //dd($despesasAtivas);
        return view('admin.despesas.lista-despesas', compact('despesasAtivas', 'despesasInativas'));
    }

    public function formDespesa()
    {
        return view('admin.despesas.add-despesa-fornecedor');
    }

    public function store()
    {
        return view('admin.despesas.add-despesas');
    }
    public function edit($id, Request $request){
        $despesa = Despesa::findOne($id);
        $camposRequisicao = $request->all();

        foreach ($camposRequisicao as $key => $value){
            if($key != '_token'){
                $despesa->$key = strtoupper($value);
            }
        }
        Despesa::set($despesa);

        return redirect()->route('despesas');
    }
}
