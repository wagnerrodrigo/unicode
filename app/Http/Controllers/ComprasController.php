<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ComprasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = "Aqui Serão mostrados todos os produtos que foram comprados";
        return view('admin.compras.lista-compras', compact('compras'));
    }
}
