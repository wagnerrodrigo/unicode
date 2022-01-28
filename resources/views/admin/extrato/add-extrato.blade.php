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

                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <strong>TITULO DA DESPESA</strong>
                                </div>
                                <span>{{ $lancamento->de_despesa }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>VALOR TOTAL DA DESPESA</strong>
                                </div>
                                <span>{{ $mascara::maskMoeda($lancamento->valor_total_despesa) }}</span>
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
                                    <strong>CNPJ</strong>
                                </div>
                                <span> {{ $mascara::mask($lancamento->cnpj_empresa, '##.###.###/####-##') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @endforeach

                    <div style="padding: 10px">
                        <h3>RATEIOS</h3>
                    </div>

                    <hr>

                    @foreach ($rateios as $rateio)
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>
                                        VALOR DO RATEIO
                                    </strong>
                                </div>
                                <span>
                                    {{ $mascara::maskMoeda($rateio->valor_rateio_pagamento) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>
                                        NUMERO DA CONTA
                                    </strong>
                                </div>
                                <span>
                                    {{ $rateio->nu_conta }}
                                </span>
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
                                <span>
                                    {{ $rateio->de_banco }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>
                                        AGENCIA
                                    </strong>
                                </div>
                                <span>
                                    {{ $rateio->nu_agencia }}
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>
                                        CÓDIGO OPERAÇÃO
                                    </strong>
                                </div>
                                <span>
                                    {{ $rateio->co_op }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach

                </div>
            </div>

        </div>
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
                            <table class="collapse table table-borderless" id="collapseExample{{ $lancamento->id_tab_lancamento }}">
                                <tr class="table-dark">
                                    <th>ID EXTRATO</th>
                                    <th>NOME BANCO</th>
                                    <th>NUMERO CONTA</th>
                                    <th>DATA FIM</th>
                                    <th>VALOR TOTAL</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" value="" name="" id="">
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>


                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            </table>
                        </tbody>
                    </table>
            </div>


            <div class="card-footer col-sm-12 d-flex justify-content-end">
                <button type="button" data-bs-toggle="modal" data-bs-target="#xconciliacao" class="btn btn-primary  me-1 mb-1" id="btnConciliacao">
                    CONCILIAR
                </button>
                <a href="{{ route('extrato') }}" class="btn btn-danger  me-1 mb-1">CANCELAR</a>
            </div>
        </div>
        </form>
        {{-- FIM CARD EXTRATO --}}

    </div>
    {{-- FIM CARD CONCILICAÇÃO --}}

    




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
