<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Models\Lancamento;
use App\Models\Rateio;
use Illuminate\Http\Request;
use App\Utils\Mascaras\Mascaras;
use Carbon\Carbon;


use function PHPUnit\Framework\isEmpty;

class LancamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mascara = new Mascaras();
        if ($request->has('dt_inicio') && $request->has('dt_fim') || $request->has('status')) {
            $dt_inicio_periodo = $request->input('dt_inicio');
            $dt_fim_periodo = $request->input('dt_fim');
            $status_despesa_id = $request->input('status');

            $lancamentos = Lancamento::selectAll($dt_inicio_periodo, $dt_fim_periodo, $status_despesa_id);
        } else {
            $lancamentos = Lancamento::selectAll();
        }

        return view('admin.lancamentos.lista-lancamentos', compact('lancamentos', 'mascara'));
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
        
        

        if (!empty($request->valor_rateio_pagamento)) {

            if ($request->valor_rateio_pagamento) {
                for ($i = 0; $i < count($request->valor_rateio_pagamento); $i++) {
                    $rateios[] = [
                        'valor_rateio_pagamento' => preg_replace('/\D/', '', $request->valor_rateio_pagamento[$i]),
                        'fk_tab_conta_bancaria' => $request->fk_tab_conta_bancaria[$i],
                    ];

                }
                $rateio = new Rateio();
    
                for ($i = 0; $i < count($rateios); $i++) {
                    $rateio->valor_rateio_pagamento = $rateios[$i]['valor_rateio_pagamento'];
                    $rateio->fk_tab_conta_bancaria = $rateios[$i]['fk_tab_conta_bancaria'];
                    $rateio->dt_inicio =  Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                    $rateio->dt_fim = null;
                    Rateio::createRateioLancamento($rateio);
                }
            }

           
                $lancamento = new Lancamento();
          
                $lancamento->id_despesa = $request->id_despesa;
                $lancamento->fk_condicao_pagamento_id = $request->fk_condicao_pagamento_id;
                $lancamento->dt_inicio =  Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                $lancamento->dt_fim = null;
                Lancamento::create($lancamento);
        }
        else{
               // INICIO requeste somente lancamento
               $lancamento = new Lancamento();
          
                $lancamento->id_despesa = $request->id_despesa;
                $lancamento->fk_condicao_pagamento_id = $request->fk_condicao_pagamento_id;
                $lancamento->dt_inicio =  Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                $lancamento->dt_fim = null;
                Lancamento::create($lancamento);
                // FIM requeste somente lancamento

               
            }
            
            $despesa = new Despesa();
            $despesa::setStatus($request->id_despesa);

        return  redirect()->route('lancamentos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lancamento = Lancamento::findOne($id);
        return view('admin.lancamentos.detalhes-lancamento', compact('lancamento'));
    }

    public function provisionamento($id)
    {
        $lancamento = Lancamento::findOne($id);
        $lancamento->valor_total_despesa = Mascaras::maskMoeda($lancamento->valor_total_despesa);
        return view('admin.lancamentos.add-lancamento', compact('lancamento'));
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
            dd($dataInicio, $dataFim, $status);

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
