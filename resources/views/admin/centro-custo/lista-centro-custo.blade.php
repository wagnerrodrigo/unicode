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
                @if($centroCustosAtivos === null || empty($centroCustosAtivos))
                <div class="alert alert-danger" role="alert">
                    <strong>Nenhum Centro de Custo cadastrado!</strong>
                </div>
                @else
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
                        @foreach($centroCustosAtivos as $centroCusto)
                        <tr>
                            <td>{{$centroCusto->empresa}}</td>
                            <td>{{$centroCusto->nome}}</td>
                            <td>{{$centroCusto->responsavel}}</td>
                            <td>
                                <span class="badge bg-success">Ativo</span>
                            </td>
                            <td>
                                <a href="/centro-custos/{{$centroCusto->id}}" class="btn icon btn-primary " style="padding: 8px 12px;">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <button data-bs-toggle="modal" data-bs-target="#delete" class="btn btn-danger" style="padding: 8px 12px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach


                        <!-- Inicio Modal Delete-->
                        <div class="modal-danger me-1 mb-1 d-inline-block">
                            <!--Danger theme Modal -->
                            <div class="modal fade text-left" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title white" id="myModalLabel120">EXCLUSÃO</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja realmente excluir o centro de custo?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Cancelar</span>
                                            </button>
                                            <form action="centro-custos/delete/{{$centroCusto->id}}" method="POST">
                                                @csrf
                                                <button class="btn btn-danger ml-1">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Excluir</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim Modal Delete-->
                    </tbody>
                </table>
                @endif
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
                    <form action="/centro-custos" method="POST" style="padding: 10px;">
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