@extends('layouts.templates.template')
@section('title', 'Produto')


@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Lista Produtos</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#xlarge">
                    <i class="bi bi-plus-circle"></i> Novo Produto
                </button>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Produto</th>
                            <th>Nome Genérico</th>
                            <th>Tipo</th>
                            <th>Forma do Produto</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Computador</td>
                            <td>Computador Financeiro</td>
                            <td>Individual</td>
                            <td>
                                <!-- mudar para cadastro de fonecedores -->
                                <a href="{{route('cadastro-fornecedores')}}" class="btn btn-success" style="padding: 8px 12px;"><i class="bi bi-eye-fill"></i></a>
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
                    <h4 class="modal-title" id="myModalLabel16">Novo Produto</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- mudar para produto  -->
                    <form action="{{route('produtos')}}" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Produto</strong>
                                <input class="form-control mt-1" type="text" placeholder="produto" name="produto" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <div>
                                    <strong>Nome Genérico</strong>
                                </div>
                                <div>
                                    <input class="form-control mt-1" type="text" placeholder="Nome" name="nome_generico" style="width: 358px" />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Tipo</strong>
                                <select class="form-control" name="tipo_produto" id="tipo_produto" style="width: 358px">
                                    <option selected value="tipo_1">Tipo 1</option>
                                    <option value="tipo_2">Tipo 2</option>
                                    <option value="tipo_3">Tipo 3</option>
                                </select>
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Forma Produto</strong>
                                <div>
                                    <input value="generico" type="radio" name="forma_produto" checked />
                                    <label for="generico">Genérico</label>
                                </div>
                                <div>
                                    <input value="individual" type="radio" name="forma_produto" />
                                    <label for="individual">Individual</label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        <!-- mudar para produto -->
                        <a href="{{route('produtos')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- fim modal -->




<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/app.js"></script>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>


@endsection