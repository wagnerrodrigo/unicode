<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fornecedor;
use App\Models\Endereco;
use App\Models\UF;
use App\Models\Cidade;
use Illuminate\Http\Request;
use App\Utils\Mascaras\Mascaras;

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
        //transforma todo o request em UpperCase

        $fornecedor->de_razao_social = strtoupper($request->de_razao_social);
        $fornecedor->de_nome_fantasia = strtoupper($request->de_nome_fantasia);
        $fornecedor->nu_cpf_cnpj = $request->nu_cpf_cnpj;
        $fornecedor->inscricao_estadual = $request->inscricao_estadual;
        $fornecedor->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
        //cria o fornecedor
        Fornecedor::create($fornecedor);

        //busca o id do fornecedor inserido

        $timestamp = $fornecedor->dt_inicio;
        $fornecedor_id = Fornecedor::findByTimeStamp($timestamp);


        //instancia o model UF para buscar o id_uf
        $uf = new UF();


        //instancia o model cidade para buscar o id_cidade
        $cidade = new Cidade();
        //separa os enderecos em um array
        for ($i = 0; $i < count($request->cep); $i++) {
            $uf_id = $uf::findIdByUF($request->uf[$i]);
            $cidade_id = $cidade::findIdByCidade($request->localidade[$i]);
            $cep = str_replace('-', '', $request->cep[$i]);
            $enderecos[] = [
                "cep" => $cep ,
                "logradouro" => $request->logradouro[$i],
                "numero" => $request->numero[$i],
                "complemento" => $request->complemento[$i],
                "bairro" => $request->bairro[$i],
                "fk_tab_cidade_id" => $cidade_id,
                "fk_tab_uf_id" => $uf_id,
            ];
        }

        //salva os enderecos
        $endereco = new Endereco();

        for ($i = 0; $i < count($enderecos); $i++) {
            $endereco->fk_tab_fornecedor_id = $fornecedor_id[0]->id_fornecedor;
            $endereco->cep = $enderecos[$i]['cep'];
            $endereco->fk_tipo_logradouro = 1;
            $endereco->fk_tipo_endereco_id = 2;
            $endereco->logradouro = $enderecos[$i]['logradouro'];
            $endereco->numero = $enderecos[$i]['numero'];
            $endereco->complemento = $enderecos[$i]['complemento'];
            $endereco->bairro = $enderecos[$i]['bairro'];
            $endereco->fk_tab_cidade_id = $enderecos[$i]['fk_tab_cidade_id'];
            $endereco->fk_tab_uf_id = $enderecos[$i]['fk_tab_uf_id'];
            $endereco->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            $endereco->dt_fim = null;

            Endereco::create($endereco);
        }

        //Adiciona a data de inicio do fornecedor


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
