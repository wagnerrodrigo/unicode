<?php

namespace App\Http\Controllers;

use App\Models\UF;
use App\Models\Cidade;
use Illuminate\Http\Request;
use App\Repository\DespesaRepository;
use App\Models\Lancamento;


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
        $test = $despesaRepository->findInfosDespesa("18164");
        
        $timeStamp = Lancamento::findIdByTimeStamp('2022-01-17 12:11:56');
        dd($timeStamp[0]->id_tab_lancamento);
    }
}
