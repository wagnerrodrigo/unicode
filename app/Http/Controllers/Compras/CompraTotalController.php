<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Models\Compras\Total;
use Illuminate\Http\Request;

class CompraTotalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos =  Total::selectAll(10);
        return view('admin.compras.compraTotal', compact('pedidos'));

    }
}
