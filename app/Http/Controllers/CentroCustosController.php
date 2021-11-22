<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentroCusto;
use Carbon\Carbon;

class CentroCustosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centroCustos = CentroCusto::all();

        $centroCustosAtivos = [];
        $centroCustosInativos = [];

        for ($i = 0; $i < count($centroCustos); $i++) {
            if ($centroCustos[$i]->data_fim === null) {
                $centroCustosAtivos[] = $centroCustos[$i];
            } else {
                $centroCustosInativos[] = $centroCustos[$i];
            };
        }

        return view('admin.centro-custo.lista-centro-custo', compact('centroCustosAtivos'));
    }


    public function showById($id)
    {
        $centroCustos = CentroCusto::findById($id);

        return response()->json($centroCustos);
    }

    public function showByName($nome)
    {
        //transforma nome para UpperCase
        $nome = strtoupper($nome);
        //busca o empresa pelo nome
        $centroCustos = CentroCusto::findByName($nome);

        return response()->json($centroCustos);
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
        $centroCusto = new CentroCusto();
        $centroCusto->nome = $request->nome;
        $centroCusto->empresa = $request->empresa;
        $centroCusto->responsavel = $request->responsavel;
        $centroCusto->data_fim = null;
        $centroCusto->save();

        return redirect()->route('centro-custos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $centroCusto = CentroCusto::find($id);
        return view('admin.centro-custo.detalhe-centro-custo', compact('centroCusto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $centroCusto = CentroCusto::find($id);
        $centroCusto->nome = $request->nome;
        $centroCusto->empresa = $request->empresa;
        $centroCusto->responsavel = $request->responsavel;

        $centroCusto->update();
        return redirect()->route('centro-custos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $centroCusto = CentroCusto::find($id);
        $centroCusto->data_fim = Carbon::now()->toDateTimeString();

        $centroCusto->update();
        return redirect()->route('centro-custos');
    }
}
