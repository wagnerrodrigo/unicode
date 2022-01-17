<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Despesa;
use App\Models\ItemDespesa;
use App\Models\Rateio;
use Illuminate\Http\Request;
use App\Utils\CondicaoPagamentoId;
use App\Utils\Mascaras\Mascaras;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mascara = new Mascaras();
        //quantidade de resultados por pagina
        $results = $request->input('results');
        $chave_busca = $request->input('chave_busca');
        $valor_busca = $request->input('valor_busca');
        $status_despesa = $request->input('status');

        if ($request->has('status')) {

            $despesas = Despesa::selectAll($results, $status_despesa, $chave_busca, $valor_busca);

        } else {
            $despesas = Despesa::selectAll($results = 10);
        }
        return view('admin.despesas.lista-despesas', compact('despesas', 'mascara'));
    }

    public function formDespesa()
    {
        return view('admin.despesas.add-despesa-fornecedor');
    }

    public function show($id)
    {
        $despesas = Despesa::findOne($id);
        $mascara = new Mascaras();

        //dd($despesas);

        if ($despesas == null || empty($despesas)) {
            return "Despesa não encontrada";
        } else {
            $despesa = $despesas[0];
            return view('admin.despesas.detalhe-despesa', compact('despesa', 'mascara'));
        }
    }

    public function store(Request $request)
    {
        //formata valor total da despesa para o banco
        $request->valor_total = str_replace("R$", "", $request->valor_total);
        $request->valor_total = trim(html_entity_decode($request->valor_total), " \t\n\r\0\x0B\xC2\xA0");
        $request->valor_total = str_replace(".", "", $request->valor_total);
        $request->valor_total = str_replace(",", ".", $request->valor_total);
        //remove um caracter especial do campo valor total -> bug gerado pelo R$
        $condicaoPagamentoId = new CondicaoPagamentoId();

        //instancia model Despesa
        $despesa = new Despesa();
        //faz a verificação do campo tipo da despesa e seta o valor no model
        $despesa->fk_centro_de_custo = $request->centro_custo_empresa;
        if ($request->tipo_despesa == 'empregado') {
            $despesa->fk_tipo_despesa = 1;
            $despesa->fk_tab_fornecedor_id = null;
            $despesa->fk_tab_empregado_id = $request->fk_empregado_fornecedor;
        } else {
            $despesa->fk_tipo_despesa = 2;
            $despesa->fk_tab_fornecedor_id = $request->fk_empregado_fornecedor;
            $despesa->fk_tab_empregado_id = null;
        }

        $despesa->fk_plano_contas = $request->tipo_classificacao;
        $despesa->numero_documento_despesa = $request->numero_nota_documento;
        $despesa->qt_parcelas_despesa = $request->parcelas;
        $despesa->serie_despesa = $request->serie_documento;
        $despesa->dt_emissao = $request->data_emissao;
        $despesa->valor_total_despesa = $request->valor_total;
        $despesa->fk_status_despesa_id = config('constants.A_PAGAR');
        $despesa->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
        $despesa->de_despesa = strtoupper($request->titulo_despesa);
        $despesa->dt_vencimento = $request->data_vencimento;
        $despesa->moeda = $request->moeda;
        $despesa->dt_provisionamento = $request->data_provisionamento;
        $despesa->fk_condicao_pagamento_id = $condicaoPagamentoId->getId($request->tipo_pagamento);
        $despesa->tipo_documento = $request->tipo_documento;
        $despesa->fk_conta_bancaria = $request->numero_conta_bancaria;
        $despesa->fk_tab_pix = $request->numero_pix;
        $despesa->numero_processo = $request->numero_processo;
        $despesa->dt_fim = null;

        Despesa::create($despesa);

        //armazena timeStamp da data de criação da despesa
        $timestamp = $despesa->dt_inicio;
        //pega o id da despesa criada anteriormente para inserir na tabela ItemDespesa
        $id_despesa = Despesa::findByTimeStamp($timestamp);

       // dd($id_despesa[0]->id_despesa);

        //caso haja rateio na despesa executa
        if ($request->empresa_rateio) {
            $rateios = [];
            //percorre os arrays de centro_custo, valor, e porcentagem do rateio recebidos pelo request e os une em um array chamado $rateios[]
            for ($i = 0; $i < count($request->empresa_rateio); $i++) {
                $rateios[] = [
                    'centro_custo_rateio' => $request->custo_rateio[$i],
                    'valor_rateio' => trim(html_entity_decode($request->valor_rateio[$i]), " \t\n\r\0\x0B\xC2\xA0"),
                    'porcentagem_rateio' => $request->porcentagem_rateio[$i],
                ];
            }
            //instancia um objeto do model Rateio
            $rateio = new Rateio();
            //percorre o novo array e chama o metodo de inserção no banco para cada indice do array de rateios
            for ($i = 0; $i < count($rateios); $i++) {
                $rateio->fk_tab_centro_custo_id = $rateios[$i]['centro_custo_rateio'];
                $rateio->valor_rateio_despesa = $rateios[$i]['valor_rateio'];
                $rateio->porcentagem_rateio_despesa = $rateios[$i]['porcentagem_rateio'];
                $rateio->dt_inicio =  Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                $rateio->dt_fim = null;
                $rateio->fk_tab_despesa = $id_despesa[0]->id_despesa;
                Rateio::create($rateio);
            }
        }


        //caso haja produto na despesa executa
        if ($request->id_produto) {
            $itensDespesa = [];
            //percorre os arrays de centro_custo, valor, e porcentagem do rateio recebidos pelo request e os une em um array chamado $rateios[]
            for ($i = 0; $i < count($request->id_produto); $i++) {
                $itensDespesa[] = [
                    'fk_tab_produto_id' => $request->id_produto[$i],
                    'valor_unitario_item_despesa' => $request->valor_unitario[$i],
                    'quantidade' => $request->quantidade[$i],
                ];
            }
            //instancia um objeto do model Rateio
            $itemDespesa = new ItemDespesa();
            //percorre o novo array e chama o metodo de inserção no banco para cada indice do array de rateios
            for ($i = 0; $i < count($itensDespesa); $i++) {
                $itemDespesa->fk_tab_despesa_id = $id_despesa[0]->id_despesa;
                $itemDespesa->fk_tab_produto_id = $itensDespesa[$i]['fk_tab_produto_id'];
                $itemDespesa->valor_unitario_item_despesa = $itensDespesa[$i]['valor_unitario_item_despesa'];
                $itemDespesa->quantidade = $itensDespesa[$i]['quantidade'];
                $itemDespesa->dt_inicio =  Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
                $itemDespesa->dt_fim = null;
                $itemDespesa->valor_total_item_despesa = $itensDespesa[$i]['valor_unitario_item_despesa'] * $itensDespesa[$i]['quantidade'];
                ItemDespesa::create($itemDespesa);
            }
        }
        return redirect()->route('despesas');
    }

    public function edit($id, Request $request)
    {
        $despesa = Despesa::findOne($id);
        $camposRequisicao = $request->all();

        Despesa::set($despesa);

        return redirect()->route('despesas');
    }
}
