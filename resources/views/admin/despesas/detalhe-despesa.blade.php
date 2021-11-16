@extends('layouts.templates.template')
@section('title', "Despesa")

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>DESPESA N°{{$despesa->numero_despesa}}</h1>
            </div>
            <div class="card-body" style="font-size: 18px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong for="raz_social">NUMERO DA DESPESA</strong>
                                </div>
                                <span>{{$despesa->numero_despesa}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>CENTRO DE CUSTO</strong>
                                </div>
                                <span>{{$despesa->fk_tab_centro_custo_id}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>EMPRESA</strong>
                                </div>
                                <span>{{$despesa->fk_tab_empresa_id}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>TIPO DA DESPESA</strong>
                                </div>
                                <span>{{$despesa->fk_tab_tipo_despesa_id}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>SÉRIE</strong>
                                </div>
                                <span>{{$despesa->serie_despesa}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>DATA DE EMISSÃO</strong>
                                </div>
                                <span>{{date("d/m/Y", strtotime($despesa->dt_emissao))}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>STATUS</strong>
                                </div>
                                <span>{{$despesa->fk_status_despesa_id}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>TIPO DESPESA</strong>
                                </div>
                                @if($despesa->fk_tab_tipo_despesa_id == 1)
                                <span>{{$despesa->fk_tab_fornecedor_id}}</span>
                                @else
                                <span>{{$despesa->fk_tab_empregado_id}}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>PARCELAS</strong>
                                </div>
                                <span>{{$despesa->qt_parcelas_despesa,}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>VALOR TOTAL</strong>
                                </div>
                                <span>{{$despesa->valor_total_despesa}}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#xlarge">Editar</button>
                    <a href="{{route('despesas')}}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>

@endsection