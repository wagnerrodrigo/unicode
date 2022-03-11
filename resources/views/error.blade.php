@extends('layouts.templates.template')
@section('title', 'Erro!!')

@section('content')
<div id="center" style="margin-top: 5px;">
    <div style="padding: 30px;">
        <a class="btn btn-primary" href="{{url()->previous()}}">VOLTAR</a>
    </div>
    <div class="d-flex justify-content-center">
        <h1 class="align-items-center">ERRO: {{$error}}</h1>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
