@extends('layouts.templates.template')
@section('title', 'Lista Fornecedores')

@section('content')
<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>LISTA FORNECEDORES</h1>
                <a href="fornecedores/adicionar" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> NOVO FORNECEDOR
                </a>

                <!-- Form de filtro por status -->
                <div style="margin-top: 10px">
                    <form name="form_status">
                        <div class="d-flex">
                            <div class="col-md-3">
                                <div class="input-group mb-3" style="width: 250px">
                                    <label class="input-group-text" for="inputStatus">RESULTADOS</label>
                                    <select class="form-select" id="inputStatus" name="results">
                                        <option name="results" selected value="10">10</option>
                                        <option name="results" value="15">15</option>
                                        <option name="results" value="20">20</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group mb-3" style="width: 350px">
                                    <label class="input-group-text" for="inputStatus">FILTRO</label>
                                    <select class="form-select" id="inputBusca" name="chave_busca_fornecedor">
                                        <option selected value=""></option>
                                        <option value="de_razao_social">RAZÃO SOCIAL</option>
                                        <option value="nu_cpf_cnpj">CPF/CNPJ</option>
                                    </select>
                                    <input type="text" class="busca_despesa" id="valor_busca_fornecedor" name="valor_busca_fornecedor">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary" style="padding: 8px 12px;">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    @if( $fornecedores === null || empty($fornecedores))
                    <tbody>
                        <tr>
                            <td>NENHUM FORNECEDOR CADASTRADO</td>
                        </tr>
                    </tbody>
                    @else
                    <thead>
                        <tr>
                            <th>RAZÃO SOCIAL</th>
                            <th>CPF/CNPJ</th>
                            <th>INSCRIÇÃO ESTADUAL</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($fornecedores as $fornecedor)
                        <tr>
                            <td>{{strtoupper($fornecedor->de_razao_social)}}</td>
                            <td>
                                {{strlen($fornecedor->nu_cpf_cnpj) == 14
                                ? $mascara::mask($fornecedor->nu_cpf_cnpj, '##.###.###/####-##')
                                : $mascara::mask($fornecedor->nu_cpf_cnpj, '###.###.###-##')}}
                            </td>
                            <td>{{$fornecedor->inscricao_estadual}}</td>
                            <td>
                                <a href="fornecedores/{{$fornecedor->id_fornecedor}}" class="btn btn-primary" style="padding: 8px 12px;"><i class="bi bi-eye-fill"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#delete{{$fornecedor->id_fornecedor}}" class="btn btn-danger" style="padding: 8px 12px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Inicio Modal Delete-->
                        <div class="modal-danger me-1 mb-1 d-inline-block">
                            <!--Danger theme Modal -->
                            <div class="modal fade text-left" id="delete{{$fornecedor->id_fornecedor}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title white" id="myModalLabel120">EXCLUSÃO</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja realmente excluir o fornecedor {{$fornecedor->de_razao_social}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Cancelar</span>
                                            </button>
                                            <form action="fornecedores/delete/{{$fornecedor->id_fornecedor}}" method="POST">
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
                {{$fornecedores->links();}}
            </div>
        </div>
    </div>
</div>

<!-- <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/vendors.js"></script> -->

<script src="assets/js/main.js"></script>

@endsection
