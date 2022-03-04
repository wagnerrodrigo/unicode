<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;
use App\Utils\Mascaras\Mascaras;
use App\Repository\RateioRepository;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mascara = new Mascaras();
        $pagamentos = Pagamento::selectAll();

        return view('admin.pagamento.lista-pagamento', compact('pagamentos', 'mascara'));
    }


    public function show($id){

        $mascara = new Mascaras();
        $pagamento = Pagamento::findOne($id);

        $rateioRepository = new RateioRepository();
        $rateios = $rateioRepository->findByLancamento($pagamento[0]->fk_tab_lancamento);

        //dd($rateios);


        return view('admin.pagamento.despesa-paga', compact('pagamento', 'mascara'));
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
