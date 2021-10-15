@extends('layouts.templates.template')
@section('title', 'Fornecedor')

@section('content')
<div class="container d-flex flex-column" style="align-items: center; justify-content: space-evenly; padding:20px;">
    <div class="card">
        <div class="card-header" style="padding: 10px">
            <div style="padding:10px">
                <h1>
                    Fornecedor 1
                </h1>

            </div>
        </div>
        <div class="card-body">

            <form action="{{route('fornecedores')}}" method="POST" style="padding: 10px;">
                @csrf
                <div class="d-flex mt-10" style="width: 100%">
                    <div class="px-5 mb-3">
                        <strong>Nome</strong>
                        <div class="form-control mt-1" style="width: 358px">Teste</div>
                    </div>

                    <div class="px-5 mb-3">
                        <div>
                            <strong>CNPJ</strong>
                        </div>
                        <div>
                            <div class="form-control mt-1" style="width: 358px">Teste</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex" style="width: 100%">
                    <div class="px-5 mb-3">
                        <strong>Telefone</strong>
                        <div class="form-control mt-1" style="width: 358px">Teste</div>
                    </div>


                    <div class="px-5 mb-3">
                        <strong>Email</strong>
                        <div class="form-control mt-1" style="width: 358px">Teste</div>
                    </div>
                </div>

                <div class="d-flex" style="width: 100%">
                    <div class="px-5 mb-3">
                        <strong>Inscrição Estadual</strong>
                        <div class="form-control mt-1" style="width: 358px">Teste</div>
                    </div>

                    <div class="px-5 mb-3">
                        <strong>Ramo Atuacao</strong>
                        <div class="form-control mt-1" style="width: 358px">Teste</div>
                    </div>
                </div>

                <div class="d-flex" style="width: 100%">
                    <div class="px-5 mb-3">
                        <strong>Ponto Contato</strong>
                        <div class="form-control mt-1" style="width: 358px">Teste</div>
                    </div>

                    <div class="px-5 mb-3">
                        <strong>Cargo Funcao</strong>
                        <div class="form-control mt-1" style="width: 358px">Teste</div>
                    </div>


                </div>
                <div class="col-sm-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1">
                        <i data-feather="check-circle"></i>Adicionar
                    </button>
                    <a href="{{route('fornecedores')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection