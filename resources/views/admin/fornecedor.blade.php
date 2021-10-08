@extends('layouts.templates.template')
@section('title', 'Fornecedor')
@include('../layouts/__partials/header')

@section('content')
<div class="container d-flex flex-column" style="align-items: center; justify-content: space-evenly; padding:20px;">
<div class="card">
    <div class="card-header" style="padding: 10px">
    <div style="padding:10px">
        <h1>
            Cadastro Fornecedores
        </h1>

    </div>

    <form action="{{route('fornecedores')}}" method="POST" style="border: 1px solid #D3D3D3; border-radius:5px; padding: 10px;">
        @csrf
        <div class="d-flex mt-10" style="width: 100%">
            <div class="px-5 mb-3">
                <strong>Nome</strong>
                <input class="form-control mt-1" type="text" placeholder="Nome" name="nome" style="width: 358px" />
            </div>

            <div class="px-5 mb-3">
                <div>
                    <strong>CNPJ</strong>
                </div>
                <div>
                    <input class="form-control mt-1" type="text" placeholder="cnpj" name="cnpj" style="width: 358px" />
                </div>
            </div>
        </div>

        <div class="d-flex" style="width: 100%">
            <div class="px-5 mb-3">
                <strong>Telefone</strong>
                <input class="form-control mt-1" type="text" placeholder="telefone" name="telefone" style="width: 358px" />
            </div>


            <div class="px-5 mb-3">
                <strong>Email</strong>
                <input class="form-control mt-1" type="email" placeholder="email" name="email" style="width: 358px" />
            </div>
        </div>

        <div class="d-flex" style="width: 100%">
            <div class="px-5 mb-3">
                <strong>Inscrição Estadual</strong>
                <input class="form-control mt-1" type="text" placeholder="Incrição estadual" name="inscricao_estadual" style="width: 358px" />
            </div>

            <div class="px-5 mb-3">
                <strong>Ramo Atuacao</strong>
                <input class="form-control mt-1" type="text" placeholder="Ramo atuação" name="ramo_atuacao" style="width: 358px" />
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
        <div class="col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-1 mb-1">
                    <i data-feather="check-circle"></i>Adicionar
                </button>
                <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
            </div>
    </form>
    </div>
    </div>
</div>
@endsection