@extends('layouts.templates.template')
@section('title', 'Serviço')


@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>{{$servicos->nome}}</h1>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Serviço</th>
                            <th>Nome Genérico</th>
                            <th>Tipo</th>
                            <th>Forma do Produto</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$servicos->id}}</td>
                            <td>{{$servicos->nome}}</td>
                            <td>{{$servicos->nome_generico}}</td>
                            <td>{{$servicos->tipo}}</td>
                            <td>{{$servicos->forma_servico}}</td>

                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="card-footer">
                <form class="btn btn-success" href="/delete/servico/{{$servicos->id}}" style="padding: 8px 12px;">
                    <select hidden name="data_fim">
                        <option selected value="Date();"></option>
                    </select>
                    <button><i class="bi bi-pensil"></i></button>

                </form>
                <a href="servicos/{{$servicos->id}}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
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
                    <h4 class="modal-title" id="myModalLabel16">Novo Serviço</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- mudar para produto  -->
                    <form action="{{route('servicos')}}" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Servico</strong>
                                <input class="form-control mt-1" type="text" placeholder="serviço" name="nome" style="width: 358px" />
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
                                <select class="form-control" name="tipo" id="tipo_servico" style="width: 358px">
                                    <option selected value="Tipo 1">Tipo 1</option>
                                    <option value="Tipo 2">Tipo 2</option>
                                    <option value="Tipo 3">Tipo 3</option>
                                </select>
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Forma Servico</strong>
                                <div>
                                    <input value="generico" type="radio" name="forma_servico" checked />
                                    <label for="generico">Genérico</label>
                                </div>
                                <div>
                                    <input value="individual" type="radio" name="forma_servico" />
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
                        <a href="{{route('servicos')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
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