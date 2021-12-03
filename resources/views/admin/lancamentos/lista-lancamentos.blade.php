@extends('layouts.templates.template')
@section('title', 'Lançamento')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Detalhe do lançamento</h1>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        @if( $lancamentosAtivos == null || empty($lancamentosAtivos))
                        <tbody>
                            <tr>
                                <td>Nenhum Lancamento Cadastrado</td>
                            </tr>
                        </tbody>
                        @else
                        <tr>
                            <th>DESPESA</th>
                            <th>DESCRIÇÃO DESPESA</th>
                            <th>VALOR DA DESPESA</th>
                            <th>DATA VENCIMENTO</th>
                            <th>DATA DO EFETIVO PAGAMENTO</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lancamentosAtivos as $lancamentos)
                        <tr>
                            <td>{{$lancamentos->id_despesa}}</td>
                            <td>{{$lancamentos->de_despesa}}</td>
                            <td>{{$lancamentos->valor_total_despesa}}</td>
                            <td>{{$lancamentos->dt_vencimento}}</td>
                            <td>{{$lancamentos->de_pagamento}}</td>
                            <td>
                                <!-- muda a rota-->
                                <a href="lancamentos/{{$lancamentos->id_despesa}}" class="btn btn-success" style="padding: 8px 12px;">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="" class="btn btn-danger" style="padding: 8px 12px;">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
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
