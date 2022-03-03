<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Repository\EnderecoRepository;
use Carbon\Carbon;

class EnderecoController extends Controller
{
    public function index()
    {
        $enderecos = Endereco::selectAll();

        $enderecosAtivos = [];
        $enderecosInativos = [];

        for ($i = 0; $i < count($enderecos); $i++) {
            if ($enderecos[$i]->dt_fim === null) {
                $enderecosAtivos[] = $enderecos[$i];
            } else {
                $enderecosInativos[] = $enderecos[$i];
            };
        }

        // return view('admin.endereco.lista-endereco', compact('enderecosAtivos'));
    }

    public function formEndereco()
    {
        return view('admin.endereco.add-endereco');
    }

    public function selectEmpresa()
    {
        $enderecos = Endereco::empresa();

        $enderecosAtivos = [];
        $enderecosInativos = [];

        for ($i = 0; $i < count($enderecos); $i++) {
            if ($enderecos[$i]->dt_fim === null) {
                $enderecosAtivos[] = $enderecos[$i];
            } else {
                $enderecosInativos[] = $enderecos[$i];
            };
        }


        return view('admin.endereco.lista-endereco', compact('enderecosAtivos'));
    }

    public function show($id)
    {
        $endereco = Endereco::findOne($id);

        return view('admin.endereco.endereco', compact('endereco'));
    }


    public function store(Request $request)
    {
        $enderecoRepository = new EnderecoRepository();

        // inicio usado para converter strings com acento para upper case
        $encoding = 'UTF-8'; // ou ISO-8859-1...
        // --->  mb_convert_case('virá', MB_CASE_UPPER, $encoding)   <--;
        //fim

        $adresses = [
            [
                "cep" => $request->retornoCep,
                "logradouro" => strtoupper($request->logradouro[0]),
                "numero" => $request->numero[0],
                "complemento" => strtoupper($request->complemento[0]),
                "bairro" => mb_convert_case($request->bairro[0], MB_CASE_UPPER, $encoding),
                "localidade" => mb_convert_case($request->localidade[0], MB_CASE_UPPER, $encoding),
                "uf" => strtoupper($request->uf[0])
            ]
        ];

        $fornecedor = new \stdClass;
        $fornecedor->id_fornecedor = $request->fornecedor;

        $id_fornecedor = [
            "0" => $fornecedor,
        ];

        $enderecoRepository->createEndereco($id_fornecedor, $adresses);

        return redirect("/fornecedores/{$request->fornecedor}");
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
        $enderecoRepository = new EnderecoRepository();
        try {
            $enderecoRepository->deleteAdress($id, Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString());
            return response()->json(['success' => 'Endereço deletado com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
}
