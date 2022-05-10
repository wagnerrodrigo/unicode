<?php

namespace App\Http\Controllers;

use App\Models\ContaBancaria;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContaBancariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $contas = ContaBancaria::all();
        $contasAtivas = [];
        $contasInativas = [];
        for ($i = 0; $i < count($contas); $i++) {
            if ($contas[$i]->data_fim === null) {
                $contasAtivas[] = $contas[$i];
            } else {
                $contasInativas[] = $contas[$i];
            };
        }

        return view('admin.banco.lista-conta-bancaria', compact('contasAtivas'));
    }


    public function cadastro()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    public function storeWithJSON(Request $request)
    {
        if (!empty($request)) {
            $contas = new ContaBancaria();

            $contas->nu_agencia = $request->nu_agencia;
            $contas->nu_conta = $request->nu_conta;
            $contas->fk_tab_inst_banco_id = $request->inst_financeira;

            //verifica o tipo da despesa
            if ($request->tipo_da_despesa == 'empregado') {
                $contas->fk_tab_empregado_id = $request->id_titular_conta;
                $contas->fk_tab_fornecedor_id = null;
            } else {
                $contas->fk_tab_fornecedor_id = $request->id_titular_conta;
                $contas->fk_tab_empregado_id = null;
            }

            $contas->fk_tab_empresa_id = null;
            $contas->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            $contas->dt_fim = null;
            $contas->co_op = $request->co_operacao;

            ContaBancaria::create($contas);

            return json_encode([
                'message' => 'Conta Bancária cadastrada com sucesso!',
            ]);
        } else {
            return json_encode(['message' => 'Não foi possível cadastrar a conta bancária, preencha todos os campos']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conta = ContaBancaria::find($id);
        return view('admin.banco.detalhe-conta-bancaria', compact('conta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $conta = ContaBancaria::find($id);

        $conta->instituicao_bancaria = $request->instituicao_bancaria;
        $conta->numero_conta = $request->numero_conta;
        $conta->digito_conta = $request->digito_conta;
        $conta->agencia = $request->agencia;
        $conta->tipo_conta = $request->tipo_conta;
        $conta->titular = $request->titular;
        $conta->situacao = $request->situacao;
        $conta->descricao = $request->descricao;

        $conta->update();

        return redirect()->route('contas-bancarias');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conta = ContaBancaria::find($id);
        $conta->data_fim = Carbon::now()->toDateTimeString();
        $conta->update();

        return redirect()->route('contas-bancarias');
    }

    public function showByFornecedor($id)
    {
        $conta = ContaBancaria::getContaBancariaFornecedor($id);

        return response()->json($conta);
    }

    public function showByIdFornecedorEmpregado($id, $tipoDespesa)
    {// pegar o tipodespesa no copor da requisição se tiver empregado ou fornecedor
        if ($tipoDespesa == 'empregado') {
            $conta = ContaBancaria::getContaBancariaEmpregado($id);
        }
        if ($tipoDespesa == 'fornecedor') {
            $conta = ContaBancaria::getContaBancariaFornecedor($id);
        }

        return response()->json($conta);
    }
}
