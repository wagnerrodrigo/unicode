@extends('layouts.templates.template')
@section('title', 'Lista Instituição Financeira')

@section('content')

    <div id="main" style="margin-top: 5px;">
        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1>Lista Instituições Financeira</h1>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                        <i class="bi bi-plus-circle"></i> Nova Instituição bancária
                    </button>
                </div>
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        @if ($instituicoesAtivas === null || empty($instituicoesAtivas))
                            <tbody>
                                <tr>
                                    <td>Nenhum Instituicao Bancaria Cadastrado</td>
                                </tr>
                            </tbody>
                        @else
                            <thead>
                                    <tr>
                                        <th>Código da Instituicao Bancaria</th>
                                        <th>Numero da Conta</th>
                                        <th>Agencia</th>
                                        <th>Tipo da Conta</th>
                                        <th>Razão Social</th>
                                        <th>Ação</th>
                                    </tr>
                            </thead>
                            <tbody>
                              @foreach ($instituicoesAtivas as $instituicao)
                                <tr>
                                    <td>{{ $instituicao->nome}}</td>
                                    <td>{{ $instituicao->cnpj}}</td>
                                    <td>{{ $instituicao->codigo}}</td>
                                    <td>{{ $instituicao->situacao }}</td>
                                    <td>{{ $instituicao->razao_social }}</td>
                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#delete{{$instituicao->id}}" class="btn btn-danger"
                                            style="padding: 8px 12px;">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        <a href="/instituicoes-financeira/{{$instituicao->id}}" class="btn btn-success" style="padding: 8px 12px;"><i
                                                class="bi bi-eye-fill"></i></a>
                                    </td>
                                </tr>
                            </tbody>



                            <!-- Inicio Modal Delete-->
                            <div class="modal-danger me-1 mb-1 d-inline-block">
                                <!--Danger theme Modal -->
                                <div class="modal fade text-left" id="delete{{ $instituicao->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title white" id="myModalLabel120">EXCLUSÃO</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Deseja realmente excluir a Instituicao Financeira: {{ $instituicao->nome }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Cancelar</span>
                                                </button>
                                                <form action="instituicoes-financeira/delete/{{$instituicao->id}}" method="POST">
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
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>



    <!-- Inicio Modal Adicionar-->
    <div class="me-1 mb-1 d-inline-block">
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
            aria-hidden="true">
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
                        <form action="{{route('instituicoes-financeira')}}" method="POST" style="padding: 10px;">
                            @csrf
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Nome do Banco </strong>
                                    <input class="form-control mt-1 input-add" type="text" placeholder="nome" name="nome" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Cnpj do Banco</strong>
                                    <input class="form-control mt-1 input-add" type="text" placeholder="cnpj" name="cnpj" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Código Banco </strong>
                                    <input class="form-control mt-1 input-add" type="text" placeholder="Código do banco" name="codigo" />
                                </div>
                                <div class="px-5 mb-3">
                                    <strong>Situacao</strong>
                                    <input class="form-control mt-1 input-add" type="text" placeholder="situacao" name="situacao" />
                                </div>
                            </div>
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>Razão Social</strong>
                                        <input class="form-control mt-1 input-add" type="text" placeholder="Razão Social" name="razao_social" />
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Descrição</strong>
                                    <textarea cols="110" rows="5" class="form-control" name="descricao"></textarea>
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
