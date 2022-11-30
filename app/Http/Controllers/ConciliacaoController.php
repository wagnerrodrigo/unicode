<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conciliacao;
use App\Models\Lancamento;
use App\Models\Pagamento;
use App\Repository\LancamentoRepository;
use App\Repository\PagamentoRepository;
use App\Repository\ParcelaDespesaRepository;
use Carbon\Carbon;

class ConciliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.conciliacoes.lista-conciliacao');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {  
        
        try {
        $conciliacao = new Conciliacao();
        if (count($request->lancamentos) >= count($request->extratos)) {
            for ($i = 0; $i < count($request->lancamentos); $i++) {
                $conciliacao->id_lancamento = $request->lancamentos[$i]['id'];
                $conciliacao->id_extrato = $request->extratos[0]['id'];
                $conciliacao->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                Conciliacao::store($conciliacao);
            }
        } else if (count($request->lancamentos) < count($request->extratos)) {
            for ($i = 0; $i < count($request->lancamentos); $i++) {
                $conciliacao->id_lancamento = $request->lancamentos[0]['id'];
                $conciliacao->id_extrato = $request->extratos[$i]['id'];
                $conciliacao->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                Conciliacao::store($conciliacao);
            }
        } else {
            for ($i = 0; $i < count($request->extratos); $i++) {
                $conciliacao->id_lancamento = $request->lancamentos[$i]['id'];
                $conciliacao->id_extrato = $request->extratos[$i]['id'];
                $conciliacao->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                Conciliacao::store($conciliacao);
            }
        }
        
        
        if($request->lancamentos[0]["reparcelado"] == "Sim"){
            
            $lancamentoRepository = new LancamentoRepository();
            $lancamento = $lancamentoRepository->findAccountingEntryByIdReparcela($request->lancamentos[0]["id"]);
  
            $parcelaDespesaRepository = new ParcelaDespesaRepository();
            $parcelaDespesaRepository->setStatusIfPaidreparcela($lancamento[0]->fk_tab_reparcela_despesa_id);
    
            $pagamento = new Pagamento();
            $pagamentoRepository = new PagamentoRepository();
    
            $pagamento->fk_tab_lancamento_id = $request->id_lancamento;
            $pagamento->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            $pagamento->dt_fim = null;
            $pagamento->fk_rateio_pagamento = null;
            $pagamento->fk_tab_conciliacao = null;
            
            $pagamentoRepository->savePayment($pagamento);
    
            //Verificar e Alterar Status
                //verificar existe parcelas nao pagas
                $idDespesa = new Lancamento();
                $idDespesa->fk_despesa = $request->lancamentos[0]["fk_despesa"];
                $id_inteiro = intval($idDespesa->fk_despesa);
                $idDespesa = Lancamento::verificarDespesaPagaReparcela($id_inteiro);
                $parcelas_a_pagar =  $idDespesa[0]->qt_reparcela;
    
                //verificar existe parcelas Provisionada
                $verificaProvisionado = new Lancamento();
                $verificaProvisionado->fk_despesa = $request->lancamentos[0]["fk_despesa"];
                $idInteiro = intval($verificaProvisionado->fk_despesa);
                $verificaProvisionado = Lancamento::verificarDespesaProvisionadaReparcela($idInteiro);
                $parcelas_provisionada =  $verificaProvisionado[0]->qt_reparcela;
            
                //Alterar Status
                $alterar = new Lancamento();
                $alterar->fk_despesa = $request->lancamentos[0]["fk_despesa"];
                $id_Inteiro = intval($alterar->fk_despesa);
                $alterar = Lancamento::alteraStatusDespesa($id_Inteiro, $parcelas_a_pagar, $parcelas_provisionada);
            //Fim //-// Verificar e Alterar Status



        }else{
            $lancamentoRepository = new LancamentoRepository();
            $lancamento = $lancamentoRepository->findAccountingEntryById($request->lancamentos[0]["id"]);
            
            $parcelaDespesaRepository = new ParcelaDespesaRepository();
            $parcelaDespesaRepository->setStatusIfPaid($lancamento[0]->fk_tab_parcela_despesa_id);
    
            $pagamento = new Pagamento();
            $pagamentoRepository = new PagamentoRepository();
    
            $pagamento->fk_tab_lancamento_id = $request->id_lancamento;
            $pagamento->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            $pagamento->dt_fim = null;
            $pagamento->fk_rateio_pagamento = null;
            $pagamento->fk_tab_conciliacao = null;
            
            $pagamentoRepository->savePayment($pagamento);
    
            //Verificar e Alterar Status
                //verificar existe parcelas nao pagas
                $idDespesa = new Lancamento();
                $idDespesa->fk_despesa = $request->lancamentos[0]["fk_despesa"];
                $id_inteiro = intval($idDespesa->fk_despesa);
                $idDespesa = Lancamento::verificarDespesaPaga($id_inteiro);
                $parcelas_a_pagar =  $idDespesa[0]->qt_parcela;
    
                //verificar existe parcelas Provisionada
                $verificaProvisionado = new Lancamento();
                $verificaProvisionado->fk_despesa = $request->lancamentos[0]["fk_despesa"];
                $idInteiro = intval($verificaProvisionado->fk_despesa);
                $verificaProvisionado = Lancamento::verificarDespesaProvisionada($idInteiro);
                $parcelas_provisionada =  $verificaProvisionado[0]->qt_parcela;
            
                //Alterar Status
                $alterar = new Lancamento();
                $alterar->fk_despesa = $request->lancamentos[0]["fk_despesa"];
                $id_Inteiro = intval($alterar->fk_despesa);
                $alterar = Lancamento::alteraStatusDespesa($id_Inteiro, $parcelas_a_pagar, $parcelas_provisionada);
            //Fim //-// Verificar e Alterar Status
        }
       

        return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
