@extends('layouts.templates.template')
@section('title', 'Detalhes Lançamento')

@section('content')

    <div id="main" style="margin-top: 5px;">
        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1>Efetivo Pagamento da despesa numero : {{ $lancamento->id_despesa }}</h1>
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
                    </div>
                </div>
            </div>




            <div class="card">
                <div class="card-body">
                    {{-- INICIO DO CAMPO DE ADICIONAR CONTAS --}}

                    <div class="d-flex" style="width: 100%; align-items:center">
                        <div class="px-5 mb-3">
                            <h3>SELECIONAR CONTA DE PAGAMENTO </h3>

                            <!-- <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#xlargeServico"> -->
                            <!-- <i class="bi bi-plus"></i>serviço -->
                            <!-- </button>  -->
                        </div>
                    </div>

                    <form action="/lancamentos/provisionamento" method="post">
                    @csrf
                    <input type="hidden"  id="hidden_inputs_itens">

                   

                    <div class="d-flex" style="width: 100%; margin: 15px;">
                        <!-- Inicio da tabela de itens -->
                        <div class="px-5 mb-3">
                            <div class="table-responsive">
                                <div class="d-flex flex-row"
                                    style="padding:10px; align-items:center; border: 1px solid #ccc">
                                    <div class="inserirProd_Ser" style="padding:10px">
                                        <samp>INSTITUIÇÕES BANCÁRIAS</samp>
                                        <input type="text" placeholder="" name="inst_banco" id="inst_banco"
                                            class="form-control" style="width: 400px">
                                        <div class="Resultado_inst_banco input-addBanco" id="Resultado_inst_banco"></div>
                                        <!--serve somente para armazenar o id da instituição bancária selecionada-->
                                        <input type="hidden" id="id_inst_banco"></input>
                                        <!-- ### -->
                                    </div>

                                    <div class="inserirQuant" style="padding:10px;">
                                        <samp>AGENCIA</samp>
                                        <select type="text" placeholder="" name="agencia" id="agencia"
                                            class="form-control" style="width: 65px">
                                            <option selected value="" class="Resultado_agencia"></option>
                                        </select>
                                    </div>

                                    <div class="inserirDesc" style="padding:10px;">
                                        <samp>CONTAS</samp>
                                        <select type="text" name="conta_banco" id="conta_banco" class="form-control"
                                            style="width: 105px">
                                            <option selected value="" class="Resultado_conta_banco"></option>
                                        </select>
                                    </div>

                                    <div class="inserirValor" style="padding:10px;">
                                        <samp>VLR DESPESA</samp>
                                        <input type="text" id="valor_total" class="form-control"
                                            value="{{ $lancamento->valor_total_despesa }}" readonly style="width: 100px"
                                            name="valor_total" />
                                    </div>

                                    <div class="inserirValor" style="padding:10px;">
                                        <samp>VALOR RATEIO</samp>
                                        <input type="text" id="valor_rateio" class="form-control"
                                            value=""  style="width: 100px"
                                            name="valor_rateio" />
                                    </div>

                                    <div class="inserirData" style="padding:10px;">
                                        <samp>DT EFETIVO PAGAMENTO</samp>
                                        <input type="date" name="" id="data_efetivo_pag" class="form-control">
                                    </div>
                                    <div style="padding:15px;">
                                        <button class="btn btn-primary" type="button" id="addContas"
                                            style="width: 2.5rem; padding: 6.5px; margin-top: 3px">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>

                                    <div id="acao_dados" style="display:none;"></div>
                                </div>
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>INSTITUIÇÕES BANCÁRIAS</th>
                                            <th>AGÊNCIA</th>
                                            <th>CONTAS BANCARIAS</th>
                                            <th>VALOR DESPESA</th>
                                            <th>VALOR RATEIO</th>
                                            <th>DATA DO EFETIVO PAGAMENTO</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Tb">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Fim da tabela de itens -->

                    {{-- FIM DO CAMPO DE ADICIONAR CONTAS --}}
                </div>
                <div class="card-footer col-sm-12 d-flex justify-content-end">

                    <button type="submit" class="btn btn-primary  me-1 mb-1">Cadastra Pagamento</button>
                    <a href="{{ route('pagamentos') }}" class="btn btn-danger  me-1 mb-1">Cancelar</a>
                </div>
            </div>
        </form>
        </div>


        <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

        <script src="{{ asset('assets/js/vendors.js') }}"></script>

        <script src="{{ asset('assets/js/vendors.js') }}"></script>

        <script src="{{ asset('assets/js/main.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="{{ asset('assets/js/custom-js/lancamento.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/mascara-dinheiro.js') }}"></script>

    @endsection
