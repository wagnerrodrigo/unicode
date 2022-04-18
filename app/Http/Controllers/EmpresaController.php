<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Carbon\Carbon;
use App\Models\Endereco;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::selectAll();

        $empresasAtivas = [];
        $empresasInativas = [];

        for ($i = 0; $i < count($empresas); $i++) {
            if ($empresas[$i]->dt_fim === null) {
                $empresasAtivas[] = $empresas[$i];
            } else {
                $empresasInativas[] = $empresas[$i];
            };
        }

        return response()->json($empresasAtivas);
    }

    public function formEmpresas()
    {
        return view('admin.empresas.add-empresas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresa = new Empresa();
        $camposRequisicao = $request->all();

        //transforma todo o request em UpperCase
        foreach ($camposRequisicao as $key => $value) {
            if ($key != '_token') {
                $empresa->$key = strtoupper($value);
            }
        }

        //Adiciona a data de inicio do empresa
        $empresa->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();

        empresa::create($empresa);

        echo "<script> alert('empresa criado com sucesso!!') </script>";

        return redirect()->route('empresas');
    }


    public function showByCnpj($cnpj)
    {
        $empresa = Empresa::findByCnpj($cnpj);

        //retorna Json
        return response()->json($empresa);
    }

    public function showByName($nome)
    {
        //transforma nome para UpperCase
        $nome = strtoupper($nome);
        //busca o empresa pelo nome
        $empresa = Empresa::findByName($nome);

        //retorna Json
        return response()->json($empresa);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::findOne($id);

        return view('admin.empresa.empresa', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $empresa = Empresa::findOne($id);
        $camposRequisicao = $request->all();

        foreach ($camposRequisicao as $key => $value) {
            if ($key != '_token') {
                $empresa->$key = strtoupper($value);
            }
        }

        empresa::set($empresa);

        return redirect()->route('empresas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = Empresa::findOne($id);
        $dataFim = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();

        Empresa::del($dataFim, $empresa->id_empresa);

        return redirect()->route('empresas');
    }
}
