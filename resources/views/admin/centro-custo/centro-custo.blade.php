@extends('layouts.templates.template')
@section('title', 'Centro de Custos')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Centro de Custos</h1>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                    <i class="bi bi-plus-circle"></i> Novo Centro de Custo
                </button>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Empresa do grupo</th>
                            <th>Nome</th>
                            <th>Responsável</th>
                            <th>Status</th>
                            <th style="text-align: center;">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>CERCRED</td>
                            <td>centro de custos T.I</td>
                            <td>Responsavel pelo setor</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                            <td>
                                <a href="modal-centro-custo" data-bs-toggle="modal" data-bs-target="#inlineForm" class="btn icon btn-primary " style="padding: 8px 12px;"><i class="bi bi-pen-fill"></i></a>
                                <a href="#" class="btn icon btn-danger " style="padding: 8px 12px;"><i class="bi bi-trash"></i></a>
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
                    <h4 class="modal-title" id="myModalLabel16">Novo centro de custo</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- muda a rota-->
                    <form action="#" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <div>
                                    <strong>Empresa do Grupo</strong>

                                    <select class="form-control input-add" name="empresa" id="empresa">
                                        <option selected value="empresa_1">Empresa 1</option>
                                        <option value="empresa_2">Empresa 2</option>
                                        <option value="empresal_3">Empresa 3</option>
                                        <option value="empresa_4">Empresa 4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Nome</strong>
                                <input class="form-control mt-1 input-add" placeholder="Nome" type="text" name="nome">
                            </div>
                        </div>

                        <div class="px-5 mb-3">
                            <strong>Responsável</strong>
                            <select class="form-control input-add" name="responsavel" id="responsavel">
                                <option selected value="responsavel_1">Responsável 1</option>
                                <option value="responsavel_2">Responsável 2</option>
                                <option value="responsavel_3">Responsável 3</option>
                                <option value="responsavel_4">Responsável 4</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        <!-- muda a rota-->
                        <a href="#" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- fim modal -->

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>

@endsection