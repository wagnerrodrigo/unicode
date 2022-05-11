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
use App\Repository\CostCenterRepository;
use App\Repository\DocumentoRepository;
use App\Repository\EmpresaRepository;
use App\CustomError\CustomErrorMessage;
use App\Repository\ParcelaDespesaRepository;

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
            $filial = $request->input('filial');

            $empresaRepository = new EmpresaRepository();
            $empresas = $empresaRepository->getEmpresas();

            if ($request->has('status')) {
                $despesas = Despesa::selectAll($results, $status_despesa, $dt_inicio, $dt_fim, $filial);
            } else {
                $despesas = Despesa::selectAll($results = 10);
            }
            return view('admin.despesas.lista-despesas', compact('despesas', 'mascara', 'results', 'status_despesa', 'dt_inicio', 'dt_fim', 'filial', 'empresas'));
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
            foreach ($despesaRepository->findTipoECentroCustoDespesa($id) as $tipoDespesa) {
            }

            $costCenterRepository = new CostCenterRepository();

            $tipo = TipoDespesa::class;

            $despesas = Despesa::findOne(
                $id,
                $tipoDespesa->fk_tab_tipo_despesa_id,
                $tipoDespesa->fk_tab_centro_custo_id
            );

            $costCenter = $costCenterRepository->getCenterCostByIdCompany($despesas[0]->fk_empresa_id);

            $mascara = new Mascaras();
            if ($despesas == null || empty($despesas)) {
                return view('admin.despesas.despesa-nao-encontrada');
            } else {
                $despesa = $despesas[0];

                return view('admin.despesas.detalhe-despesa', compact('despesa', 'mascara', 'tipo', 'costCenter'));
            }
        } catch (\Exception $e) {
            $error = CustomErrorMessage::ERROR_DESPESA;
            return view('error', compact('error'));
        }
    }

    public function store(Request $request)
    {
        try {
            $parcelaDespesaRepository = new ParcelaDespesaRepository();
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
            $despesa->qt_parcelas_despesa = $request->numero_parcelas;
            $despesa->serie_despesa = $request->serie_documento;
            $despesa->dt_emissao = $request->data_emissao;
            $despesa->valor_total_despesa = FormataValor::Real($request->valor_total);
            $despesa->fk_status_despesa_id = StatusDespesa::A_PAGAR;
            $despesa->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            $despesa->de_despesa = mb_convert_case($request->titulo_despesa, MB_CASE_UPPER, 'UTF-8');
            $despesa->moeda = $request->moeda;

            $despesa->numero_processo = $request->numero_processo;
            $despesa->dt_fim = null;

            Despesa::create($despesa);

            //armazena timeStamp da data de criação da despesa
            $timestamp = $despesa->dt_inicio;
            //pega o id da despesa criada anteriormente para inserir na tabela ItemDespesa
            $id_despesa = Despesa::findByTimeStamp($timestamp);

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

            if ($request->parcelas > 1) {
                $parcelas = [];
                for ($i = 0; $i < count($request->parcelas); $i++) {
                    $parcelas[] = [
                        'fk_despesa' => $id_despesa[0]->id_despesa,
                        'num_parcela' => $i + 1,
                        'dt_emissao' => Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString(),
                        'dt_vencimento' => $request->vencimento_parcela[$i],
                        'dt_inicio' => Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString(),
                        'dt_fim' => null,
                        'valor_parcela' => $request->parcelas[$i],
                        'fk_status_parcela_id' => StatusDespesa::A_PAGAR,
                        'fk_forma_pagamento_id' => null,
                        'fk_tipo_pagamento_id' => null,
                        'fk_conta_bancaria_id' => null,
                    ];
                }
                $parcelaDespesaRepository->store($parcelas);
            } else {
                $parcelaDespesaRepository->store([
                    'fk_despesa' => $id_despesa[0]->id_despesa,
                    'num_parcela' => 1,
                    'dt_emissao' => Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString(),
                    'dt_vencimento' => $request->data_vencimento,
                    'valor_parcela' => $request->valor_total,
                    'fk_status_parcela_id' => StatusDespesa::A_PAGAR,
                    'fk_forma_pagamento_id' => null,
                    'fk_tipo_pagamento_id' => null,
                    'fk_conta_bancaria_id' => null,
                ]);
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
            $despesa->dt_emissao = $request->data_emissao;
            $despesa->fk_tab_centro_custo_id = $request->centro_custo;

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
