<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fornecedores = Fornecedor::selectAll();

        $fornecedoresAtivos = [];
        $fornecedoresInativos = [];

        for ($i = 0; $i < count($fornecedores); $i++) {
            if ($fornecedores[$i]->dt_fim === null) {
                $fornecedoresAtivos[] = $fornecedores[$i];
            } else {
                $fornecedoresInativos[] = $fornecedores[$i];
            };
        }

        return view('admin.fornecedor.lista-fornecedor', compact('fornecedoresAtivos'));
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

        $fornecedor->de_razao_social = $request->razao_social;
        $fornecedor->inscricao_estadual = $request->inscricao_estadual;
        $fornecedor->nu_cpf_cnpj = $request->cnpj;
        $fornecedor->dt_inicio = Carbon::now()->toDateTimeString();
        $fornecedor->de_nome_fantasia = $request->nome_fantasia;
        
        Fornecedor::create($fornecedor);

        echo "<script> alert('Fornecedor criado com sucesso!!') </script>";

        return redirect()->route('fornecedores');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fornecedor = Fornecedor::findOne($id);
        return view('admin.fornecedor.fornecedor', compact('fornecedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $fornecedor = Fornecedor::find($id);
        $fornecedor->nome_fantasia = $request->nome_fantasia;
        $fornecedor->razao_social = $request->razao_social;
        $fornecedor->inscricao_estadual = $request->inscricao_estadual;
        $fornecedor->tipo_pessoa = $request->tipo_pessoa;
        $fornecedor->telefone = $request->telefone;
        $fornecedor->email = $request->email;
        $fornecedor->email_secundario = $request->email_secundario;
        $fornecedor->ponto_contato = $request->ponto_contato;
        $fornecedor->cargo_funcao = $request->cargo_funcao;
        $fornecedor->ramo_atuacao = $request->ramo_atuacao;

        $fornecedor->update();
        return redirect()->route('fornecedores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fornecedores = Fornecedor::find($id);

        $fornecedores->data_fim = Carbon::now()->toDateTimeString();
        $fornecedores->update();
        return redirect()->route('fornecedores');
    }

    public function formFornecedores()
    {
        return view('admin.fornecedor.add-fornecedor');
    }
}
