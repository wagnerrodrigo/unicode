@extends('layouts.templates.template-login')
@section('title', 'ACESYSTEM - LOGIN')
@section('content')

<div id="auth" style="background-color: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 mx-auto">
                <div class="card pt-4" style="background-color: #000921">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <img src="{{asset('img/ACE-sem-fundo.png')}}" height="98" class='mb-4'>
                            <h3 style="color: white">Entrar</h3>
                        </div>
                        <form action="{{route('autenticacao')}}" method="POST">
                            @csrf
                            <div class="form-group position-relative has-icon-left">
                                <label for="username" style="color:white">Login</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" id="login" name="login">
                                    <div class="form-control-icon">
                                        <i data-feather="user"></i>
                                    </div>
                                </div>
                                <span class="error">{{$errors->has('login') ? $errors->first('login') : ''}}</span>
                            </div>
                            <div class="form-group position-relative has-icon-left">
                                <div class="clearfix">
                                    <label for="password" style="color:white">Senha</label>
                                </div>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <a href="{{route('forgot')}}" class='float-end'>
                                        <small style="color:white">Esqueceu a senha?</small>
                                    </a>
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                    <span class="error">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                                </div>
                            </div>

                            <div class='form-check clearfix my-4'>
                                <div class="checkbox float-start">
                                    <input type="checkbox" id="checkbox1" class='form-check-input'>
                                    <label for="checkbox1" style="color:white">Lembrar-me</label>
                                </div>
                            </div>
                            <div class="clearfix">
                                <button class="btn btn-secondary float-end">Entrar</button>
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



