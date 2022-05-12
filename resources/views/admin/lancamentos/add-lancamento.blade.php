@extends('layouts.templates.template')
@section('title', 'Detalhes Lançamento')

{{-- @dd($parcela) --}}
@section('content')

    <div id="main" style="margin-top: 5px;">
        <div class="main-content container-fluid">

                <div class="card">
                    <div class="card-header">
                        <h1>LANÇAMENTO DESPESA: {{ $lancamento->id_despesa }}</h1>
                    </div>
                    <div class="card-body" style="font-size: 18px;">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div>
                                            <strong>DESCRIÇÃO DA DESPESA </strong>
                                        </div>
                                        <span>{{ $lancamento->de_despesa }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <strong>EMPRESA</strong>
                                        </div>
                                        <span>{{ $lancamento->de_empresa }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <strong>VALOR</strong>
                                        </div>
                                        <span>{{ $mascara::maskMoeda($lancamento->valor_total_despesa) }}</span>
                                        <input type="hidden" name="" id="valorTotal"
                                            value="{{ $lancamento->valor_total_despesa }}">
                                    </div>
                                </div>


                            </div>

                            <div class="d-flex">


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div>
                                            <strong>STATUS</strong>
                                        </div>
                                        <span>{{ $lancamento->de_status_despesa }}</span>
                                    </div>
                                </div>
                            </div>


                            <hr />
                            <hr />

                            {{-- Inico info Parcelas --}}
                            <br>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h2>PARCELA NUMERO: <strong>{{$parcela->num_parcela}}</strong> </h2>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <strong>DATA DO EFETIVO PAGAMENTO</strong>
                                        </div>
                                        <input class="form-control" id="input_efetivo_pagamento" type="date"
                                            name="data_efetivo_pagamento" id="id_Efetivo_Pg">
                                    </div>
                                </div>
                            </div>



                            <div class="d-flex">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <strong>VALOR DA PARCELA</strong>
                                        </div>
                                        <span>{{ $mascara::maskMoeda($parcela->valor_parcela) }}</span>
                                        <input type="hidden" name="" id="valorTotal"
                                            value="{{ $parcela->valor_parcela }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div>
                                            <strong>FORMA DE PAGAMENTO </strong>
                                        </div>
                                        <input required class="form-control input-add teste" name="tipo_pagamento"
                                            id="condicao_pagamento" readonly style="cursor: pointer; width: 200px"/>
                                        <div id="itens_tipo_pagamento" class="input-style" style="cursor: pointer;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">

                                    <input type="hidden" id="idEmpregado" value="{{ $lancamento->fk_tab_empregado_id }}">
                                    <input type="hidden" id="idFornecedor"
                                        value="{{ $lancamento->fk_tab_fornecedor_id }}">
                                </div>



                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="col-md-6" id="conta_hidden">
                                    <!-- CAMPO DE CONTA BANCARIA E PIX -->
                                </div>

                                <div class="col-md-3" id="modal_conta">
                                    <!-- BUTTON MODAL -->
                                </div>
                            </div>

                            {{-- Fim info Parcelas --}}


                            <hr>
                            <div id="acrescidos"></div>
                            <hr>

                        </div>

                        <div class="d-flex">
                            <div class="px-5 mb-3">
                                <button type="button" id="modalJurosMulta" data-bs-toggle="modal"
                                    data-bs-target="#xconciliacao" class="btn btn-danger  me-1 mb-1">
                                    ADICIONAR JUROS E MULTAS
                                </button>
                            </div>
                        </div>
                    </div>
        </div>

        <div class="card" style="padding-top: 5px; margin-top: 90px">
            <div class="card-header">
                <h1>CONTA DE PAGAMENTO </h1>
            </div>

            <div class="d-flex" style="width: 100%;justify-content:start; align-items:center">
                <div class="px-5 mb-3">
                    <button class="btn btn-primary" id="adicionar_rateio" type="button" data-bs-toggle="modal"
                        data-bs-target="#xrateio">
                        ADICIONAR <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">

                <form id="formRateio" action="/lancamentos/adicionar" method="post">
                    @csrf

                    <input type="hidden" id="hidden_inputs_itens">
                        <input type="hidden" name="id_despesa" id="id_despesa" value="{{ $lancamento->id_despesa }}">
                        <input type="hidden" name="fk_condicao_pagamento_id" id="fk_condicao_pagamento_id"
                            value="{{ $lancamento->fk_condicao_pagamento_id }}">
                        <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $lancamento->id_empresa }}">
                        <input type="hidden" name="valor_total_despesa" id="valor_total_despesa"
                            value="{{ $lancamento->valor_total_despesa }}">
                        <input type="hidden" name="dt_vencimento" id="dt_vencimento"
                            value="{{ $lancamento->dt_vencimento }}">
                        <input type="hidden" name="dt_efetivo_pagamento" id="hidden_dt_efetivo_pagamento" value="">
                    <input type="hidden" id="hiddenInputs">

                    <div class="d-flex" style="width: 100%;  margin: 15px;">
                        <div class="px-1 mb-3">
                            <div class="table-responsive">

                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>EMPRESA</th>
                                            <th>CONTA BANCÁRIA</th>
                                            <th>AÇÕES</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Tb">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer col-sm-12 d-flex justify-content-end">

                <button type="submit" class="btn btn-primary  me-1 mb-1" id="btnSalvar">SALVAR</button>
                <a href="{{ route('lancamentos') }}" class="btn btn-danger  me-1 mb-1">CANCELAR</a>
            </div>
        </div>
        </form>
    </div>


    {{-- de_razao_social nome_emprega --}}


    <!-- Inicio Modal Adicionar-->
    <div class="me-1 mb-1 d-inline-block">
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="modal_conta_bancaria" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">CONTA BANCÁRIA</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" data-feather="x"></i>
                        </button>
                    </div>
                    <form name="form_conta_bancaria">
                        @csrf
                        <div class="modal-body">
                            <div class="d-flex flex-column" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>TITULAR</strong>

                                        <input class="form-control input-busca" name="titular_conta" type="text"
                                            id="titular_conta" readonly style="width: 60rem"
                                            placeholder="{{ $lancamento->fk_tab_tipo_despesa_id == 1
                                                    ? $lancamento->nome_empregado
                                                    : $lancamento->de_razao_social
                                                     }}" />

                                            <input name="id_titular_conta" type="hidden" id="id_titular_conta" />
                                            <input name="tipo_da_despesa" type="hidden" id="tipo_da_despesa" value="{{$lancamento->fk_tab_tipo_despesa_id}}"/>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>BANCO</strong>
                                    <select id="inst_financeiras" name="inst_financeira" class="form-control input-busca"
                                        style="width: 60rem">

                                    </select>
                                    <span id="erro_instituicao"></span>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>AGENCIA</strong>
                                    <input type="text" onkeypress="return onlynumber();" class="form-control"
                                        id="nu_agencia" name="nu_agencia" autocomplete="off" style="width: 28rem;">
                                    <span id="erro_agencia"></span>
                                </div>

                                <div class="px-3 mb-3">
                                    <strong>NUMERO DA CONTA</strong>
                                    <input type="text" onkeypress="return onlynumber();" class="form-control"
                                        id="nu_conta" name="nu_conta" autocomplete="off" style="width: 28rem;">
                                    <span id="erro_conta"></span>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>CODIGO OPERAÇÃO</strong>
                                    <input type="text" class="form-control" onkeypress="return onlynumber();"
                                        id="co_operacao" name="co_operacao" autocomplete="off" style="width: 28rem;">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-1 mb-1">
                                    <i data-feather="check-circle"></i>ADICIONAR
                                </button>
                                <button type="button" class="close btn btn-secondary me-1 mb-1" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    CANCELAR
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim modal Adicionar -->

    <!-- Inicio Modal Adicionar PIX-->
    <div class="me-1 mb-1 d-inline-block">
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="modal_pix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">PIX</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" data-feather="x"></i>
                        </button>
                    </div>
                    <form name="form_conta_pix">
                        @csrf
                        <div class="modal-body">
                            <div class="d-flex flex-column" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>TITULAR</strong>
                                    <input class="form-control input-busca" name="titular_conta_pix" type="text"
                                        id="titular_conta_pix" readonly style="width: 60rem"
                                        placeholder="{{ $lancamento->fk_tab_tipo_despesa_id == 1
                                                      ? $lancamento->nome_empregado
                                                      : $lancamento->de_razao_social }}"  />

                                    <input name="id_titular_pix" type="hidden" id="id_titular_pix" />
                                    <input name="tipo_do_titular" type="hidden" id="tipo_do_titular" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>TIPO</strong>
                                    <select id="select_tipo_pix" name="select_tipo_pix" class="form-control input-busca"
                                        style="width: 8rem">
                                    </select>
                                    <span id="erro_select_tipo_pix"></span>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>PIX</strong>
                                    <input type="text" class="form-control" onblur="validaCampo(this, keyPix.cpfCnpj)"
                                        id="input_pix" name="input_pix" maxlength="18"
                                        onkeypress="mascaraMutuario(this,cpfCnpj)" autocomplete="off" style="width: 46rem;">
                                    <span id="erro_pix"></span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-1 mb-1">
                                    <i data-feather="check-circle"></i>ADICIONAR
                                </button>
                                <button type="button" class="close btn btn-secondary me-1 mb-1" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    CANCELAR
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim modal Adicionar PIX -->


    <!-- Inicio Modal Conciliação-->
    <div class="me-1 mb-1 d-inline-block">
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="xconciliacao" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">VALORES DE ACRÉSCIMO NA DESPESA</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>VALOR DO DESCONTO</strong>
                                <input class="form-control" id="desconto" onkeyup="formataValor(this)" type="text"
                                    onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"
                                    autocomplete="off" placeholder="DESCONTO" style="width: 60rem" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>VALOR DO JUROS</strong>
                                <input class="form-control" id="juros" onkeyup="formataValor(this)" type="text"
                                    onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"
                                    autocomplete="off" placeholder="JUROS" style="width: 60rem" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>VALOR DA MULTA</strong>
                                <input class="form-control" id="multa" type="text" onkeyup="formataValor(this)"
                                    onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"
                                    autocomplete="off" placeholder="MULTA" style="width: 60rem" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button class="btn btn-success me-1 mb-1" type="button" id="btnConciliacao"
                                class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="check-circle"></i>ADICIONAR
                            </button>
                            <button type="button" class="close btn btn-secondary me-1 mb-1" data-bs-dismiss="modal"
                                aria-label="Close">
                                CANCELAR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim modal Adicionar -->

    <!-- Inicio Modal Rateio-->
    <div class="me-1 mb-1 d-inline-block">
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="xrateio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">SELECIONE A CONTA:</h4>
                        <div>
                            <span>VALOR TOTAL: </span>
                            <input class="input-add" id="modal_valor_total" name="modal_valor_total" readonly
                                style="width: 120px; border-radius: 3px; border: 1px solid purple; margin-right:20px" />
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" onclick="limpaCamposRateio()" data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body" style="height:20rem">
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>EMPRESA</strong>
                                <input class="form-control input-busca" type="text" id="busca_empresa" autocomplete="off"
                                    placeholder="Digite o nome da empresa" style="width: 60rem" />
                                <div id="results_empresa" class="resultado-busca-empresa-lancamento"></div>
                                <!--serve somente para armazenar o id da empresa selecionada-->
                                <input type="hidden" id="id_busca_empresa"></input>
                                <!-- ### -->
                            </div>
                        </div>
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>CONTAS BANCÁRIAS</strong>
                                <input class="form-control input-busca" type="text" placeholder="" name="inst_banco"
                                    autocomplete=off id="inst_banco" class="form-control" style="width: 60rem" />
                                <div class="Resultado_inst_banco input-addBanco" value="" id="Resultado_inst_banco">
                                </div>
                                <!--serve somente para armazenar o id da instituição bancária selecionada-->
                                <input type="hidden" id="id_inst_banco"></input>
                                <!-- ### -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button class="btn btn-success me-1 mb-1" type="button" id="addContas">
                                <i data-feather="check-circle"></i>ADICIONAR
                            </button>
                            <button type="button" class="close btn btn-secondary me-1 mb-1" onclick="limpaCamposRateio()"
                                data-bs-dismiss="modal" aria-label="Close">CANCELAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim modal Adicionar -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="{{ asset('assets/js/custom-js/lancamento.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/conta-pix.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/conta-bancaria-despesa.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/valida-email.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/mascara-telefone.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/valida-cpf-cnpj.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/mascara-data.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/mascara-dinheiro.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/validacao-only-number.js') }}"></script>

@endsection
