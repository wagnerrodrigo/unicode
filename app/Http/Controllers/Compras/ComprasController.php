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
        $pedidos =  Pedido::selectAll(20);
        // $produtos =  Pedido::selectAll(20);
        return view('admin.compras.compraHome', compact('pedidos'));
    }

 

}
