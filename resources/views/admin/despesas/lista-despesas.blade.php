@extends('layouts.templates.template')
@section('title', 'Lista Despesas')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Lista Despesas</h1>
                <a class="btn btn-success" href="{{route('add-despesas')}}">
                    <i class="bi bi-plus-circle"></i> Nova Despesa
                </a>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Valor</th>
                            <th>Parcelas</th>
                            <th>Valor das Parcelas</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>R$300,00</td>
                            <td>3</td>
                            <td>R$100,00</td>
                            <td>16/10/2021</td>
                            <td>A pagar</td>
                            <td>
                                <form method="GET" action="/fornecedores/1" data-bs-toggle="modal" data-bs-target="#xlarge-view" class="btn btn-primary" style="padding: 8px 12px;">
                                    @csrf
                                    <i class="bi bi-eye-fill"></i>
                                </form>
                                <a href="{{route('cadastro-fornecedores')}}" class="btn btn-danger" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Inicio Modal Adicionar-->


<!-- Fim modal Adicionar -->
<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>

@endsection