<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Models\Extrato;
use App\Models\Lancamento;
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
        if ($request->has('dt_inicio') && $request->has('dt_fim')) {
            $dt_lancamento = $request->input('dt_inicio');
            $dt_vencimento = $request->input('dt_fim');
            $mascara = new Mascaras();

            if (empty($dt_lancamento) && empty($dt_vencimento)) {
                $lancamentos = Lancamento::findByStatus(config('constants.PROVISIONADO'));
                return view('admin.extrato.extrato', compact('lancamentos', 'mascara'));
            } else {
                $lancamentos  = $this->showPeriodDate($dt_lancamento, $dt_vencimento);
                return view('admin.extrato.extrato', compact('lancamentos', 'mascara'));
            }
        } else {
            $mascara = new Mascaras();
            $lancamentos = Lancamento::findByStatus(config('constants.PROVISIONADO'));

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
        $lancamentos = Lancamento::findByPeriod($dt_lancamento, $dt_vencimento);
        return $lancamentos;
    }

    public function showExtract($id)
    {
        $extrato = Extrato::findByExtract($id);
        dd($extrato);
        return response()->json($extrato);
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
    public function show()
    {
        return view('admin.extrato.detalhe-extrato');
    }

    public function showInfo($id)
    {
        $despesa = Despesa::findOne($id);
        return view('admin.extrato.detalhe-extrato', compact('despesa'));
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
