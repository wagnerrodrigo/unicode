@extends('layouts.templates.template')
@section('title', 'Lista Despesas')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Lista Despesas</h1>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                    <i class="bi bi-plus-circle"></i> Nova Despesa
                </button>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Produto/Serviço</th>
                            <th>Valor</th>
                            <th>Parcelas</th>
                            <th>Valor das Parcelas</th>
                            <th>Vencimento</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Monitor</td>
                            <td>R$300,00</td>
                            <td>3</td>
                            <td>R$100,00</td>
                            <td>16/10/2021</td>
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
<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Nova Despesa</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('despesas')}}" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Nome</strong>
                                <input class="form-control mt-1" type="text" placeholder="Nome" name="nome" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <div>
                                    <strong>Valor</strong>
                                </div>
                                <div>
                                    <input class="form-control mt-1" type="text" placeholder="Valor" name="valor_despesa" style="width: 358px" />
                                </div>
                            </div>
                        </div>


                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Parcelas</strong>
                                <select class="form-control" name="parcelas" id="parcelas" style="width: 358px">
                                    <option selected value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Valor das Parcelas</strong>
                                <input class="form-control mt-1" type="text" placeholder="Valor parcelas" name="valor_parcelas" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Vencimento</strong>
                                <input class="form-control mt-1" type="date" placeholder="Vencimento" name="vencimento" style="width: 358px" />
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        <a href="{{route('despesas')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar -->

<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/app.js"></script>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>

@endsection