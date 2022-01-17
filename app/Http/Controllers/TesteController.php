<?php

namespace App\Http\Controllers;

use App\Models\UF;
use App\Models\Cidade;
use Illuminate\Http\Request;
use App\Repository\DespesaRepository;


class TesteController extends Controller
{


    public function all()
    {

        // $uf = new UF();
        // $cidade = new Cidade();

        // $uf = $uf::findIdByUF('MG');
        // $cidade = $cidade::findIdByCidade('BELO HORIZONTE');

        // dd($uf, $cidade);

        $despesaRepository = new DespesaRepository();
        $test = $despesaRepository->findPaymentCondition("18164");
        dd($test[0]->fk_condicao_pagamento_id);
    }
}
