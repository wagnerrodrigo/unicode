<?php

namespace App\Http\Controllers\Compras;

use App\CustomError\CustomErrorMessage;
use App\Http\Controllers\Controller;
use App\Models\Compras\Pedido;
use App\Models\Compras\Produto;
use App\Utils\Mascaras\Mascaras;
use Illuminate\Http\Request;

class ComprasController extends Controller
{

    public function index()
    {
        $pedidos =  Pedido::findOne(10);
        $produtos = Produto::ProdutoAll(10);
        return view('admin.compras.compraHome', compact('pedidos', 'produtos'));
    }

    // public function show($id)
    // {
    //     try {
    //         $pedido = Pedido::findOne($id);
          
    //         if ($pedido) {
    //             $mascara = new Mascaras();

    //             return view('admin.compras.compraHome', compact('pedido'));
    //         } else {
    //             $error = CustomErrorMessage::ERROR_FORNECEDOR;
    //             return view('error', compact('error'));
    //         }
    //     } catch (\Exception $e) {
    //         $error = CustomErrorMessage::ERROR_FORNECEDOR;
    //         return view('error', compact('error'));
    //     }
    // }

}
