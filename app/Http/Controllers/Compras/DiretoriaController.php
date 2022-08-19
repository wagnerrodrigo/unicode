<?php

namespace App\Http\Controllers\Compras;

use App\CustomError\CustomErrorMessage;
use App\Http\Controllers\Controller;
use App\Models\Compras\Diretoria;
use App\Utils\Mascaras\Mascaras;
use Illuminate\Http\Request;

class diretoriaController extends Controller
{
    public function index()
    {
        $pedidos =  Diretoria::selectAll(10);
        return view('admin.compras.diretoria', compact('pedidos'));
    }

    public function show($id)
    {
        try {
            $diretoria = Diretoria::findOne($id);

            if ($diretoria) {
                $mascara = new Mascaras();

                return view('admin.compras.diretoria', compact('diretoria'));
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
