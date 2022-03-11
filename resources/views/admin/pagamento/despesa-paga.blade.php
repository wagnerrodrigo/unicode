@extends('layouts.templates.template')
@section('title', 'Detalhes do Pagamento')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>DETALHES DO PAGAMENTO DA DESPESA N°{{$pagamento->id_despesa}}</h1>
            </div>
            <div class="card-body" style="font-size: 18px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>EMPRESA</strong>
                                </div>
                                <div>
                                    <span>{{$pagamento->de_empresa}}</span>
                                </div>
                                <span>{{$pagamento->regiao_empresa}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>CENTRO DE CUSTO</strong>
                                </div>
                                <span>{{$pagamento->de_departamento}}</span>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>EMPREGADO/FORNECEDOR</strong>
                                </div>
                                @if($pagamento->fk_tab_tipo_despesa_id == 2)
                                <span>{{$pagamento->de_razao_social}}</span>
                                @else
                                <span>{{$pagamento->nome_empregado}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>CPF/CNPJ</strong>
                                </div>
                                <span>
                                    {{strlen($pagamento->nu_cpf_cnpj) == 14
                                ? $mascara::mask($pagamento->nu_cpf_cnpj, '##.###.###/####-##')
                                : $mascara::mask($pagamento->nu_cpf_cnpj, '###.###.###-##')}}</span>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>CONTA DE PAGAMENTO</strong>
                                </div>
                                <span>Agência: {{$pagamento->nu_agencia}} Conta: {{$pagamento->nu_conta}} Co-op: {{$pagamento->co_op}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>INSTITUIÇÃO BANCÁRIA</strong>
                                </div>
                                <span>{{$pagamento->de_banco}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>VALOR ORIGINAL DA DESPESA</strong>
                                </div>
                                <span>{{$mascara::maskMoeda($pagamento->valor_total_despesa)}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>DESCONTO</strong>
                                </div>
                                <span>{{$pagamento->desconto == null ? 'R$ 0,00' : $mascara::maskMoeda($pagamento->desconto)}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>JÚROS</strong>
                                </div>
                                <span>{{$pagamento->juros == null ? 'R$ 0,00' : $mascara::maskMoeda($pagamento->juros)}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>MULTA</strong>
                                </div>
                                <span>{{$pagamento->multa == null ? 'R$ 0,00' : $mascara::maskMoeda($pagamento->multa)}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>VALOR PAGO</strong>
                                </div>
                                <span>{{$mascara::maskMoeda($pagamento->valor_pago)}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>PARCELAS</strong>
                                </div>
                                <span>{{$pagamento->qt_parcelas_despesa}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>DATA VENCIMENTO</strong>
                                </div>
                                <span>{{date('d/m/Y', strtotime($pagamento->dt_vencimento))}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>DATA DO EFETIVO PAGAMENTO</strong>
                                </div>
                                <span>{{date('d/m/Y', strtotime($pagamento->dt_efetivo_pagamento))}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>TIPO PAGAMENTO</strong>
                                </div>
                                <span>{{$pagamento->de_condicao_pagamento}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h1>RATEIOS</h1>
            </div>
            <div class="card-body" style="font-size: 18px;">
                @foreach ($rateios as $rateio)
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>EMPRESA</strong>
                                </div>
                                <div>
                                    <span>{{$rateio->de_empresa}}</span>
                                </div>
                                <span>{{$rateio->regiao_empresa}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>CENTRO DE CUSTO</strong>
                                </div>
                                <span>{{$rateio->de_departamento}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>VALOR RATEADO</strong>
                                </div>
                                <div>
                                    <span>{{$mascara::maskMoeda($rateio->valor_rateio_despesa)}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>PORCENTAGEM DO RATEIO</strong>
                                </div>
                                <span>{{$rateio->porcentagem_rateio_despesa}}%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach

                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
@endsection
