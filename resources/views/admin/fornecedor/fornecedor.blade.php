@extends('layouts.templates.template')
@section('title', "Fornecedor")


@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>{{$fornecedor->nome_fantasia}}</h1>
            </div>
            <div class="card-body" style="font-size: 18px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>Nome Fantasia</strong>
                                </div>
                                <span>{{$fornecedor->nome_fantasia}}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <strong for="raz_social">Razão Social</strong>
                                </div>
                                <span>{{$fornecedor->razao_social}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>Inscrição estadual</strong>
                                </div>
                                <span>{{$fornecedor->inscricao_estadual}}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <strong>CNPJ/CPF</strong>
                                </div>
                                <span>{{$fornecedor->cnpj}}</span>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>Tipo Pessoa</strong>
                                </div>
                                <span>{{$fornecedor->tipo_pessoa}}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <strong>Telefone</strong>
                                </div>
                                <span>{{$fornecedor->telefone}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>Email</strong>
                                </div>
                                <span>{{$fornecedor->email}}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <strong>Email Secundário</strong>
                                </div>
                                <span>{{$fornecedor->email_secundario}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>Ponto Contato</strong>
                                </div>
                                <span>{{$fornecedor->ponto_contato}}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <strong>Cargo Função</strong>
                                </div>
                                <span>{{$fornecedor->cargo_funcao}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <strong>Ramo Atuação</strong>
                                </div>
                                <span>{{$fornecedor->ramo_atuacao}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#xlarge">Editar</button>
                    <a href="{{route('fornecedores')}}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
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
                        <h4 class="modal-title" id="myModalLabel16">Editar Fornecedor</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- mudar para produto  -->
                        <form action="/fornecedores/editar/{{$fornecedor->id}}" method="POST" style="padding: 10px;">
                            @csrf
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Nome Fantasia</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Nome" value="{{$fornecedor->nome_fantasia}}" name="nome_fantasia" style="width: 358px" />
                                </div>
                                <div class="px-5 mb-3">
                                    <strong>Razão Social</strong>
                                    <input class="form-control mt-1" type="text" value="{{$fornecedor->razao_social}}" placeholder="Razão Social" name="razao_social" style="width: 358px" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Inscrição Estadual</strong>
                                    <input class="form-control mt-1" type="text" value="{{$fornecedor->inscricao_estadual}}" placeholder="Incrição estadual" name="inscricao_estadual" style="width: 358px" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Telefone</strong>
                                    <input class="form-control mt-1" type="text" value="{{$fornecedor->telefone}}" placeholder="Telefone" name="telefone" style="width: 358px" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Tipo Pessoa</strong>
                                    <select class="form-control" name="tipo_pessoa" id="tipo_pessoa">
                                        @if($fornecedor->tipo_pessoa == 'fisica')
                                        <option value="fisica" selected>Física</option>
                                        <option value="juridica">Jurídica</option>
                                        @else
                                        <option value="fisica">Física</option>
                                        <option value="juridica" selected>Jurídica</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Email</strong>
                                    <input class="form-control mt-1" type="email" value="{{$fornecedor->email}}" placeholder="E-mail" name="email" style="width: 358px" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Email Secundário(Opcional)</strong>
                                    <input class="form-control mt-1" type="email" value="{{$fornecedor->email_secundario}}" placeholder="E-mail" name="email_secundario" style="width: 358px" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Ponto Contato</strong>
                                    <input class="form-control mt-1" type="text" value="{{$fornecedor->ponto_contato}}" placeholder="Ponto contato" name="ponto_contato" style="width: 358px" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Cargo Funcao</strong>
                                    <input class="form-control mt-1" type="text" value="{{$fornecedor->cargo_funcao}}" placeholder="Cargo Função" name="cargo_funcao" style="width: 358px" />
                                </div>

                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Ramo Atuacao</strong>
                                    <input class="form-control mt-1" type="text" value="{{$fornecedor->ramo_atuacao}}" placeholder="Ramo atuação" name="ramo_atuacao" style="width: 358px" />
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">
                                <i data-feather="check-circle"></i>Salvar
                            </button>
                            <!-- mudar para produto -->
                            <a href="{{route('fornecedores')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
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