@extends('layouts.templates.template')
@section('title', 'Lista Instituição bancária')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Lista Instituições bancárias</h1>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                    <i class="bi bi-plus-circle"></i> Nova Instituição bancária
                </button>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Código Banco</th>
                            <th>Razão Social</th>
                            <th>Nome Banco</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>test campo</td>
                            <td>test campo</td>
                            <td>test campo</td>
                            <td>
                                <!-- muda a rota-->
                                <a href="#" class="btn btn-success" style="padding: 8px 12px;"><i class="bi bi-eye-fill"></i></a>
                                <a href="#" class="btn btn-danger" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></a>
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
                    <h4 class="modal-title" id="myModalLabel16">Nova Instituição bancária</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- muda a rota-->
                    <form action="#" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Código Banco</strong>
                                <input class="form-control mt-1 input-add" type="text" placeholder="Código" name="codigo" />
                            </div>

                            <div class="px-5 mb-3">
                                <div>
                                    <strong>Razão Social</strong>
                                    <input class="form-control mt-1 input-add" type="text" placeholder="Razão Social" name="razao_social" />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Nome Banco</strong>
                                <input class="form-control mt-1 input-add" type="email" placeholder="Nome do Banco" name="nome_banco" />
                            </div>
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