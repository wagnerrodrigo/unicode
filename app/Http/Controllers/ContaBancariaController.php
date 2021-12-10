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
            }else{
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
        $contas = new ContaBancaria();

        $contas->instituicao_bancaria = $request->instituicao_bancaria;
        $contas->numero_conta = $request->numero_conta;
        $contas->digito_conta = $request->digito_conta;
        $contas->agencia = $request->agencia;
        $contas->tipo_conta = $request->tipo_conta;
        $contas->titular = $request->titular;
        $contas->situacao = $request->situacao;
        $contas->descricao = $request->descricao;
        $contas->data_fim = null;

        $contas->save();

        return redirect()->route('contas-bancarias');
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

    public function showByFornecedor($id){
        $conta = ContaBancaria::getContaBancariaFornecedor($id);

        return response()->json($conta);
    }
}
