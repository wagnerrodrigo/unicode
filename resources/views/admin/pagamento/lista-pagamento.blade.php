@extends('layouts.templates.template')
@section('title', 'Pagamento')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Detalhe do Pagamento</h1>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        @if( $pagamentosAtivos == null || empty($pagamentosAtivos))
                        <tbody>
                            <tr>
                                <td>Nenhum Fornecedor Cadastrado</td>
                            </tr>
                        </tbody>
                        @else
                        <tr>
                            <th>ID DO PAGAMENTO</th>
                            <th>DESCRIÇÃO PAGAMENTO</th>
                            <th>DATA DO PAGAMENTO</th>
                            <th>STATUS DO PAGAMENTO</th>
                            {{-- <th>EMPRESA NO RATEIO</th> PEGAR O NOME DAS EMPRESA--}}
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagamentosAtivos as $pagamento)
                        <tr>
                            <td>{{$pagamento->id_pagamento}}</td>
                            <td>{{$pagamento->de_pagamento}}</td>
                            <td>{{$pagamento->dt_pagamento}}</td>
                            <td></td>
                            <td>
                                <!-- muda a rota-->
                                <a href="/pagament" class="btn btn-primary" style="padding: 8px 12px;">
                                    <i class="bi bi-cash-coin"></i>
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
