<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $pagamentos = Pagamento::selectAll();

        $pagamentosAtivos = [];
        $pagamentosInativos = [];
        for ($i = 0; $i < count($pagamentos); $i++) {
            if ($pagamentos[$i]->dt_fim === null) {
                $pagamentosAtivos[] = $pagamentos[$i];
            } else {
                $pagamentosInativos[] = $pagamentos[$i];
            };
        }
        

        return view('admin.pagamento.lista-pagamento', compact('pagamentosAtivos'));
    }

    public function pagamento(){
        return view('admin.pagamento.add-pagamento');
    }

    
    public function showDataInsBanc($info){
        $pagamento = Pagamento::showInfoAccount($info);
        return response()->json($pagamento);
    }

    public function showDataAgency($id){
        $pagamento = Pagamento::showInfoAgency($id);
        return response()->json($pagamento);
    }

    public function showBankAccount($id)
    {
        $pagamento = Pagamento::showInfoBankAccount($id);
        return response()->json($pagamento);
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
