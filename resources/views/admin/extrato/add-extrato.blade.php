@extends('layouts.templates.template')
@section('title', 'Detalhes Extrato')


@section('content')
    <div id="main" style="margin-top: 5px;">

        @foreach ($lancamentos as $lancamento)
            {{-- INICIO CARD CONCILICAÇÃO --}}
            <div class="main-content container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h1>CONCILIAÇÃO DO LANCAMENTO N° :{{ $lancamento->id_tab_lancamento }}</h1>
                    </div>
                    <div class="card-body" style="font-size: 18px;">

                        {{-- INICIO DA INFORMAÇÃO DA DESPESA --}}
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
                                        <span>{{ $lancamento->valor_total_despesa }}</span>
                                        <input type="hidden" name="" id="valorTotal"
                                            value="{{ $lancamento->valor_total_despesa }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <strong>DATA DO VENCIMENTO</strong>
                                        </div>
                                        <span>{{ date('d/m/Y', strtotime($lancamento->dt_vencimento)) }}</span>
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <strong>STATUS</strong>
                                        </div>
                                        <span>{{ $lancamento->de_status_despesa }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <strong>
                                                INSTITUIÇÃO BANCARIA
                                            </strong>
                                        </div>
                                        <span></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <strong>
                                                RATEIO ENTRE CONTAS
                                            </strong>
                                        </div>
                                        <span></span>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <strong>
                                                RATEADO EM EMPRESAS
                                            </strong>
                                        </div>
                                        <span></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <strong>
                                                DATA DO LANCAMENTO
                                            </strong>
                                        </div>
                                        <span></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        @endforeach

        {{-- INICO CARD EXTRATO --}}
        <div class="card">
            <div class="card-header">
                <h3>EXTRATOS</h3>
            </div>
            <div class="card-body">

                <form action="" method="post">
                    @csrf

                    <input type="hidden" id="hidden_inputs_itens">


                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>EXTRATO</th>
                                <th>BANCO</th>
                                <th>CONTA</th>
                                <th>DATA FIM</th>
                                <th>VALOR TOTAL</th>
                                <th>AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>asdf</td>
                                <td>asdf</td>
                                <td>asdfasdfasdf</td>
                                <td>asdfasdfasdfasdfasdfasdfasd</td>
                                <td>asoidpofiajsdopif </td>
                                <td>
                                    <input type="checkbox" name="despesa" id="">
                                </td>

                            </tr>
                            @if ($extratos != null || !empty($extratos))
                                <table class="collapse table table-borderless"
                                    id="collapseExample{{ $despesa->id_despesa }}">
                                    <tr class="table-dark">
                                        <th>ID EXTRATO</th>
                                        <th>NOME BANCO</th>
                                        <th>NUMERO CONTA</th>
                                        <th>DATA FIM</th>
                                        <th>VALOR TOTAL</th>
                                    </tr>
                                    @foreach ($extratos as $extrato)
                                        <tr>
                                            <td>
                                                {{ $extrato->id_extrato }}
                                                <input type="checkbox" value="{{ $extrato->id_extrato }}" name="" id="">
                                            </td>
                                            <td>
                                                {{ $extrato->de_banco }}
                                            </td>
                                            <td>
                                                {{ $extrato->nu_conta }}
                                            </td>
                                            <td>

                                                {{ date('d/m/Y', strtotime($extrato->dtend)) }}
                                            </td>
                                            <td>
                                                {{ $mascara::maskMoeda($extrato->balamt) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </tbody>


                    </table>


            </div>


            <div class="card-footer col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary  me-1 mb-1" id="btnConciliacao">CONCILIAR</button>
                <a href="{{ route('extrato') }}" class="btn btn-danger  me-1 mb-1">CANCELAR</a>
            </div>
        </div>
        </form>
        {{-- FIM CARD EXTRATO --}}


    </div>
    {{-- FIM CARD CONCILICAÇÃO --}}

    <!-- Inicio Modal Rateio-->
    <div class="me-1 mb-1 d-inline-block">
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="xrateio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">RATEIO</h4>
                        <div>
                            <span>Valor Total: </span>
                            <input class="input-add" id="modal_valor_total" name="modal_valor_total" readonly
                                style="width: 120px; border-radius: 3px; border: 1px solid purple; margin-right:20px" />


                            <span>Valor Rateado: </span>
                            <input class="input-add" id="modal_valor_rateado" name="modal_valor_rateado" readonly
                                style="width: 120px; border-radius: 3px; border: 1px solid purple" />
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" onclick="limpaCamposRateio()" data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>EMPRESA</strong>
                                <input class="form-control input-busca" type="text" id="busca_empresa" autocomplete="off"
                                    placeholder="Digite o nome da empresa" style="width: 60rem" />
                                <div id="results_empresa" class="resultado-busca"></div>
                                <!--serve somente para armazenar o id da empresa selecionada-->
                                <input type="hidden" id="id_busca_empresa"></input>
                                <!-- ### -->
                            </div>
                        </div>
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>INSTITUIÇÕES BANCÁRIAS</strong>
                                <input class="form-control input-busca" type="text" placeholder="" name="inst_banco"
                                    autocomplete=off id="inst_banco" class="form-control" style="width: 60rem" />
                                <div class="Resultado_inst_banco input-addBanco" value="" id="Resultado_inst_banco">
                                </div>
                                <!--serve somente para armazenar o id da instituição bancária selecionada-->
                                <input type="hidden" id="id_inst_banco"></input>
                                <!-- ### -->
                            </div>
                        </div>
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>VALOR RATEADO</strong>
                                <input class="form-control mt-1" id="valor_rateado" type="text"
                                    onkeypress="return onlynumber();" onkeyup="formataValor(this)"
                                    placeholder="Valor do item" style="width: 358px" />
                                <input type="hidden" id="id_valor_rateado"></input>
                            </div>
                            <div class="d-flex flex-row" style="width: 100%; align-items:center">
                                <div>
                                    <input class="form-control mt-1" id="porcentagem_rateado" type="text" min="0" max="3"
                                        onkeyup="return validateValue(this);" onkeypress="return onlynumber();"
                                        maxlength="3" style="width: 58px" />
                                    <input type="hidden" id="porcentagem_rateado_hiddem"></input>
                                </div>
                                <div>
                                    <strong>%</strong>

                                </div>

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



    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/js/vendors.js') }}"></script>

    <script src="{{ asset('assets/js/vendors.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="{{ asset('assets/js/custom-js/mascara-data.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/mascara-dinheiro.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/validacao-only-number.js') }}"></script>

@endsection
