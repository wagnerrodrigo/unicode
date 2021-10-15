@extends('layouts.templates.template')
@section('title', 'Plano de contas')

@section('content')
<div class="container d-flex flex-column" style="align-items: center; justify-content: space-evenly; padding:20px;">
    <div class="card">
        <div class="card-header" style="padding: 10px">
            <div style="padding:10px">
                <h1>
                    Cadastro Plano de Contas
                </h1>

            </div>
        </div>
        <div class="card-body">
                    <!--Colocar a rota-->
            <form action="" method="POST" style="padding: 10px;">
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
                            <input class="form-control mt-1" type="text" placeholder="CNPJ" name="cnpj" style="width: 358px" />
                        </div>
                    </div>
                </div>

                <div class="d-flex" style="width: 100%">
                    <div class="px-5 mb-3">
                        <strong>Telefone</strong>
                        <input class="form-control mt-1" type="text" placeholder="Telefone" name="telefone" style="width: 358px" />
                    </div>


                    <div class="px-5 mb-3">
                        <strong>Email</strong>
                        <input class="form-control mt-1" type="email" placeholder="E-mail" name="email" style="width: 358px" />
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
                    <button type="submit" class="btn btn-primary me-1 mb-1">
                        <i data-feather="check-circle"></i>Adicionar
                    </button>
                    <!--Colocar a rota-->
                    <a href="" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection