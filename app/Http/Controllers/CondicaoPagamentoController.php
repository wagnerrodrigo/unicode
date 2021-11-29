<?php

namespace App\Http\Controllers;

use App\Models\CondicaoPagamento;
use Illuminate\Http\Request;

class CondicaoPagamentoController extends Controller
{
    public function index()
    {
        $condicaoPagamento = CondicaoPagamento::selectAll();

        return response()->json($condicaoPagamento);
    }
}
