<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fornecedor;

class NotaFiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.nota');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fornecedor = new Fornecedor();

        $rules = [
            'nome' => 'required',
            'cnpj' => 'required',
            'email' => 'email',
            'telefone' => 'required',
            'inscricao_estadual' => 'required',
            'ramo_atuacao' => 'required',
            'ponto_contato' => 'required',
            'cargo_funcao' => 'required',
        ];

        //mensagens de feedback de validação
        $feedback = [
            'nome.required' => 'O campo CPF é obrigatório',
            'cnpj.required' => 'O campo CNPJ é obrigatório',
            'email.email' => 'O campo Email é obrigatório',
            'telefone.required' => 'O campo Telefone é obrigatório',
            'inscricao_estadual.required' => 'O campo Inscrição Estadual é obrigatório',
            'ramo_atuacao.required' => 'O campo Ramo Atuação é obrigatório',
            'ponto_contato.required' => 'O campo Ponto Contrato é obrigatório',
            'cargo_funcao.required' => 'O campo Cargo/Função é obrigatório'
        ];

        $fornecedor->nome = $request->nome;
        $fornecedor->cnpj = $request->cnpj;
        $fornecedor->email = $request->email;
        $fornecedor->telefone = $request->telefone;
        $fornecedor->inscricao_estadual = $request->insc_estadual;
        $fornecedor->ramo_atuacao = $request->ramo_atuacao;
        $fornecedor->ponto_contato = $request->ponto_contato;
        $fornecedor->cargo_funcao = $request->cargo_funcao;

        $fornecedor->save();
        echo "<script>alert('Fornecedor inserido com sucesso!') </script>";
        return view('admin.fornecedor');
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
