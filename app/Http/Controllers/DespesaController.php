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

    public function show($id)
    {
        $despesa = Despesa::findOne($id);

        if ($despesa == null || empty($despesa)) {
            return $despesa;
        } else {
            $despesa = $despesa[0];
            return view('admin.despesas.detalhe-despesa', compact('despesa'));
        }
    }

    public function store()
    {
        return view('admin.despesas.add-despesas');
    }
}
