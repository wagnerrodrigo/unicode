<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fornecedor;
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

        $fornecedoresAtivos = [];
        $fornecedoresInativos = [];
        //percorre o array de retorno de fornecedores
        for ($i = 0; $i < count($fornecedores); $i++) {
            //verifica se o fornecedor está ativo - pela data fim nula
            if ($fornecedores[$i]->dt_fim === null) {
                //verifica se a variavel nu_cpf_cnpj tem 14 digitos ou 11
                if (strlen($fornecedores[$i]->nu_cpf_cnpj) === 14) {
                    //se for 14 digitos, é um cnpj e é aplicada a mascara
                    $fornecedores[$i]->nu_cpf_cnpj = Mascaras::mask($fornecedores[$i]->nu_cpf_cnpj, '##.###.###/####-##');
                } else {
                    //se for 11 digitos, é um cpf e é aplicada a mascara
                    $fornecedores[$i]->nu_cpf_cnpj = Mascaras::mask($fornecedores[$i]->nu_cpf_cnpj, '###.###.###-##');
                }
                //adiciona o fornecedor ativo ao array de fornecedores ativos
                $fornecedoresAtivos[] = $fornecedores[$i];
            } else {
                //adiciona o fornecedor inativo ao array de fornecedores inativos
                $fornecedoresInativos[] = $fornecedores[$i];
            };
        }

        return view('admin.fornecedor.lista-fornecedor', compact('fornecedoresAtivos'));
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
        $camposRequisicao = $request->all();

        //transforma todo o request em UpperCase
        foreach ($camposRequisicao as $key => $value) {
            if ($key != '_token') {
                $fornecedor->$key = strtoupper($value);
            }
        }

        //Adiciona a data de inicio do fornecedor
        $fornecedor->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();

        Fornecedor::create($fornecedor);

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
