@extends('layouts.templates.template')
@section('title', 'Lista Despesas')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Lista Despesas</h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-despesa">
                    <i class="bi bi-plus-circle"></i> Nova Despesa
                </button>
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
                                <a href="{{route('fornecedores')}}" class="btn btn-danger" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal-primary me-1 mb-1 d-inline-block">

    <!--primary theme Modal -->
    <div class="modal fade text-left" id="modal-add-despesa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="myModalLabel160">
                        Adicionar despesa
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Selecione o tipo de despesa:</h3>
                    <div class="d-flex">
                        <div class="p-1">
                            <input type="radio" checked value="fornecedor" name="despesa">
                            <strong>Fornecedor</strong>
                        </div>
                        <div class="p-1">
                            <input type="radio" value="empregado" name="despesa">
                            <strong>Empregado</strong>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnDespesa">
                        Adicionar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>

<script>
    //seleciona tipo de despesa
    document.getElementById("btnDespesa").onclick = function() {
        var radios = document.getElementsByName("despesa");
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                if (radios[i].value == "fornecedor") {
                    window.location.href = "/despesas/adicionar/fornecedor";
                }
                if (radios[i].value == "empregado") {
                    window.location.href = "/despesas/adicionar/empregado";
                }
            }
        }
    };
</script>

@endsection