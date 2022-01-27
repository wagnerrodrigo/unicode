<?php

namespace App\Http\Controllers;

use App\Models\Extrato;
use App\Repository\LancamentoRepository;
use App\Repository\RateioRepository;
use App\Utils\Mascaras\Mascaras;
use Illuminate\Http\Request;

class ExtratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lancamentoRepository = new LancamentoRepository();
        if ($request->has('dt_inicio') && $request->has('dt_fim')) {
            $dt_lancamento = $request->input('dt_inicio');
            $dt_vencimento = $request->input('dt_fim');
            $mascara = new Mascaras();

            if (empty($dt_lancamento) && empty($dt_vencimento)) {
                $lancamentos = $lancamentoRepository->findAccountingEntryByStatus(config('constants.PROVISIONADO'));
                return view('admin.extrato.extrato', compact('lancamentos', 'mascara'));
            } else {
                $lancamentos = $this->showPeriodDate($dt_lancamento, $dt_vencimento);
                return view('admin.extrato.extrato', compact('lancamentos', 'mascara'));
            }
        } else {
            $mascara = new Mascaras();
            $lancamentos = $lancamentoRepository->findAccountingEntryByStatus(config('constants.PROVISIONADO'));
            return view('admin.extrato.extrato', compact('lancamentos', 'mascara'));
        }
    }

    public function showCompany()
    {
        $extrato = Extrato::findByCompany();
        return response()->json($extrato);
    }

    public function showPeriodDate($dt_lancamento, $dt_vencimento)
    {
        $lancamentoRepository = new LancamentoRepository();
        $lancamentos = $lancamentoRepository->findAccountingEntryByPeriod($dt_lancamento, $dt_vencimento);
        return $lancamentos;
    }

    public function showExtract($id)
    {
        $extrato = Extrato::findByExtract($id);

        return response()->json($extrato);
    }

    //pega a conta bancara pelo id do lançamento -> pega o extrato pelos ids das contas bancarias relacionadas ao lancamento
    public function getExtractByBankAccount($id_lancamento)
    {
        $rateioRepository = new RateioRepository();
        $rateios = $rateioRepository->findContaBancariaRateioByLancamento($id_lancamento);

        foreach ($rateios as $rateio) {
            $extratos = Extrato::findByBankAccount($rateio->id_conta_bancaria);
        }

        return response()->json($extratos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
