<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Repository\AddressRepository;
use Illuminate\Http\Request;
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
        $enderecoRepository = new AddressRepository();

        // inicio usado para converter strings com acento para upper case
        $encoding = 'UTF-8'; // ou ISO-8859-1...
        // --->  mb_convert_case('virá', MB_CASE_UPPER, $encoding)   <--;
        //fim

        $adresses = [
            [
                "cep" => $request->retornoCep,
                "logradouro" => mb_convert_case($request->logradouro[0], MB_CASE_UPPER, $encoding),
                "numero" => $request->numero[0],
                "complemento" => mb_convert_case($request->complemento[0], MB_CASE_UPPER, $encoding),
                "bairro" => mb_convert_case($request->bairro[0], MB_CASE_UPPER, $encoding),
                "localidade" => mb_convert_case($request->localidade[0], MB_CASE_UPPER, $encoding),
                "uf" => strtoupper($request->uf[0])
            ]
        ];

        $fornecedor = new Fornecedor();
        $fornecedor->id_fornecedor = $request->fornecedor;

        $id_fornecedor = [
            "0" => $fornecedor,
        ];

        $enderecoRepository->createAddress($id_fornecedor, $adresses);

        return redirect("/fornecedores/{$request->fornecedor}");
    }

    public function update($id, Request $request)
    {
        try {
            $adress = new Endereco();

            $adress->numero = $request->numero;
            $adress->complemento = $request->complemento;

            Endereco::edit($id, $adress);

            return redirect()->back()->with('success', 'Endereço alterado com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        $enderecoRepository = new AddressRepository();
        try {
            $enderecoRepository->deleteAddress($id, Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString());
            return response()->json(['success' => 'Endereço deletado com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
}
