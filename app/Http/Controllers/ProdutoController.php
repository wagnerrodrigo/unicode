<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::selectAll();


        $produtosAtivos = [];
        $produtosInativos = [];

        for ($i = 0; $i < count($produtos); $i++) {
            if ($produtos[$i]->dt_fim === null) {
                $produtosAtivos[] = $produtos[$i];
            } else {
                $produtosInativos[] = $produtos[$i];
            };
        }
        return view('admin.produto.lista-produto', compact('produtosAtivos'));
    }


    public function showClassificacaoProduto()
    {
        $produto = Produto::selectAll();
        return response()->json($produto);
    }
    
    public function showClassificacaoProdutoId($id)
    {
        $produto = Produto::selectById($id);
        return response()->json($produto);
    }

    public function store(Request $request)
    {
        $produto = new Produto();
        $produto->nome = $request->nome;
        $produto->nome_generico = $request->nome_generico;
        $produto->tipo = $request->tipo;
        $produto->forma_produto = $request->forma_produto;
        $produto->data_fim = null;
        $produto->save();

        echo "<script> alert('Produto criado com sucesso!!') </script>";

        return redirect()->route('produtos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::selectById($id);
        return view('admin.produto.produto', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $produto = Produto::find($id);
        $produto->nome = $request->nome;
        $produto->nome_generico = $request->nome_generico;
        $produto->tipo = $request->tipo;
        $produto->forma_produto = $request->forma_produto;
        $produto->update();
        return redirect()->route('produtos');
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
        $produto = Produto::find($id);
        $produto->data_fim = Carbon::now()->toDateTimeString();
        $produto->update();
        return redirect()->route('produtos');
    }
}
