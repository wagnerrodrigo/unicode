<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Servico;

use Illuminate\Http\Request;

class ServicoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicos = Servico::all();
        dd($servicos);
        //if($servicos->data_fim !== null)
        return view('admin.servico.lista-servico', compact('servicos'));
    }

    public function list()
    {
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
        $servico = new Servico();
        $servico->nome = $request->nome;
        $servico->nome_generico = $request->nome_generico;
        $servico->tipo = $request->tipo;
        $servico->forma_servico = $request->forma_servico;
        $servico->data_fim = null;
        $servico->save();

        echo "<script> alert('Serviço criado com sucesso!!') </script>";

        return redirect()->route('servicos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicos = Servico::find($id);
        return view('admin.servico.servico', compact('servicos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $servicos = Servico::find($id);
        $servicos->nome = $request->nome;
        $servicos->nome_generico = $request->nome_generico;
        $servicos->tipo = $request->tipo;
        $servicos->forma_servico = $request->forma_servico;
        $servicos->update();

        return view('admin.servico.servico', compact('servicos'));
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
        $servicos = Servico::find($id);

        $servicos->data_fim = Carbon::now()->toDateTimeString();
        $servicos->update();
       
        redirect()->route('servicos');
    }
}
