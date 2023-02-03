<?php

namespace App\Http\Controllers\Politicas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Politicas\Politicas;

class HomePoliticaController extends Controller
{
    public function index(Request $request)
    {
        $result = 10;
        $data = $request->categoria;
        $busca = $request->busca;
      
        $politicas = Politicas::selectAll($result, $busca, $data);

        return view('admin.politicas.listaPolitica', compact('politicas', 'data', 'busca'));
    }
}
