@extends('layouts.templates.template')
@section('title', 'Lista Fornecedores')

@section('content')

@if($fornecedores == [''] || $fornecedores == null)
    <div id="main" style="margin-top: 5px;">
        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1>Lista Fornecedores</h1>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                        <i class="bi bi-plus-circle"></i> Novo Fornecedor
                    </button>
                </div>
            </div>
        </div>
    </div>
@else
<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Lista Fornecedores</h1>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                    <i class="bi bi-plus-circle"></i> Novo Fornecedor
                </button>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF/CNPJ</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fornecedores as $fornecedor)
                        <tr>
                            <td>{{$fornecedor->nome}}</td>
                            <td>{{$fornecedor->cnpj}}</td>
                            <td>{{$fornecedor->email}}</td>
                            <td>{{$fornecedor->telefone}}</td>
                            <td>
                                <form method="GET" action="/fornecedores/{{$fornecedor->id}}" data-bs-toggle="modal" data-bs-target="#xlarge-view" class="btn btn-primary" style="padding: 8px 12px;">
                                    @csrf
                                    <i class="bi bi-eye-fill"></i>
                                </form>
                                <a href="{{route('cadastro-fornecedores')}}" class="btn btn-danger" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Inicio Modal Adicionar-->
<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Novo Fornecedor</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('fornecedores')}}" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Nome</strong>
                                <input class="form-control mt-1" type="text" placeholder="Nome" name="nome" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <div>
                                    <strong>CPF/CNPJ</strong>
                                </div>
                                <div>
                                    <input class="form-control mt-1" type="text" placeholder="CPF/CNPJ" name="cnpj" style="width: 358px" />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Email</strong>
                                <input class="form-control mt-1" type="email" placeholder="E-mail" name="email" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Email Secundário(Opcional)</strong>
                                <input class="form-control mt-1" type="email" placeholder="E-mail" name="email_secundario" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Inscrição Estadual</strong>
                                <input class="form-control mt-1" type="text" placeholder="Incrição estadual" name="inscricao_estadual" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Telefone</strong>
                                <input class="form-control mt-1" type="text" placeholder="Telefone" name="telefone" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Ponto Contato</strong>
                                <input class="form-control mt-1" type="text" placeholder="Ponto contato" name="ponto_contato" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Cargo Funcao</strong>
                                <input class="form-control mt-1" type="text" placeholder="Cargo Função" name="cargo_funcao" style="width: 358px" />
                            </div>

                        </div>

                        <div class="d-flex" style="width: 100%">

                            <div class="px-5 mb-3">
                                <strong>Ramo Atuacao</strong>
                                <input class="form-control mt-1" type="text" placeholder="Ramo atuação" name="ramo_atuacao" style="width: 358px" />
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        <a href="{{route('fornecedores')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar -->

<!-- Inicio modal view -->
<div class="me-1 mb-1 d-inline-block">
    <!-- Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xlarge-view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Fornecedor</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="d-flex mt-10" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>Nome</strong>
                            <span>{{$fornecedor->nome}}</span>
                        </div>

                        <div class="px-5 mb-3">
                            <div>
                                <strong>CPF/CNPJ</strong>
                                <span>{{$fornecedor->cnpj}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mt-10" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>E-mail</strong>
                            <span>{{$fornecedor->email}}</span>
                        </div>

                        <div class="px-5 mb-3">
                            <div>
                                <strong>Telefone</strong>
                                <span>{{$fornecedor->telefone}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>Inscrição Estadual</strong>
                            <span>{{$fornecedor->inscricao_estadual}}</span>
                        </div>

                        <div class="px-5 mb-3">
                            <strong>Telefone</strong>
                            <span>{{$fornecedor->telefone}}</span>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>Ponto Contato</strong>
                            <span>{{$fornecedor->ponto_contato}}</span>
                        </div>

                        <div class="px-5 mb-3">
                            <strong>Cargo Funcao</strong>
                            <span>{{$fornecedor->cargo_funcao}}</span>
                        </div>

                    </div>

                    <div class="d-flex" style="width: 100%">

                        <div class="px-5 mb-3">
                            <strong>Ramo Atuacao</strong>
                            <span>{{$fornecedor->ramo_atuacao}}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning me-1 mb-1">
                            <i data-feather="check-circle"></i>Editar
                        </button>
                        <button type="button" class="close btn btn-secondary me-1 mb-1" data-bs-dismiss="modal" aria-label="Close">
                            <span>Cancelar</span>
                        </button>
                    </div>
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