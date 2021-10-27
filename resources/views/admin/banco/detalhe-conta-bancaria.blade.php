@extends('layouts.templates.template')
@section('title', "Conta bancária")


@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>{{$conta->instituicao_bancaria}}</h1>
            </div>
            <div class="card-body" style="font-size: 18px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>Instituição bancária</strong>
                                </div>
                                <span>{{$conta->instituicao_bancaria}}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <strong for="raz_social">Número Conta</strong>
                                </div>
                                <span>{{$conta->numero_conta}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>Dígito Conta</strong>
                                </div>
                                <span>{{$conta->digito_conta}}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <strong>Agência</strong>
                                </div>
                                <span>{{$conta->agencia}}</span>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>Tipo Conta</strong>
                                </div>
                                <span>{{$conta->tipo_conta}}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <strong>Titular</strong>
                                </div>
                                <span>{{$conta->titular}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>Situação</strong>
                                </div>
                                <span>{{$conta->situacao}}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div>
                                    <strong>Descrição</strong>
                                </div>
                                <span>{{$conta->descricao}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#xlarge">Editar</button>
                    <a href="{{route('contas-bancarias')}}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
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
                        <h4 class="modal-title" id="myModalLabel16">Editar Conta Bancária</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- mudar para produto  -->
                        <form action="/contas-bancarias/editar/{{$conta->id}}" method="POST" style="padding: 10px;">
                            @csrf
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Número Conta</strong>
                                    <input class="form-control mt-1 input-add" type="text" value="{{$conta->numero_conta}}" placeholder="numero_conta" name="numero_conta" />
                                </div>

                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>Digito Conta</strong>
                                        <input class="form-control mt-1 input-add" type="text" value="{{$conta->digito_conta}}" placeholder="Digito" name="digito_conta" />
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Tipo Conta</strong>
                                    <input class="form-control mt-1 input-add" type="text" value="{{$conta->tipo_conta}}" placeholder="Tipo Conta" name="tipo_conta" />
                                </div>
                                <div class="px-5 mb-3">
                                    <strong>Instuição Bancária</strong>
                                    <input class="form-control mt-1 input-add" type="text" value="{{$conta->instituicao_bancaria}}" placeholder="Instuição Bancária" name="instituicao_bancaria" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Titular</strong>
                                    <input class="form-control mt-1 input-add" type="text" value="{{$conta->titular}}" placeholder="Nome do Titular" name="titular" />
                                </div>
                                <div class="px-5 mb-3">
                                    <strong>Agência</strong>
                                    <input class="form-control mt-1 input-add" type="text" value="{{$conta->agencia}}" placeholder="Agência" name="agencia" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Situação</strong>
                                    <input class="form-control mt-1 input-add" type="text" value="{{$conta->situacao}}" placeholder="Situação" name="situacao" />
                                </div>
                                <div class="px-5 mb-3">
                                    <strong>Descrição</strong>
                                    <input class="form-control mt-1 input-add" type="text" value="{{$conta->descricao}}" placeholder="Descrição" name="descricao" />
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">
                                <i data-feather="check-circle"></i>Salvar
                            </button>
                            <!-- mudar para produto -->
                            <a href="{{route('contas-bancarias')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
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