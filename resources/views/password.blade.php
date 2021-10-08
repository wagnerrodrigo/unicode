@extends('layouts.templates.template-login')
@section('title', 'Unicode - Recuperação de Senha')
@section('content')
<div id="auth">

    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 mx-auto">
                <div class="card py-4">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <a href="{{route('autenticacao')}}"><img src="{{asset('img/logo-login-sistema.png')}}" height="48" class='mb-4'></a>
                            <h3>Recuperação de senha</h3>
                            <p>Por favor, insira seu CPF e Email para receber sua nova senha.</p>
                        </div>
                        <form action="{{route('forgot')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="first-name-column">CPF</label>
                                <input type="text" id="first-name-column" class="form-control" name="cpf" id="cpf">
                                <span class="error">{{$errors->has('cpf') ? $errors->first('cpf') : ''}}</span>
                            </div>
                            <div class="form-group">
                                <label for="first-name-column">Email</label>
                                <input type="email" id="first-name-column" class="form-control" name="email" id="email">
                                <span class="error">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                            </div>
                            <span class="error">{{isset($error) && $error != '' ? $error : ''}}</span>
                            <div class="clearfix">
                                <button class="btn btn-primary float-end">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="{{asset('assets/js/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="asset('assets/js/main.js')}}"></script>
