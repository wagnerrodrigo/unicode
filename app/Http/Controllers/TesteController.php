<?php

namespace App\Http\Controllers;

use App\Models\UF;
use App\Models\Cidade;
use App\Models\Extrato;
use Illuminate\Http\Request;
use App\Repository\RateioRepository;
use App\Repository\DespesaRepository;
use App\Repository\LancamentoRepository;
use App\Models\Lancamento;
use Carbon\Carbon;

class TesteController extends Controller
{


    public function all()
    {

        // $uf = new UF();
        // $cidade = new Cidade();

        // $uf = $uf::findIdByUF('MG');
        // $cidade = $cidade::findIdByCidade('BELO HORIZONTE');

        // dd($uf, $cidade);
        //$lancamentoRepository = new LancamentoRepository();
        //$lancamento = $lancamentoRepository->findAccountingEntryById(1866);

        $despesaRepository = new DespesaRepository();
        $despesa = $despesaRepository->setStatusIfPaid(18178);

        dd($despesa);


        // $rateioRepository = new RateioRepository();
        // $rateio = $rateioRepository->findContaBancariaRateioByLancamento(18191);

        // dd($rateio);
        // $timeStamp = Lancamento::findIdByTimeStamp('2022-01-17 12:11:56');
        //$test = Lancamento::findByPeriod('2022-01-01','2022-01-20');
        //dd($test);
        // dd($timeStamp[0]->id_tab_lancamento);
    }
}
