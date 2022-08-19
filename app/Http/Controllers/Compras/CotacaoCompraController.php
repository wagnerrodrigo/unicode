<?php

namespace App\Http\Controllers\Compras;

use App\CustomError\CustomErrorMessage;
use App\Http\Controllers\Controller;
use App\Models\Compras\Cotacao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Compras\Pedido;
use App\Utils\Mascaras\Mascaras;
use Illuminate\Support\Facades\DB;

class CotacaoCompraController extends Controller
{
    public function index()
    {
        $pedidos =  Cotacao::selectAll(10);
        return view('admin.compras.cotacaoCompra', compact('pedidos'));
    }

    public function show($id)
    {
        try {
            $cotacao = Cotacao::findOne($id);
           
            if ($cotacao) {
                $mascara = new Mascaras();

                return view('admin.compras.cotacaoCompra', compact('cotacao'));
            } else {
                $error = CustomErrorMessage::ERROR_FORNECEDOR;
                return view('error', compact('error'));
            }
        } catch (\Exception $e) {
            $error = CustomErrorMessage::ERROR_FORNECEDOR;
            return view('error', compact('error'));
        }
    }


}