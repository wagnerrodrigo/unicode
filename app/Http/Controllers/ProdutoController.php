<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('admin.produto.produto', compact('produtos'));
    }


    public function list(){
        return view('admin.produto.lista-produto');
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
        $produto = new Produto();
    
        $produto->nome = $request->nome;
        $produto->cnpj = $request->cnpj;
        $produto->email = $request->email;
        $produto->telefone = $request->telefone;
        $produto->inscricao_estadual = $request->inscricao_estadual;
        $produto->ramo_atuacao = $request->ramo_atuacao;
        $produto->ponto_contato = $request->ponto_contato;
        $produto->cargo_funcao = $request->cargo_funcao;

        $produto->save();

        echo "<script> alert('Produto criado com sucesso!!') </script>";
        
        return redirect('/produto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
