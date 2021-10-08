@extends('layouts.templates.template-login')
@section('title', 'Unicode - Login')
@section('content')

<div id="auth">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 mx-auto">
                <div class="card pt-4">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <img src="{{asset('img/logo-login-sistema.png')}}" height="48" class='mb-4'>
                            <h1>Intranet</h1>
                            <h3>Entrar</h3>
                        </div>
                        <form action="{{route('autenticacao')}}" method="POST">
                            @csrf
                            <div class="form-group position-relative has-icon-left">
                                <label for="username">CPF</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" id="cpf" name="cpf">
                                    <div class="form-control-icon">
                                        <i data-feather="user"></i>
                                    </div>
                                </div>
                                <span class="error">{{$errors->has('cpf') ? $errors->first('cpf') : ''}}</span>
                            </div>
                            <div class="form-group position-relative has-icon-left">
                                <div class="clearfix">
                                    <label for="password">Senha</label>
                                    <a href="{{route('forgot')}}" class='float-end'>
                                        <small>Esqueceu a senha?</small>
                                    </a>
                                </div>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                    <span class="error">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                                </div>
                            </div>

                            <div class='form-check clearfix my-4'>
                                <div class="checkbox float-start">
                                    <input type="checkbox" id="checkbox1" class='form-check-input'>
                                    <label for="checkbox1">Lembrar-me</label>
                                </div>
                            </div>
                            <div class="clearfix">
                                <button class="btn btn-primary float-end">Entrar</button>
                            </div>
                        </form>
                        <span class="error">{{isset($error) && $error != '' ? $error : ''}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="{{asset('assets/js/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>

<script src="{{asset('assets/js/main.js')}}"></script>


@endsection
