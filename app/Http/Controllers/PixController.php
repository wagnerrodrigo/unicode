<?php

namespace App\Http\Controllers;

use App\Models\Pix;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PixController extends Controller
{
    public function showByFornecedor($id)
    {
        $pix = Pix::getPixFornecedor($id);

        return response()->json($pix);
    }

    // busca o pix do empregado pelo id
    public function showByEmpregado($id)
    {
        $pix = Pix::getPixEmpregado($id);

        return response()->json($pix);
    }

    // busca os tipos de pix do banco
    public function showBydescriptionPix()
    {
        $tipoPix = Pix::getDescriptionPix();
        return response()->json($tipoPix);
    }

    // [REGRA DE NEGOCIO]-> não exite uma definição para o pix do empregado
    // cria um novo pix do fornecedor ou empregado
    public function storeWithJSON(Request $request)
    {
        $pix = new Pix();

        $pix->de_pix = $request->input_pix;
        $pix->fk_tab_tipo_pix_id = $request->select_tipo_pix;

        if ($request->tipo_do_titular == 'fornecedor') {
            $pix->fk_tab_empregado_id = null;
            $pix->fk_tab_fornecedor_id = $request->id_titular_pix;
        } else if ($request->tipo_do_titular == 'empregado') {
            $pix->fk_tab_empregado_id = $request->id_titular_pix;
            $pix->fk_tab_fornecedor_id = null;
        }

        $pix->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();

        Pix::create($pix);
        return response()->json(["message"=>"success"]);
    }
}
