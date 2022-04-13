<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Despesa;
use Illuminate\Http\Request;
use App\Utils\CondicaoPagamentoId;
use App\Utils\TipoDespesa;
use App\Utils\FormataValor;
use App\Utils\StatusDespesa;
use App\Utils\Mascaras\Mascaras;
use App\Repository\DespesaRepository;
use App\Repository\RateioRepository;
use App\Repository\ItemDespesaRepository;
use App\CustomError\CustomErrorMessage;
use App\Repository\DocumentoRepository;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $despesaRepository = new DespesaRepository();
            $despesaRepository->setStatusIfDefeaded(Carbon::now()->setTimezone('America/Sao_Paulo')->format('Y-m-d'));

            $mascara = new Mascaras();
            //quantidade de resultados por pagina
            $results = $request->input('results');
            $dt_inicio = $request->input('dt_inicio');
            $dt_fim = $request->input('dt_fim');
            $status_despesa = $request->input('status');

            if ($request->has('status')) {
                $despesas = Despesa::selectAll($results, $status_despesa, $dt_inicio, $dt_fim);
            } else {
                $despesas = Despesa::selectAll($results = 10);
            }
            return view('admin.despesas.lista-despesas', compact('despesas', 'mascara', 'results', 'status_despesa', 'dt_inicio', 'dt_fim'));
        } catch (\Exception $e) {
            $error = CustomErrorMessage::ERROR_LIST_DESPESA;
            return view('error', compact('error'));
        }
    }

    public function api(Request $request)
    {
        try {
            $despesaRepository = new DespesaRepository();
            $despesaRepository->setStatusIfDefeaded(Carbon::now()->setTimezone('America/Sao_Paulo')->format('Y-m-d'));

            $mascara = new Mascaras();
            //quantidade de resultados por pagina
            $results = $request->input('results');
            $dt_inicio = $request->input('dt_inicio');
            $dt_fim = $request->input('dt_fim');
            $status_despesa = $request->input('status');

            if ($request->has('status')) {
                $despesas = Despesa::selectAll($results, $status_despesa, $dt_inicio, $dt_fim);
            } else {
                $despesas = Despesa::selectAll($results = 10);
            }
            return response()->json($despesas);
        } catch (\Exception $e) {
            $error = CustomErrorMessage::ERROR_LIST_DESPESA;
            return view('error', compact('error'));
        }
    }

    public function formDespesa()
    {
        return view('admin.despesas.add-despesa-fornecedor');
    }

    public function show($id)
    {
        try {
            $despesaRepository = new DespesaRepository();
            $infosDespesa = $despesaRepository->findInfosDespesa($id);

            $tipo = TipoDespesa::class;

            $condicaoPagamento = $infosDespesa[0]->fk_condicao_pagamento_id;
            $tipoDespesa = $infosDespesa[0]->fk_tab_tipo_despesa_id;
            $centroCustoDespesa = $infosDespesa[0]->fk_tab_centro_custo_id;

            $despesas = Despesa::findOne($id, $condicaoPagamento, $tipoDespesa, $centroCustoDespesa);


            $mascara = new Mascaras();
            if ($despesas == null || empty($despesas)) {
                return view('admin.despesas.despesa-nao-encontrada');
            } else {
                $despesa = $despesas[0];
                $data_consertada = explode(' ', $despesa->dt_emissao);
                $despesa->dt_emissao = $data_consertada[0];

                return view('admin.despesas.detalhe-despesa', compact('despesa', 'mascara', 'tipo'));
            }
        } catch (\Exception $e) {
            $error = CustomErrorMessage::ERROR_DESPESA;
            return view('error', compact('error'));
        }
    }

    public function store(Request $request)
    {
        try {
            $condicaoPagamentoId = new CondicaoPagamentoId();

            //instancia model Despesa
            $despesa = new Despesa();
            $despesa->fk_centro_de_custo = $request->centro_custo_empresa;
            $despesa->fk_empresa_id = $request->id_empresa_selecionada;
            //faz a verificação do campo tipo da despesa e seta o valor no model
            if ($request->tipo_despesa == 'empregado') {
                $despesa->fk_tipo_despesa = TipoDespesa::EMPREGADO;
                $despesa->fk_tab_fornecedor_id = null;
                $despesa->fk_tab_empregado_id = $request->fk_empregado_fornecedor;
            } else {
                $despesa->fk_tipo_despesa = TipoDespesa::FORNECEDOR;
                $despesa->fk_tab_fornecedor_id = $request->fk_empregado_fornecedor;
                $despesa->fk_tab_empregado_id = null;
            }

            $despesa->fk_plano_contas = $request->tipo_classificacao;
            $despesa->numero_documento_despesa = $request->numero_nota_documento;
            $despesa->qt_parcelas_despesa = $request->parcelas;
            $despesa->serie_despesa = $request->serie_documento;
            $despesa->dt_emissao = $request->data_emissao;
            $despesa->valor_total_despesa = FormataValor::Real($request->valor_total);
            $despesa->fk_status_despesa_id = StatusDespesa::A_PAGAR;
            $despesa->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            $despesa->de_despesa = mb_convert_case($request->titulo_despesa, MB_CASE_UPPER, 'UTF-8');
            $despesa->dt_vencimento = $request->data_vencimento;
            $despesa->moeda = $request->moeda;
            $despesa->dt_provisionamento = $request->data_provisionamento;
            $despesa->fk_condicao_pagamento_id = $condicaoPagamentoId->getId($request->tipo_pagamento);
            $despesa->fk_conta_bancaria = $request->numero_conta_bancaria;
            $despesa->fk_tab_pix = $request->numero_pix;
            $despesa->numero_processo = $request->numero_processo;
            $despesa->dt_fim = null;

            Despesa::create($despesa);

            //armazena timeStamp da data de criação da despesa
            $timestamp = $despesa->dt_inicio;
            //pega o id da despesa criada anteriormente para inserir na tabela ItemDespesa
            $id_despesa = Despesa::findByTimeStamp($timestamp);

            //caso haja rateio na despesa executa
            if ($request->empresa_rateio) {
                $rateios = [];

                $soma_porcentagem_rateio = 0;
                $soma_valor_rateio = 0;
                //percorre os arrays de centro_custo, valor, e porcentagem do rateio recebidos pelo request e os une em um array chamado $rateios[]
                for ($i = 0; $i < count($request->empresa_rateio); $i++) {
                    $rateios[] = [
                        'centro_custo_rateio' => $request->custo_rateio[$i],
                        'valor_rateio' => trim(html_entity_decode($request->valor_rateio[$i]), " \t\n\r\0\x0B\xC2\xA0"),
                        'porcentagem_rateio' => $request->porcentagem_rateio[$i],
                    ];
                    //soma os valores do rateio
                    $soma_porcentagem_rateio += $request->porcentagem_rateio[$i];
                    $soma_valor_rateio += trim(html_entity_decode($request->valor_rateio[$i]), " \t\n\r\0\x0B\xC2\xA0");
                }
                //verifica se a soma das porcentagens é igual a 100 caso não seja retorna o restante para o centro de custo inicial
                if ($soma_porcentagem_rateio != 100) {
                    $resto_porcentagem = 100 - $soma_porcentagem_rateio;
                    $valor_restante = FormataValor::Real($request->valor_total) - $soma_valor_rateio;

                    $rateios[] = [
                        'centro_custo_rateio' => $request->centro_custo_empresa,
                        'valor_rateio' => $valor_restante,
                        'porcentagem_rateio' => $resto_porcentagem,
                    ];
                }
                //chama a função do repository de rateios que salva no banco
                $rateioRepository = new RateioRepository();
                $rateioRepository->create($rateios, $id_despesa[0]->id_despesa);
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
                //chama a função do repository de itens que salva no banco
                $itemDespesaRepository = new ItemDespesaRepository();
                $itemDespesaRepository->create($itensDespesa, $id_despesa[0]->id_despesa);
            }

            if ($request->id_numero_documento) {
                $documentosDespesa = [];
                //percorre os arrays de centro_custo, valor, e porcentagem do rateio recebidos pelo request e os une em um array chamado $rateios[]
                for ($i = 0; $i < count($request->id_numero_documento); $i++) {
                    $documentosDespesa[] = [
                        'fk_tipo_documento' => $request->id_numero_documento[$i],
                        'de_documento' => $request->numero_documento[$i],
                    ];
                }
                //chama a função do repository de documentos que salva no banco
                $documentoRepository = new DocumentoRepository();
                $documentoRepository->create($documentosDespesa, $id_despesa[0]->id_despesa);
            }

            return redirect()->route('despesas')->with('success', 'Despesa Cadastrada!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Não foi possível cadastrar a Despesa' . $e->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $despesa = new Despesa();

            $despesa->id_despesa = $id;
            $despesa->numero_documento_despesa = $request->numero_nota_documento;
            $despesa->serie_despesa = $request->serie_documento;
            $despesa->tipo_documento = $request->tipo_documento;
            $despesa->dt_emissao = $request->data_emissao;

            Despesa::set($despesa);

            return redirect()->back()->with('success', 'Despesa Editada!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Não foi possível editar a Despesa' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $dt_fim = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            Despesa::del($id, $dt_fim);

            //adiciona data fim nos rateios da despesa
            $rateioRepository = new RateioRepository();
            $rateioRepository->setEndDateRateio($id, $dt_fim);

            return redirect()->back()->with('success', 'Despesa Excluída!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Não foi possível excluir a Despesa!');
        }
    }

    public function setProvisionDate(Request $request)
    {
        try {
            $provisionDate = $request->date;
            $ExpenseIds = $request->ids;

            foreach ($ExpenseIds as $id) {
                Despesa::setProvisionDate($id, $provisionDate);
            }

            return redirect()->back()->with('success', 'Data de provisionamento editada!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Não foi possível editar a Data de provisionamento' . $e->getMessage());
        }
    }
}
