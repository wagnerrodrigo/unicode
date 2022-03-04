@extends('layouts.templates.template')
@section('title', 'Despesa')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>DETALHES DO PAGAMENTO DA DESPESA N°{{$pagamento[0]->id_despesa}}</h1>
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
                                    <span>{{$pagamento[0]->de_empresa}}</span>
                                </div>
                                <span>{{$pagamento[0]->regiao_empresa}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>CENTRO DE CUSTO</strong>
                                </div>
                                <span>{{$pagamento[0]->de_departamento}}</span>
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
                                <span>{{$pagamento[0]->de_razao_social}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>CPF/CNPJ</strong>
                                </div>
                                <span>
                                    {{strlen($pagamento[0]->nu_cpf_cnpj) == 14
                                ? $mascara::mask($pagamento[0]->nu_cpf_cnpj, '##.###.###/####-##')
                                : $mascara::mask($pagamento[0]->nu_cpf_cnpj, '###.###.###-##')}}</span>
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
                                <span>Agência: {{$pagamento[0]->nu_agencia}} Conta: {{$pagamento[0]->nu_conta}} Co-op: {{$pagamento[0]->co_op}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>INSTITUIÇÃO BANCÁRIA</strong>
                                </div>
                                <span>{{$pagamento[0]->de_banco}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>VALOR ORIGINAL DA DESPESA</strong>
                                </div>
                                <span>{{$mascara::maskMoeda($pagamento[0]->valor_total_despesa)}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>DESCONTO</strong>
                                </div>
                                <span>{{$pagamento[0]->desconto == null ? 'R$ 0,00' : $mascara::maskMoeda($pagamento[0]->desconto)}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>JÚROS</strong>
                                </div>
                                <span>{{$pagamento[0]->juros == null ? 'R$ 0,00' : $mascara::maskMoeda($pagamento[0]->juros)}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>MULTA</strong>
                                </div>
                                <span>{{$pagamento[0]->multa == null ? 'R$ 0,00' : $mascara::maskMoeda($pagamento[0]->multa)}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>VALOR PAGO</strong>
                                </div>
                                <span>{{$mascara::maskMoeda($pagamento[0]->valor_pago)}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>PARCELAS</strong>
                                </div>
                                <span>{{$pagamento[0]->qt_parcelas_despesa}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>VALOR TOTAL</strong>
                                </div>
                                <span></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>VALOR TOTAL</strong>
                                </div>
                                <span></span>
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
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>EMPRESA</strong>
                                </div>
                                <div>
                                    <span>{{$pagamento[0]->de_empresa}}</span>
                                </div>
                                <span>{{$pagamento[0]->regiao_empresa}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>CENTRO DE CUSTO</strong>
                                </div>
                                <span>{{$pagamento[0]->de_departamento}}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="card-footer">
                    <a href="{{ route('despesas') }}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
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
