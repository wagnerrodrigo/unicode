<?php

namespace App\Http\Controllers;

use App\Models\Endereco;

use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function store(Request $request)
    {
        $endereco = new Endereco();
        $endereco->cep = $request->retornoCep;
        $endereco->logradouro = $request->logradouro;
        $endereco->numero = $request->numero;
        $endereco->complemento = $request->complemento;
        $endereco->bairro = $request->bairro;
        $endereco->cidade = $request->cidade;
        $endereco->uf = $request->estado;
        $endereco->data_fim = null;
        $endereco->save();

        return response()->json($endereco);
    }
}
