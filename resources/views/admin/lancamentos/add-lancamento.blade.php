@extends('layouts.templates.template')
@section('title', 'Detalhes Lançamento')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        @foreach($lancamentos as $lancamento)
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
                                    <strong>DESCRIÇÃO DA DESPESA</strong>
                                </div>
                                <span>{{ $lancamento->de_despesa }}</span>
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
                                <input type="hidden" name="" id="valorTotal" value="{{ $lancamento->valor_total_despesa }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div>
                                    <strong>DATA DO VENCIMENTO</strong>
                                </div>
                                <span>{{ date('d/m/Y', strtotime($lancamento->dt_vencimento)) }}</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <div>
                                    <strong>DATA DO EFETIVO PAGAMENTO</strong>
                                </div>
                                <input class="form-control" id="input_efetivo_pagamento" type="date" name="data_efetivo_pagamento" id="id_Efetivo_Pg">
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <div>
                                    <strong>STATUS</strong>
                                </div>
                                <span>{{ $lancamento->de_status_despesa }}</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <div>
                                    <strong>CONDIÇÃO DE PAGAMENTO</strong>
                                </div>
                                <span>{{ $lancamento->de_condicao_pagamento }}</span>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div id="acrescidos"></div>
                    <hr>
                </div>

                <div class="d-flex">
                    <div class="px-5 mb-3">
                        <button type="button" id="modalJurosMulta" data-bs-toggle="modal" data-bs-target="#xconciliacao" class="btn btn-danger  me-1 mb-1">
                            ADICIONAR JUROS E MULTAS
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="card">
            <div class="card-header">
                <h1>CONTA DE PAGAMENTO </h1>
            </div>

            <div class="d-flex" style="width: 100%;justify-content:start; align-items:center">
                <div class="px-5 mb-3">
                    <button class="btn btn-primary" id="adicionar_rateio" type="button" data-bs-toggle="modal" data-bs-target="#xrateio">
                        ADICIONAR <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">

                <form id="formRateio" action="/lancamentos/adicionar" method="post">
                    @csrf

                    <input type="hidden" id="hidden_inputs_itens">

                    <input type="hidden" name="id_despesa" id="id_despesa" value="{{$lancamento->id_despesa}}">
                    <input type="hidden" name="fk_condicao_pagamento_id" id="fk_condicao_pagamento_id" value="{{$lancamento->fk_condicao_pagamento_id}}">
                    <input type="hidden" name="id_empresa" id="id_empresa" value="{{$lancamento->id_empresa}}">
                    <input type="hidden" name="valor_total_despesa" id="valor_total_despesa" value="{{ $lancamento->valor_total_despesa }}">
                    <input type="hidden" name="dt_vencimento" id="dt_vencimento" value="{{ $lancamento->dt_vencimento }}">
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


    <!-- Inicio Modal Conciliação-->
    <div class="me-1 mb-1 d-inline-block">
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="xconciliacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
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
                                <input class="form-control" id="desconto" onkeyup="formataValor(this)" type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" autocomplete="off" placeholder="DESCONTO" style="width: 60rem" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>VALOR DO JUROS</strong>
                                <input class="form-control" id="juros" onkeyup="formataValor(this)" type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" autocomplete="off" placeholder="JUROS" style="width: 60rem" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>VALOR DA MULTA</strong>
                                <input class="form-control" id="multa" type="text" onkeyup="formataValor(this)" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" autocomplete="off" placeholder="MULTA" style="width: 60rem" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button class="btn btn-success me-1 mb-1" type="button" id="btnConciliacao" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="check-circle"></i>ADICIONAR
                            </button>
                            <button type="button" class="close btn btn-secondary me-1 mb-1" data-bs-dismiss="modal" aria-label="Close">
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
        <div class="modal fade text-left w-100" id="xrateio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">SELECIONE A CONTA:</h4>
                        <div>
                            <span>VALOR TOTAL: </span>
                            <input class="input-add" id="modal_valor_total" name="modal_valor_total" readonly style="width: 120px; border-radius: 3px; border: 1px solid purple; margin-right:20px" />
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" onclick="limpaCamposRateio()" data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body" style="height:20rem">
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>EMPRESA</strong>
                                <input class="form-control input-busca" type="text" id="busca_empresa" autocomplete="off" placeholder="Digite o nome da empresa" style="width: 60rem" />
                                <div id="results_empresa" class="resultado-busca-empresa-lancamento"></div>
                                <!--serve somente para armazenar o id da empresa selecionada-->
                                <input type="hidden" id="id_busca_empresa"></input>
                                <!-- ### -->
                            </div>
                        </div>
                        <div class="d-flex" style="width: 100%" >
                            <div class="px-5 mb-3">
                                <strong>CONTAS BANCÁRIAS</strong>
                                <input class="form-control input-busca" type="text" placeholder="" name="inst_banco" autocomplete=off id="inst_banco" class="form-control" style="width: 60rem" />
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
                            <button type="button" class="close btn btn-secondary me-1 mb-1" onclick="limpaCamposRateio()" data-bs-dismiss="modal" aria-label="Close">CANCELAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim modal Adicionar -->

    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/js/vendors.js') }}"></script>

    <script src="{{ asset('assets/js/vendors.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="{{ asset('assets/js/custom-js/lancamento.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/mascara-data.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/mascara-dinheiro.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/validacao-only-number.js') }}"></script>

    @endsection
