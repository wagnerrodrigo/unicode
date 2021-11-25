<?php

namespace App\Http\Controllers;
use App\Models\Empregado;
use Illuminate\Http\Request;

class EmpregadoController extends Controller
{
    // 
    public function showCpf($nu_cpf_cnpj){
        $empregado = Empregado::buscaCpf($nu_cpf_cnpj);
        return response()->json($empregado);
    }
}
