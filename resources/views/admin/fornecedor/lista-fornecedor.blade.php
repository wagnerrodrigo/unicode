@extends('layouts.templates.template')
@section('title', 'Lista Fornecedores')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Lista Fornecedores</h1>
                <a href="fornecedores/adicionar" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Novo Fornecedor
                </a>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    @if( $fornecedoresAtivos === null || empty($fornecedoresAtivos))
                    <tbody>
                        <tr>
                            <td>Nenhum Fornecedor Cadastrado</td>
                        </tr>
                    </tbody>
                    @else
                    <thead>
                        <tr>
                            <th>Razão Social</th>
                            <th>CPF/CNPJ</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($fornecedoresAtivos as $fornecedor)
                        <tr>
                            <td>{{$fornecedor->razao_social}}</td>
                            <td>{{$fornecedor->cnpj}}</td>
                            <td>{{$fornecedor->email}}</td>
                            <td>{{$fornecedor->telefone}}</td>
                            <td>
                                <a href="fornecedores/{{$fornecedor->id}}" class="btn btn-primary" style="padding: 8px 12px;"><i class="bi bi-eye-fill"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#delete{{$fornecedor->id}}" class="btn btn-danger" style="padding: 8px 12px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Inicio Modal Delete-->
                        <div class="modal-danger me-1 mb-1 d-inline-block">
                            <!--Danger theme Modal -->
                            <div class="modal fade text-left" id="delete{{$fornecedor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title white" id="myModalLabel120">EXCLUSÃO</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja realmente excluir o fornecedor {{$fornecedor->razao_social}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Cancelar</span>
                                            </button>
                                            <form action="fornecedores/delete/{{$fornecedor->id}}" method="POST">
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

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>

@endsection