<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Models\Lancamento;
use App\Models\Rateio;
use Illuminate\Http\Request;
use App\Utils\Mascaras\Mascaras;
use Carbon\Carbon;
use App\Repository\DespesaRepository;
use App\CustomError\CustomErrorMessage;
use App\Models\ParcelaDespesa;
use App\Repository\LancamentoRepository;
use App\Repository\ParcelaDespesaRepository;
use App\Repository\RateioRepository;
use App\Utils\StatusDespesa;

class LancamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            //muda status da despesa caso a data de vencimento seja inferior a data atual
            $parcelaDespesaRepository = new ParcelaDespesaRepository;
            $parcelaDespesaRepository->setStatusIfDefeaded(Carbon::now()->setTimezone('America/Sao_Paulo')->format('Y-m-d'));
            $parcelas = $parcelaDespesaRepository;

            $filtros = null;
            // dd($request->results);
            $mascara = new Mascaras();
            if ($request->has('results') || $request->has('dt_inicio') && $request->has('dt_fim') || $request->has('status')) {
                $filtros = [
                    'resultado_por_pagina' => $request->input('results'),
                    'dt_inicio_periodo' => $request->input('dt_inicio'),
                    'dt_fim_periodo' => $request->input('dt_fim'),
                    'status_despesa_id' => $request->input('status')
                ];

                $lancamentos = Lancamento::selectAll($filtros['resultado_por_pagina'], $filtros['dt_inicio_periodo'], $filtros['dt_fim_periodo'], $filtros['status_despesa_id']);
            } else {
                $lancamentos = Lancamento::selectAll();
            }
            return view('admin.lancamentos.lista-lancamentos', compact('lancamentos', 'mascara', 'filtros'));
        } catch (\Exception $e) {
            $error = CustomErrorMessage::ERROR_LIST_LANCAMENTO;
            return view('error', compact('error'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        try {
            //adiciona fk_condicao_pagamento_id, fk_tab_conta_bancaria, fk_tab_pix
            $parcelaDespesaRepository = new ParcelaDespesaRepository();

            $parcelas = [
                'fk_condicao_pagamento' => $request->fk_condicao_pagamento_id,
                'fk_tab_conta_bancaria' => $request->numero_conta_bancaria_fornecedor_empregado,
                'fk_tab_pix' => $request->numero_pix_fornecedor_empregado,
                'dt_provisionamento' => $request->dt_efetivo_pagamento,
            ];
            
            $parcelaDespesaRepository->addPayment($parcelas, $request->id_parcela_despesa);
            
            $getParcela = $parcelaDespesaRepository->getParcela($request->id_parcela_despesa);
            if (!empty($request->valor_rateio_pagamento)) {

                $lancamento = new Lancamento();

                $lancamento->id_parcela_despesa = $request->id_parcela_despesa;
                $lancamento->dt_inicio =  Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                $lancamento->dt_lancamento = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                $lancamento->dt_vencimento = $request->dt_vencimento;
                $lancamento->dt_efetivo_pagamento = $request->dt_efetivo_pagamento;
                $lancamento->juros = $request->juros;
                $lancamento->multa = $request->multa;
                $lancamento->desconto = $request->desconto;
                if($request->juros != null){
                    $lancamento->valor_pago = floatval($request->valor_pago) + (floatval($request->juros) + floatval($request->multa));
                }else if($request->multa != null){
                    $lancamento->valor_pago = floatval($request->valor_pago) + (floatval($request->juros) + floatval($request->multa));
                }else if($request->juros == null){
                    $lancamento->valor_pago = floatval($request->valor_pago) - floatval($request->desconto);
                }else if($request->juros == null && $request->desconto == null){
                    $lancamento->valor_pago = floatval($request->valor_pago);
                }
                $lancamento->dt_fim = null;
                $lancamento->updateExpenceBasedOnInstallmet($getParcela->fk_despesa);
                Lancamento::create($lancamento);

                $timeStamp = $lancamento->dt_inicio;
                $idLancamento = Lancamento::findIdByTimeStamp($timeStamp);
                
                if ($request->valor_rateio_pagamento) {
                    $valor_rateio = trim(html_entity_decode($request->valor_rateio_pagamento), " \t\n\r\0\x0B\xC2\xA0");
                    $rateios[] = [
                        'valor_rateio_pagamento' => $valor_rateio,
                        'fk_tab_conta_bancaria' => $request->fk_tab_conta_bancaria,
                    ];

                    $rateio = new Rateio();

                    for ($i = 0; $i < count($rateios); $i++) {
                        $rateio->valor_rateio_pagamento = $rateios[$i]['valor_rateio_pagamento'];
                        $rateio->fk_tab_conta_bancaria = $rateios[$i]['fk_tab_conta_bancaria'];
                        $rateio->fk_tab_lancamento = $idLancamento[0]->id_tab_lancamento;
                        $rateio->dt_inicio =  Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                        $rateio->dt_fim = null;
                        Rateio::createRateioLancamento($rateio);
                    }
                }
            } else {
                // INICIO requeste somente lancamento
                $lancamento = new Lancamento();

                $lancamento->id_despesa = $request->id_despesa;
                $lancamento->dt_inicio =  Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                $lancamento->dt_lancamento =  Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                $lancamento->dt_vencimento = $request->dt_vencimento;
                $lancamento->dt_efetivo_pagamento = $request->dt_efetivo_pagamento;
                $lancamento->juros = $request->juros;
                $lancamento->multa = $request->multa;
                $lancamento->desconto = $request->desconto;
                $lancamento->valor_pago = trim(html_entity_decode($request->valor_pago), " \t\n\r\0\x0B\xC2\xA0");
                $lancamento->dt_fim = null;
                $lancamento->updateExpenceBasedOnInstallmet($getParcela->fk_despesa);
                Lancamento::create($lancamento);
                // FIM requeste somente lancamento
            }
            
            $parcelaDespesaRepository->setStatus($request->id_parcela_despesa);

            //Verificar e Alterar Status
                //verificar existe parcelas nao pagas
                $idDespesa = new Lancamento();
                $idDespesa->id_despesa = $request->id_despesa;
                $id_inteiro = intval($idDespesa->id_despesa);
                $idDespesa = Lancamento::verificarDespesaPaga($id_inteiro);
                $parcelas_a_pagar =  $idDespesa[0]->qt_parcela;

                //verificar existe parcelas Provisionada
                $verificaProvisionado = new Lancamento();
                $verificaProvisionado->id_despesa = $request->id_despesa;
                $idInteiro = intval($verificaProvisionado->id_despesa);
                $verificaProvisionado = Lancamento::verificarDespesaProvisionada($idInteiro);
                $parcelas_provisionada =  $verificaProvisionado[0]->qt_parcela;
                
                //Alterar Status
                $alterar = new Lancamento();
                $alterar->id_despesa = $request->id_despesa;
                $id_Inteiro = intval($alterar->id_despesa);
                $alterar = Lancamento::alteraStatusDespesa($id_Inteiro, $parcelas_a_pagar, $parcelas_provisionada);

            // Fim //-// Verificar e Alterar Status

            return redirect()->route('lancamentos')->with('success', 'Lan??amento Cadastrado!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'N??o foi poss??vel realizar o Lan??amento' . $e->getMessage());
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $lancamento = Lancamento::findOne($id);
            return view('admin.lancamentos.detalhes-lancamento', compact('lancamento'));
        } catch (\Exception $e) {
            $error = CustomErrorMessage::ERROR_LANCAMENTO;
            return view('error', compact('error'));
        }
    }

    public function provisionamento($id)
    {
        $despesaRepository = new DespesaRepository();
        $parcelaDespesaRepository = new ParcelaDespesaRepository();
        $parcela = $parcelaDespesaRepository->getParcela($id);
        $dadosDespesa = $despesaRepository->findTipoECentroCustoDespesa($parcela->fk_despesa);

        foreach ($dadosDespesa as $despesa) {
        }
        $lancamentos = $despesaRepository->getExpenseById($parcela->fk_despesa, $despesa->fk_tab_tipo_despesa_id, null);

        foreach ($lancamentos as $lancamento) {
        }
        
        $mascara = new Mascaras();
       
        return view('admin.lancamentos.add-lancamento', compact('lancamento', 'mascara', 'parcela'));
    }


    public function showDataInsBanc($info)
    {
        $lancamento = Lancamento::showInfoAccount($info);
        return response()->json($lancamento);
    }

    public function showDataAgency($id)
    {
        $lancamento = Lancamento::showInfoAgency($id);
        return response()->json($lancamento);
    }

    public function showBankAccount($id)
    {
        $lancamento = Lancamento::showInfoBankAccount($id);
        return response()->json($lancamento);
    }
    public function showProvidedEmployee($id)
    {
        $lancamento = Lancamento::showDataProvidedEmployee($id);
        return response()->json($lancamento);
    }

    public function showPeriodDate($id_incio, $id_fim)
    {
        $lancamento = Lancamento::findByInitialPeriod($id_incio, $id_fim);
        return response()->json($lancamento);
    }

    public function showCompanyAccountInformation($id)
    {
        $lancamento = Lancamento::findCompanyAccountBank($id);
        return response()->json($lancamento);
    }

    public function showStatus($id_status)
    {
        $lancamento = Lancamento::findByStatus($id_status);
        return response()->json($lancamento);
    }

    public function showBydateAndstatus(Request $request)
    {

        $campos = "id_tab_lancamento
        fk_condicao_pagamento_id
        dt_vencimento
        dt_fim
        id_despesa
        fk_status_despesa_id
        de_status_despesa
        de_despesa
        valor_total_despesa
        dt_provisionamento
        fk_tab_lancamento_id de_pagamento";


        $lancamentosAll = Lancamento::selectAll();

        if ($request->has('dataInicio', 'dataFim', 'status')) {
            $dataInicio = $request->dataInicio;
            $dataFim = $request->dataFim;
            $status = $request->status;

            $filtro = explode("\r\n", $campos);
            foreach ($filtro as $f) {
                $lancamentosAll = $this->$filtro->select($f)->get();
            };
        } else {
            return response()->json($lancamentosAll);
        }
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
        try {
            Lancamento::updatePaymentDate($id, $request->payment_date);
            return redirect()->back()->with('success', 'Data de pagamento atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'N??o foi poss??vel atualizar a data de pagamento' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $accountingEntrys = Lancamento::findOne($id);
            foreach ($accountingEntrys as $accountingEntry) {
            }

            $expenseId = $accountingEntry->fk_tab_despesa_id;
            $expenseRepository = new DespesaRepository();

            $timeStamp = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();

            //deleta despesa
            $expenseRepository->deleteExpense($expenseId, $timeStamp);

            //seta data fim aos itens da despesa
            $items = $expenseRepository->getItems($expenseId);
            if ($items) {
                for ($i = 0; $i < count($items); $i++) {
                    $expenseRepository->setItemEndDate($items[$i]->id_item_despesa, $timeStamp);
                }
            }
            //seta data fim ao rateio
            $rateioRepository = new RateioRepository();
            $rateioRepository->setEndDateRateio($expenseId, $timeStamp);

            Lancamento::deleteLancamento($id, $timeStamp);
            return redirect()->back()->with('success', 'Lan??amento Exclu??do!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'N??o foi poss??vel excluir o Lan??amento' . $e->getMessage());
        }
    }

    public function paginate()
    {
        $lancamentoRepository = new LancamentoRepository();
        $mascara = new Mascaras();
        $lancamentos = $lancamentoRepository->findAccountingEntryByStatus(StatusDespesa::PROVISIONADO, $dt_lancamento = null, $dt_vencimento = null, $n_conta = null);
       
        return view('admin.lancamentos.list-lancamentos', compact('lancamentos', 'mascara', 'dt_lancamento', 'dt_vencimento', 'agenciaConta'));
    }
}
