<?php

namespace App\Http\Controllers;

use App\Models\InstituicaoFinanceira;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstituicaoFinanceiraController extends Controller
{
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituicao = InstituicaoFinanceira::all();
        $instituicoesAtivas = [];
        $instituicoesInativas = [];
        for($i = 0; $i < count($instituicao);$i++){
            if($instituicao[$i]->data_fim === null){
                $instituicoesAtivas[] = $instituicao[$i];
            }else{
                $instituicoesInativas[] = $instituicao;
            }
        }
        return view('admin.banco.lista-instituicao-financeira',compact('instituicoesAtivas'));
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
        $instituicao = new InstituicaoFinanceira();
        $instituicao->nome = $request->nome;
        $instituicao->cnpj = $request->cnpj;
        $instituicao->codigo = $request->codigo;
        $instituicao->situacao = $request->situacao;
        $instituicao->razao_social = $request->razao_social;
        $instituicao->descricao = $request->descricao;
        $instituicao->data_fim = $request->data_fim;
        $instituicao->save();

        return redirect()->route('instituicoes-financeira');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $instituicao = InstituicaoFinanceira::find($id);
       return view('admin.banco.instituicoes-financeira', compact('instituicao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $instituicao = InstituicaoFinanceira::find($id);
        $instituicao->nome = $request->nome;
        $instituicao->cnpj = $request->cnpj;
        $instituicao->codigo = $request->codigo;
        $instituicao->situacao = $request->situacao;
        $instituicao->razao_social = $request->razao_social;
        $instituicao->descricao = $request->descricao;
        $instituicao->update();
        return redirect()->route('instituicoes-financeira');

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
        $instituicao = InstituicaoFinanceira::find($id);

        $instituicao->data_fim = Carbon::now()->toDateTimeString();
        $instituicao->update();
        return redirect()->route('instituicoes-financeira');
    }
}
