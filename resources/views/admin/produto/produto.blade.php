@extends('layouts.templates.template')
@section('title', "produto")


@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>{{$produto->nome}}</h1>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{$produto->nome}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" disabled>{{$produto->nome_generico}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="valor">Tipo</label>
                                <input type="text" class="form-control" id="valor" name="valor" value="{{$produto->tipo}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="valor">Forma Serviço</label>
                                <input type="text" class="form-control" id="categoria" name="categoria" value="{{$produto->forma_produto}}" disabled>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button class="btn btn-info" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#xlarge">Editar</button>
                    <a href="{{route('produtos')}}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
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
                        <h4 class="modal-title" id="myModalLabel16">Novo Porduto</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- mudar para produto  -->
                        <form action="/produtos/editar/{{$produto->id}}" method="POST" style="padding: 10px;">
                            @csrf
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Produto </strong>
                                    <input class="form-control mt-1" value="{{$produto->nome}}" type="text" placeholder="produto" name="nome" style="width: 358px" />
                                </div>

                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>Nome Genérico</strong>
                                    </div>
                                    <div>
                                        <input class="form-control mt-1" value="{{$produto->nome_generico}}" type="text" placeholder="Nome" name="nome_generico" style="width: 358px" />
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Tipo</strong>
                                    <select class="form-control" name="tipo" id="tipo_produto" style="width: 358px">
                                        <option selected value="Tipo 1">Tipo 1</option>
                                        <option value="{{$produto->nome}}">{{$produto->nome}}</option>
                                        <option value="Tipo 2">Tipo 2</option>
                                        <option value="Tipo 3">Tipo 3</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Forma Servico</strong>
                                    @if($produto->forma_produto === 'generico')
                                    <div>
                                        <input value="{{$produto->nome}}" type="radio" name="forma_produto" checked />
                                        <label for="generico">Genérico</label>
                                    </div>
                                    <div>
                                        <input value="individual" type="radio" name="forma_produto" />
                                        <label for="individual">Individual</label>
                                    </div>
                                    @else
                                    <div>
                                        <input value="generico" type="radio" name="forma_produto" />
                                        <label for="generico">Genérico</label>
                                    </div>
                                    <div>
                                        <input value="{{$produto->nome}}" type="radio" checked name="forma_produto" />
                                        <label for="individual">Individual</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1" >
                                <i data-feather="check-circle"></i>Salvar
                            </button>
                            <!-- mudar para produto -->
                            <a href="{{route('produtos')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
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