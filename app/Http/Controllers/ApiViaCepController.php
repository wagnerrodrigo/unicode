<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViaCep;

class ApiViaCepController extends Controller
{
    public function buscaCep(Request $request)
    {
        $codigoPostal = $request->cep;
        $endereco = ViaCep::getEndereco($codigoPostal);

        return response()->json($endereco);
    }
}
