@extends('layouts.templates.template')
@section('title', 'Lista Contas Bancárias ')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Lista Contas Bancárias</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#xlarge">
                    <i class="bi bi-plus-circle"></i> Nova conta bancária
                </button>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                @if( $contasAtivas === null || empty($contasAtivas))
                    <tbody>
                        <tr>
                            <td>Nenhuma Conta Bancária Cadastrado</td>
                        </tr>
                    </tbody>
                    @else
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Número Conta</th>
                            <th>Digito Conta</th>
                            <th>Tipo Conta</th>
                            <th>Titular</th>
                            <th>Situação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contasAtivas as $conta)
                        <tr>
                            <td>{{$conta->descricao}}</td>
                            <td>{{$conta->numero_conta}}</td>
                            <td>{{$conta->digito_conta}}</td>
                            <td>{{$conta->tipo_conta}}</td>
                            <td>{{$conta->titular}}</td>
                            <td>{{$conta->situacao}}</td>
                            <td>
                                <!-- muda a rota-->
                                <a class="btn btn-info" style="padding: 8px 12px;"><i class="bi bi-eye-fill"></i></a>
                                <a href="/contas-bancarias/{{$conta->id}}" class="btn btn-success" style="padding: 8px 12px;"><i class="bi bi-eye-fill"></i></a>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$conta->id}}" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></button>
                            </td>

                        </tr>

                        <!-- Inicio Modal Delete-->
                        <div class="modal-danger me-1 mb-1 d-inline-block">
                            <!--Danger theme Modal -->
                            <div class="modal fade text-left" id="delete{{$conta->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title white" id="myModalLabel120">EXCLUSÃO</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja realmente excluir a CONTA BANCÁRIA: {{$conta->numero_conta}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Cancelar</span>
                                            </button>
                                            <form action="/contas-bancarias/delete/{{$conta->id}}" method="POST">
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
                        @endforeach
                    </tbody>
                    @endif
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
                    <h4 class="modal-title" id="myModalLabel16">Nova conta bancária</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- muda a rota-->
                    <form action="/contas-bancarias" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Número Conta</strong>
                                <input class="form-control mt-1 input-add" type="text" placeholder="numero_conta" name="numero_conta" />
                            </div>

                            <div class="px-5 mb-3">
                                <div>
                                    <strong>Digito Conta</strong>
                                    <input class="form-control mt-1 input-add" type="text" placeholder="Digito" name="digito_conta" />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Tipo Conta</strong>
                                <input class="form-control mt-1 input-add" type="text" placeholder="Tipo Conta" name="tipo_conta" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Instuição Bancária</strong>
                                <input class="form-control mt-1 input-add" type="text" placeholder="Instuição Bancária" name="instituicao_bancaria" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Titular</strong>
                                <input class="form-control mt-1 input-add" type="text" placeholder="Nome do Titular" name="titular" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Agência</strong>
                                <input class="form-control mt-1 input-add" type="text" placeholder="Agência" name="agencia" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Situação</strong>
                                <input class="form-control mt-1 input-add" type="text" placeholder="Situação" name="situacao" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Descrição</strong>
                                <input class="form-control mt-1 input-add" type="text" placeholder="Descrição" name="descricao" />
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