@extends('layouts.templates.template')
@section('title', 'Pagamento')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Despesas pagas</h1>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        @if( $pagamentos == null || empty($pagamentos))
                        <tbody>
                            <tr>
                                <td>Nenhum Fornecedor Cadastrado</td>
                            </tr>
                        </tbody>
                        @else
                        <tr>
                            <th>NÚMERO DA DESPESA</th>
                            <th>VALOR DA DEPESA</th>
                            <th>VALOR PAGO</th>
                            <th>STATUS</th>
                            <th>DATA DO PAGAMENTO</th>
                            <th></th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagamentos as $pagamento)
                        <tr>
                            <td>{{$pagamento->id_despesa}}</td>
                            <td>{{$mascara::maskMoeda($pagamento->valor_total_despesa)}}</td>
                            <td>{{$mascara::maskMoeda($pagamento->valor_pago)}}</td>
                            <td>{{$pagamento->de_status_despesa}}</td>
                            <td>{{date("d/m/Y", strtotime($pagamento->dt_efetivo_pagamento))}}</td>
                            <td></td>
                            <td>
                                <!-- muda a rota-->
                                <a href="/pagamentos/{{$pagamento->id_pagamento}}" class="btn btn-primary" style="padding: 8px 12px;">
                                    <i class="bi bi-eye-fill"></i>
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

<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors.js') }}"></script>
<script src="{{ asset('assets/js/vendors.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>


@endsection
