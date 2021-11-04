@extends('layouts.templates.template')
@section('title', "Instituição Financeira")


@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>{{$instituicao->nome}}</h1>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{$instituicao->nome}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cnpj">CNPJ</label>
                                <textarea class="form-control" id="cnpj" name="cnpj" disabled>{{$instituicao->cnpj}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" value="{{$instituicao->codigo}}" disabled>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="situacao">Situacao</label>
                                <input type="text" class="form-control" id="situacao" name="situacao" value="{{$instituicao->situacao}}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="razao_social">Razao Social</label>
                                <input type="text" class="form-control" id="razao_social" name="razao_social" value="{{$instituicao->razao_social}}" disabled>
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descricao">Descricao</label>
                                <input type="text" class="form-control" id="descricao" name="descricao" value="{{$instituicao->descricao}}" disabled>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button class="btn btn-success" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#xlarge">Editar</button>
                    <a href="{{route('instituicoes-financeira')}}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
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
                        <form action="/instituicoes-financeira/editar/{{$instituicao->id}}" method="POST" style="padding: 10px;">
                            @csrf
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Nome</strong>
                                    <input type="text" class="form-control mt-1" id="nome" type="text"  placeholder="nome"  name="nome" value="{{$instituicao->nome}}" style="width: 358px" >
                                </div>

                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>CNPJ</strong>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control mt-1" id="cnpj" type="text"  placeholder="cnpj"  name="cnpj" value="{{$instituicao->cnpj}}" style="width: 358px" >
                                    </div>
                                </div>
                            </div>


                             <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Codigo</strong>
                                    <input type="text" class="form-control mt-1" id="codigo" type="text"  placeholder="codigo"  name="codigo" value="{{$instituicao->digito_conta}}" style="width: 358px" >
                                </div>
                            </div>

                            
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Situacao</strong>
                                    <input type="text" class="form-control mt-1" id="situacao" type="text"  placeholder="situacao"  name="situacao" value="{{$instituicao->situacao}}" style="width: 358px" >
                                </div>

                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>Razao Social</strong>
                                    </div>
                                    <div>
                                         <input type="text" class="form-control mt-1" id="razao_social" type="text"  placeholder="razao_social"  name="razao_social" value="{{$instituicao->razao_social}}" style="width: 358px" >
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Descricao </strong>
                                    <textarea cols="110" rows="5" class="form-control" name="descricao" value="{{$instituicao->descricao}}"></textarea>
                                </div>
                             
                            </div>
                    </div>

                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1" >
                                <i data-feather="check-circle"></i>Salvar
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