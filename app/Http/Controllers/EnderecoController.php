<?php

namespace App\Http\Controllers;

use App\Models\Endereco;

use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function index()
    {
        $enderecos = Endereco::all();

        return view('endereco.endereco', compact('enderecos'));
    }


    public function store(Request $request)
    {
        $endereco = new Endereco();
        return response()->json($endereco);
    }
}
