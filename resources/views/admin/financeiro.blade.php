@extends('layouts.templates.template')
@section('title', 'Financeiro')


@section('content')
<div class="container">
<!-- inicio da linha -->
    <div class="row">
    <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Bancos</h5>
                <p class="card-text">Lista e cadastrar Bancos</p>
            </div>
            <div class="card-footer">
                <a href="{{route('contas-bancarias')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>


        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Centro de custo</h5>
                <p class="card-text">lista e cadastrar centro de custo.</p>
            </div>
            <div class="card-footer">
                <a href="{{route('centro-custos')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>

        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Contas</h5>
                <p class="card-text">Lista e cadastrar Contas</p>
            </div>
            <div class="card-footer">
                <a href="{{route('contas-pagar')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>

        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Despesas</h5>
                <p class="card-text">Lista e cadastrar Despesas</p>
            </div>
            <div class="card-footer">
                <a href="{{route('despesas')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>
       
    </div>

<!-- inicio da linha -->
    <div class="row">



    <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Fornecedores</h5>
                <p class="card-text">Lista e cadastrar fornecedores.</p>
            </div>
            <div class="card-footer">
                <a href="{{route('fornecedores')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>


        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Lançamentos</h5>
                <p class="card-text">Lista e cadastrar Lançamentos</p>
            </div>
            <div class="card-footer">
                <a href="{{route('lancamentos')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>


        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Movimentos</h5>
                <p class="card-text">Lista e cadastrar Movimentos</p>
            </div>
            <div class="card-footer">
                <a href="{{route('movimentos')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>

        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Nota</h5>
                <p class="card-text">Lista e cadastrar Notas</p>
            </div>
            <div class="card-footer">
                <a href="{{route('nota')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>

    </div>



    <div class="row">
    <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Planos de contas</h5>
                <p class="card-text">Lista e cadastrar Planos de Contas </p>
            </div>
            <div class="card-footer">
                <a href="{{route('plano-contas')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>

        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Produtos</h5>
                <p class="card-text">Lista e cadastrar Produtos</p>
            </div>
            <div class="card-footer">
                <a href="{{route('produtos')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>


        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Receitas</h5>
                <p class="card-text">Lista e cadastrar Receitas</p>
            </div>
            <div class="card-footer">
                <a href="{{route('receitas')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>

      
        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">Serviço</h5>
                <p class="card-text">Lista e cadastrar Serviços </p>
            </div>
            <div class="card-footer">
                <a href="{{route('servicos')}}" class="btn btn-primary">acessar</a>
            </div>
        </div>

    </div>
</div>

@endsection