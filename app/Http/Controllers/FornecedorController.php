<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fornecedor;
use App\Repository\AdressRepository;
use Illuminate\Http\Request;
use App\Utils\Mascaras\Mascaras;
use App\CustomError\CustomErrorMessage;
use GuzzleHttp\Client;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $results = $request->input('results');
            $chave = $request->input('chave_busca_fornecedor');
            $valor = $request->input('valor_busca_fornecedor');

            if ($request->has('chave_busca_fornecedor') && $request->has('valor_busca_fornecedor')) {
                $fornecedores = Fornecedor::selectAll($results, $chave, strtoupper($valor));
            } else {
                if ($results == null) {
                    $fornecedores = Fornecedor::selectAll($results = 10);
                } else {
                    $fornecedores = Fornecedor::selectAll($results);
                }
            }
            $mascara = new Mascaras();

            return view('admin.fornecedor.lista-fornecedor', compact('fornecedores', 'mascara', 'results', 'chave', 'valor'));
        } catch (\Exception $e) {
            $error = CustomErrorMessage::ERROR_LIST_FORNECEDOR;
            return view('error', compact('error'));
        }
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
        try {
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
                $adresses[] = [
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
            $adressRepository = new AdressRepository();
            $adressRepository->createAdress($fornecedor_id, $adresses);

            return redirect()->back()->with('success', 'Fornecedor Cadastrado com Sucesso!!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Não foi possível cadastrar o fornecedor');
        }
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
        try {
            $fornecedor = Fornecedor::findOne($id);
            if (!$fornecedor->dt_fim) {
                $mascara = new Mascaras();

                $AdressRepository = new AdressRepository();
                $adresses = $AdressRepository->findAdressByProvider($id);

                $retorno = ["success" => null];

                return view('admin.fornecedor.fornecedor', compact('fornecedor', 'mascara', 'retorno', 'adresses'));
            } else {
                $error = CustomErrorMessage::ERROR_FORNECEDOR;
                return view('error', compact('error'));
            }
        } catch (\Exception $e) {
            $error = CustomErrorMessage::ERROR_FORNECEDOR;
            return view('error', compact('error'));
        }
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
        try {
            $fornecedor = Fornecedor::findOne($id);
            $camposRequisicao = $request->all();

            foreach ($camposRequisicao as $key => $value) {
                if ($key != '_token') {
                    $fornecedor->$key = strtoupper($value);
                }
            }

            Fornecedor::set($fornecedor);

            return redirect()->back()->with('success', 'Fornecedor alterado com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dataFim = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            Fornecedor::del($dataFim, $id);

            return redirect()->back()->with('success', 'Fornecedor Removido com Sucesso!!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Não foi possível Remover o fornecedor');
        }
    }

    public function webScraping($cnpj)
    {
        $client = new Client([
            'base_uri' => 'https://publica.cnpj.ws/cnpj/',
            'timeout'  => 5.0,
        ]);
        $response = $client->request('GET',$cnpj);
        $body = $response->getBody();

        echo $body;

    }
}
