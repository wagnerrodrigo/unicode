<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;
use App\Utils\Mascaras\Mascaras;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class LancamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('dt_inicio') && $request->has('dt_fim') || $request->has('status')) {
            $dt_inicio_periodo = $request->input('dt_inicio');
            $dt_fim_periodo = $request->input('dt_fim');
            $status_despesa_id = $request->input('status');

            $lancamentos = Lancamento::selectAll($dt_inicio_periodo, $dt_fim_periodo, $status_despesa_id);
        }else{
            $lancamentos = Lancamento::selectAll();
        }

        $lancamentosAtivos = [];
        $lancamentosInativos = [];
        for ($i = 0; $i < count($lancamentos); $i++) {
            if ($lancamentos[$i]->dt_fim === null) {
                $lancamentosAtivos[] = $lancamentos[$i];
                $lancamentosAtivos[$i]->valor_total_despesa = Mascaras::maskMoeda($lancamentosAtivos[$i]->valor_total_despesa);
            } else {
                $lancamentosInativos[] = $lancamentos[$i];
                $lancamentosInativos[$i]->valor_total_despesa = Mascaras::maskMoeda($lancamentosInativos[$i]->valor_total_despesa);
            };
        }
        dd($lancamentosAtivos);

        return view('admin.lancamentos.lista-lancamentos', compact('lancamentosAtivos'));
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
        //

        $lancamento = new Lancamento();

        $lancamento->valor_rateio_pagamento = $request->valor_rateio_pagamento;
        $lancamento->fk_tab_conta_bancaria = $request->fk_tab_conta_bancaria;
        $lancamento->dt_inicio = $request->dt_inicio;

        Lancamento::create($lancamento);



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

    public function provisionamento($id){
        $lancamento = Lancamento::findOne($id);
        $lancamento->valor_total_despesa= Mascaras::maskMoeda($lancamento->valor_total_despesa);
        return view('admin.lancamentos.add-lancamento',compact('lancamento'));
    }


    public function showDataInsBanc($info){
        $lancamento = Lancamento::showInfoAccount($info);
        return response()->json($lancamento);
    }

    public function showDataAgency($id){
        $lancamento = Lancamento::showInfoAgency($id);
        return response()->json($lancamento);
    }

    public function showBankAccount($id)
    {
        $lancamento = Lancamento::showInfoBankAccount($id);
        return response()->json($lancamento);
    }
    public function showProvidedEmployee($id){
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



    // $lancamento = DB::table('intranet.tab_lancamento')->paginate(15)
    // dd($lancamento->columns[0]->id_tab_lancamento); MUITO IMPORTANTE !!!!!

    // return response()->json($lancamento);

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
        // dd($campos); dataInicio

        $lancamentosAll = Lancamento::selectAll();


        // dd($lancamentosAll);
        // $lancamentos = Lancamento::findOne($dataInicio,$dataFim);
        // dd($lancamentos);
       if($request->has('dataInicio','dataFim','status'))
       {
        $dataInicio = $request->dataInicio;
        $dataFim = $request->dataFim;
        $status = $request->status;
        dd($dataInicio,$dataFim,$status);

           $filtro = explode("\r\n",$campos);
           foreach($filtro as $f ){
               $lancamentosAll = $this->$filtro->select($f)->get();

             };

        }else{
            return response()->json($lancamentosAll);
        }


    //     $lancamento = DB::table('intranet.tab_lancamento')
    //         ->select(DB::select('SELECT lancamento.id_tab_lancamento,
    //     lancamento.fk_condicao_pagamento_id,
    //     lancamento.dt_vencimento,
    //     lancamento.dt_fim,
    //     despesa.id_despesa,
    //     despesa.fk_status_despesa_id,
	//     status_dep.de_status_despesa,
	//     despesa.de_despesa,
    //     despesa.valor_total_despesa,
    //     despesa.dt_vencimento,
    //     despesa.dt_provisionamento,
    //     pagamento.fk_tab_lancamento_id,
    //     pagamento.de_pagamento
    //     FROM intranet.tab_lancamento AS lancamento
    //     RIGHT JOIN intranet.tab_despesa as despesa on (lancamento.fk_tab_despesa_id = despesa.id_despesa)
    //     LEFT JOIN intranet.tab_pagamento as pagamento on (despesa.id_despesa = pagamento.fk_tab_lancamento_id)
    //     inner join intranet.status_despesa as status_dep on (despesa.fk_status_despesa_id = status_dep.id_status_despesa)
    //     LIMIT 10'));

    //  $lancamento = DB::table('intranet.tab_lancamento');
    //  dd($lancamento);

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
