<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Models\Extrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtratoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $extratos = Extrato::selectAll();
        $despesas = Despesa::selectAll();

        return view('admin.extrato.extrato', compact('extratos', 'despesas'));
    }



    public function showCompany(){
        $extrato = Extrato::findByCompany();

        return response()->json($extrato);
    }

    // public function showPeriodDate(){
    //     $extrato = Extrato::findByPeriod();
    //     return response()-json($extrato);
    // }


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
