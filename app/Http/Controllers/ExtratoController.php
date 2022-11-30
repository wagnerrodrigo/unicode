<?php

namespace App\Http\Controllers;

use App\Models\Extrato;
use App\Repository\LancamentoRepository;
use App\Repository\RateioRepository;
use App\Utils\Mascaras\Mascaras;
use Illuminate\Http\Request;
use App\Utils\StatusDespesa;

class ExtratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return view('admin.extrato.paginateExtrato');
        $lancamentoRepository = new LancamentoRepository();
        $extratos = new Extrato();
        $extratos = $extratos->selectAll();

        $agenciaConta = new Extrato();
        $agenciaConta = $agenciaConta->selectAllConta();
        

        $mascara = new Mascaras();

        $dt_lancamento = $request->input('dt_inicio');
        $dt_vencimento = $request->input('dt_fim');
        $n_conta = $request->input('conta');
      
       
        if (!empty($dt_lancamento) && !empty($dt_vencimento) && !empty($n_conta)) {
            $lancamentos = $lancamentoRepository->findAccountingEntryByStatus(StatusDespesa::PROVISIONADO, $dt_lancamento, $dt_vencimento,  $n_conta);
            return view('admin.extrato.paginateExtrato', compact('lancamentos', 'mascara', 'extratos', 'dt_lancamento', 'dt_vencimento', 'agenciaConta'));
            
        } else if (!empty($dt_lancamento) && !empty($dt_vencimento)) {
            $lancamentos = $lancamentoRepository->findAccountingEntryByStatus(StatusDespesa::PROVISIONADO, $dt_lancamento, $dt_vencimento, $n_conta = null);
            return view('admin.extrato.paginateExtrato', compact('lancamentos', 'mascara', 'extratos', 'dt_lancamento', 'dt_vencimento', 'agenciaConta'));
            
        }else if(!empty($n_conta)){
            $lancamentos = $lancamentoRepository->findAccountingEntryByStatus(StatusDespesa::PROVISIONADO, $dt_lancamento = null, $dt_vencimento = null, $n_conta);
            return view('admin.extrato.paginateExtrato', compact('lancamentos', 'mascara', 'extratos', 'agenciaConta'));
        }else{
            $lancamentos = $lancamentoRepository->findAccountingEntryByStatus(StatusDespesa::PROVISIONADO, $dt_lancamento = null, $dt_vencimento = null, $n_conta = null);
            return view('admin.extrato.paginateExtrato', compact('lancamentos', 'mascara', 'extratos', 'agenciaConta'));
        }
    }

    public function indexReparcela(Request $request)
    {
        //return view('admin.extrato.paginateExtrato');
        $lancamentoRepository = new LancamentoRepository();
        $extratos = new Extrato();
        $extratos = $extratos->selectAll();

        $agenciaConta = new Extrato();
        $agenciaConta = $agenciaConta->selectAllConta();
        

        $mascara = new Mascaras();

        $dt_lancamento = $request->input('dt_inicio');
        $dt_vencimento = $request->input('dt_fim');
        $n_conta = $request->input('conta');
      
       
        if (!empty($dt_lancamento) && !empty($dt_vencimento) && !empty($n_conta)) {
            $lancamentos = $lancamentoRepository->findAccountingEntryByStatusReparcela(StatusDespesa::PROVISIONADO, $dt_lancamento, $dt_vencimento,  $n_conta);
            return view('admin.extrato.paginateExtratoReparela', compact('lancamentos', 'mascara', 'extratos', 'dt_lancamento', 'dt_vencimento', 'agenciaConta'));
            
        } else if (!empty($dt_lancamento) && !empty($dt_vencimento)) {
            $lancamentos = $lancamentoRepository->findAccountingEntryByStatusReparcela(StatusDespesa::PROVISIONADO, $dt_lancamento, $dt_vencimento, $n_conta = null);
            return view('admin.extrato.paginateExtratoReparela', compact('lancamentos', 'mascara', 'extratos', 'dt_lancamento', 'dt_vencimento', 'agenciaConta'));
            
        }else if(!empty($n_conta)){
            $lancamentos = $lancamentoRepository->findAccountingEntryByStatusReparcela(StatusDespesa::PROVISIONADO, $dt_lancamento = null, $dt_vencimento = null, $n_conta);
            return view('admin.extrato.paginateExtratoReparela', compact('lancamentos', 'mascara', 'extratos', 'agenciaConta'));
        }else{
            $lancamentos = $lancamentoRepository->findAccountingEntryByStatusReparcela(StatusDespesa::PROVISIONADO, $dt_lancamento = null, $dt_vencimento = null, $n_conta = null);
            return view('admin.extrato.paginateExtratoReparela', compact('lancamentos', 'mascara', 'extratos', 'agenciaConta'));
        }
    }

    public function showCompany()
    {
        $extrato = Extrato::findByCompany();
        return response()->json($extrato);
    }

    // public function showPeriodDate($dt_lancamento, $dt_vencimento)
    // {
    //     $lancamentoRepository = new LancamentoRepository();
    //     $lancamentos = $lancamentoRepository->findAccountingEntryByPeriod($dt_lancamento, $dt_vencimento);
       
    //     return $lancamentos;
    // }

    public function showExtract($id)
    {
        $extrato = Extrato::findByExtract($id);

        return response()->json($extrato);
    }

    //pega a conta bancaria pelo id do lançamento -> pega o extrato pelos ids das contas bancarias relacionadas ao lancamento
    public function getExtractByBankAccount($id_lancamento)
    {
        try {
            $rateioRepository = new RateioRepository();
            $contas = $rateioRepository->findContaBancariaRateioByLancamento($id_lancamento);

            $lancamentoRepository = new LancamentoRepository();
            $lancamento = $lancamentoRepository->findAccountingEntryById($id_lancamento);

            //quebra a data em ano-mes-dia
            $dt_pagamento = str_split($lancamento[0]->dt_efetivo_pagamento, 10);

            foreach ($contas as $conta) {
                $extratos[] = Extrato::findByBankAccountAndDate($conta->id_conta_bancaria, $dt_pagamento[0]);
            }

            return response()->json($extratos);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getExtractByIdAccount(String $id){
        $extratos = Extrato::findByIdAccount($id);

        $mascara = new Mascaras();

        return view('admin.extrato.list-extratos', compact('extratos', 'mascara'));

        // return response()->json($extratos);
    }

    public function getAllExtracts()
    {
        $extrato = Extrato::selectAll();
        return response()->json($extrato);
    }

    public function paginate(){
        $extratos = Extrato::selectAll();
        $mascara = new Mascaras();

        return view('admin.extrato.list-extratos', compact('extratos', 'mascara'));

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
