<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

    public function store(Request $request)
    {
        //dd($request->all());
        $despesa = new Despesa();
        $despesa->fk_centro_de_custo = $request->centro_custo_empresa;
        if($request->tipo_despesa == 'empregado'){

            $despesa->fk_tipo_despesa = 1;
        }else{
            $despesa->fk_tipo_despesa = 2;
        }

        $despesa->fk_plano_contas = $request->tipo_classificacao;
        $despesa->numero_documento_despesa - $request->numero_nota_documento;
        $despesa->qt_parcelas_despesa = $request->parcelas;
        $despesa->serie_despesa = null;
        $despesa->dt_emissao = null;
        $despesa->valor_total_despesa = $request->valor_total;
        $despesa->fk_status_despesa_id = 1;
        $despesa->fk_tab_fornecedor_id = null;
        $despesa->fk_tab_empregado_id = $request->empregado;
        $despesa->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
        $despesa->de_despesa = $request->descricao;
        $despesa->dt_vencimento = $request->data_vencimento;
        $despesa->moeda = $request->moeda;
        $despesa->dt_provisionamento = $request->data_provisionamento;
        $despesa->fk_condicao_pagamento_id = null;
        $despesa->dt_fim = null;

        Despesa::create($despesa);

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
