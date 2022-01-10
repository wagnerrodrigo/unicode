<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

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


    public function store(){

    }
}
