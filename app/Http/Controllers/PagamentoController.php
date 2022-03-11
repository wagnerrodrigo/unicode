<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;
use App\Utils\Mascaras\Mascaras;
use App\Repository\RateioRepository;
use App\Repository\DespesaRepository;
use App\CustomError\CustomErrorMessage;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $filtros = null;

            if ($request->has('results') || $request->has('dt_inicio') && $request->has('dt_fim')) {
                $filtros = [
                    'resultado_por_pagina' => $request->input('results') == null ? 10 : $request->input('results'),
                    'dt_inicio_periodo' => $request->input('dt_inicio'),
                    'dt_fim_periodo' => $request->input('dt_fim'),
                    'status_despesa_id' => $request->input('status')
                ];

                $pagamentos = Pagamento::selectAll($filtros['resultado_por_pagina'], $filtros['dt_inicio_periodo'], $filtros['dt_fim_periodo']);
            } else {
                $pagamentos = Pagamento::selectAll(10);
            }

            $mascara = new Mascaras();

            return view('admin.pagamento.lista-pagamento', compact('pagamentos', 'mascara', 'filtros'));
        } catch (\Exception $e) {
            $error = CustomErrorMessage::ERROR_LIST_PAGAMENTO;
            return view('error', compact('error'));
        }
    }

    public function show($id)
    {
        try {
            $mascara = new Mascaras();
            //pega o pagamento
            $pagamento = Pagamento::findOne($id);

            foreach ($pagamento as $pagamento) {
            }

            //busca o tipo de despesa
            $despesaRepository = new DespesaRepository();
            $tipoDaDespesa = $despesaRepository->findInfosDespesa($pagamento->fk_tab_despesa_id);

            foreach ($tipoDaDespesa as $tipoDaDespesa) {
            }

            $pagamentos = Pagamento::getInfosPagamento($id, $tipoDaDespesa->fk_tab_tipo_despesa_id);

            foreach ($pagamentos as $pagamento) {
            }

            //pega os rateios
            $rateioRepository = new RateioRepository();
            $rateios = $rateioRepository->findRateioDespesa($pagamento->id_despesa);

            return view('admin.pagamento.despesa-paga', compact('pagamento', 'mascara', 'rateios'));
        } catch (\Exception $e) {
            $error = CustomErrorMessage::ERROR_PAGAMENTO;
            return view('error', compact('error'));
        }
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
