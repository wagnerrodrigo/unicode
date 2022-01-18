<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fornecedor;
use App\Models\Endereco;
use App\Repository\EnderecoRepository;
use Illuminate\Http\Request;
use App\Utils\Mascaras\Mascaras;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->has('chave_busca_fornecedor') && $request->has('valor_busca_fornecedor')) {
            $chave = $request->input('chave_busca_fornecedor');
            $valor = $request->input('valor_busca_fornecedor');
            $fornecedores = Fornecedor::selectAll($request->results, $chave, strtoupper($valor));
        } else {
            $fornecedores = Fornecedor::selectAll($results = 10);
        }
        $mascara = new Mascaras();

        return view('admin.fornecedor.lista-fornecedor', compact('fornecedores', 'mascara'));
    }

    public function formFornecedores()
    {
        return view('admin.fornecedor.add-fornecedor');
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
        $cpf_cnpj_corrigido = str_replace(['.', '-', '/'], '', $request->input('nu_cpf_cnpj'));

        //transforma todo o request em UpperCase

        $fornecedor->de_razao_social = strtoupper($request->de_razao_social);
        $fornecedor->de_nome_fantasia = strtoupper($request->de_nome_fantasia);
        $fornecedor->nu_cpf_cnpj = $cpf_cnpj_corrigido;
        $fornecedor->inscricao_estadual = $request->inscricao_estadual;
        $fornecedor->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
        //cria o fornecedor
        Fornecedor::create($fornecedor);

        //busca o id do fornecedor inserido

        $timestamp = $fornecedor->dt_inicio;
        $fornecedor_id = Fornecedor::findByTimeStamp($timestamp);



        for ($i = 0; $i < count($request->cep); $i++) {
            $enderecos[] = [
                "cep" => $request->cep[$i],
                "logradouro" => $request->logradouro[$i],
                "numero" => $request->numero[$i],
                "complemento" => $request->complemento[$i],
                "bairro" => $request->bairro[$i],
                "localidade" => $request->localidade[$i],
                "uf" => $request->uf[$i],
            ];
        }

        //salva o endereco
        $repository = new EnderecoRepository();
        $repository->createEndereco($fornecedor_id, $enderecos);

        return redirect()->route('fornecedores');
    }


    public function showByCnpj($cnpj)
    {
        $fornecedor = Fornecedor::findByCnpj($cnpj);

        //retorna Json
        return response()->json($fornecedor);
    }

    public function showByName($nome)
    {
        //transforma nome para UpperCase
        $nome = strtoupper($nome);
        //busca o fornecedor pelo nome
        $fornecedor = Fornecedor::findByName($nome);

        //retorna Json
        return response()->json($fornecedor);
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

    public function showCnpjCpf($nu_cpf_cnpj)
    {
        $fornecedor = Fornecedor::buscaCnpjCpf($nu_cpf_cnpj);
        return response()->json($fornecedor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $fornecedor = Fornecedor::findOne($id);
        $camposRequisicao = $request->all();

        foreach ($camposRequisicao as $key => $value) {
            if ($key != '_token') {
                $fornecedor->$key = strtoupper($value);
            }
        }

        Fornecedor::set($fornecedor);

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
        $fornecedor = Fornecedor::findOne($id);
        $dataFim = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();

        Fornecedor::del($dataFim, $fornecedor->id_fornecedor);

        return redirect()->route('fornecedores');
    }
}
