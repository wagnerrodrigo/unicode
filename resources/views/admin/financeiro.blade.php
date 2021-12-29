@extends('layouts.templates.template')
@section('title', 'Financeiro')


@section('content')
<div class="container">
    <!-- inicio da linha -->
    <div class="row">
        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">DESPESAS</h5>
                <p class="card-text">LISTAR E CADASTRAR DESPESAS</p>
            </div>

            <div class="card-footer">
                <a href="{{route('despesas')}}" class="btn btn-primary">ACESSAR</a>
            </div>
        </div>

        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">FORNECEDORES</h5>
                <p class="card-text">LISTAR E CADASTRAR FORNECEDORES</p>
            </div>

            <div class="card-footer">
                <a href="{{route('despesas')}}" class="btn btn-primary">ACESSAR</a>
            </div>
        </div>

        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">LANÇAMENTOS</h5>
                <p class="card-text">LISTAR E CADASTRAR LANÇAMENTOS</p>
            </div>
            <div class="card-footer">
                <a href="{{route('lancamentos')}}" class="btn btn-primary">ACESSAR</a>
            </div>
        </div>

        <div class="card" style="width: 18rem; align-items: center; text-align: center; padding: 30px; margin: 20px;">
            <div class="card-body">
                <h5 class="card-title">PAGAMENTOS</h5>
                <p class="card-text">LISTAR E CADASTRAR PAGAMENTOS</p>
            </div>

            <div class="card-footer">
                <a href="{{route('despesas')}}" class="btn btn-primary">ACESSAR</a>
            </div>
        </div>
    </div>
</div>

@endsection