<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;
use App\Utils\Mascaras\Mascaras;

class LancamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $lancamentos = Lancamento::selectAll();

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
