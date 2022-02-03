<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conciliacao;
use App\Repository\LancamentoRepository;
use App\Repository\DespesaRepository;

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

            foreach ($request->ids_extratos as $id_extrato) {
                $conciliacao->id_lancamento = $request->id_lancamento;
                $conciliacao->id_extrato = $id_extrato;
                Conciliacao::store($conciliacao);
            }

            $lancamentoRepository = new LancamentoRepository();
            $lancamento = $lancamentoRepository->findAccountingEntryById($request->id_lancamento);

            $despesaRepository = new DespesaRepository();
            $despesaRepository->setStatusIfPaid($lancamento[0]->fk_tab_despesa_id);

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
