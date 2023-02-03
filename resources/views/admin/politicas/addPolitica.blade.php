@extends('layouts.templates.template')
@section('title', 'Adicionar Politica')

@section('content')

    <div id="main" style="margin-top: 5px;">
        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1>CADASTRAR NOVA POLITICA</h1>
                </div>
                <div class="card-body d-flex flex-column">

                    <center>
                        <form class="row g-4" action="/politicas/adicionar/salvar" style="width: 90%;" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-6">
                                <strong>NOME REMETENTE</strong>
                                <input type="hidden" name="nome" value="{{ @SESSION('name') }}">
                                <input type="text" required class="form-control" id="nome_usuario"
                                    value="{{ @SESSION('name') }}" disabled="disabled" required>
                            </div>

                            <hr>

                            <div class="col-md-6">
                                <strong>TITULO</strong>
                                <input type="text" required class="form-control" id="nome_usuario" name="titulo" required>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" name="politica" maxlength="3000" placeholder="Leave a comment here"
                                    id="floatingTextarea2" style="height: 100px" require></textarea>
                                <label for="floatingTextarea2">Politica</label>
                            </div>

                            <hr>

                            <div class="d-flex" id="btnDespesa" style="width: 100%; align-items:center">
                                <div class="px-5 mb-3">
                                    <h3>Anexar Documento (Opcional)</h3>
                                    <input type="file" id="img" name="salvarImagem" accept="image/png, image/jpeg">
                                </div>
                            </div>

                            <br> <br>
                            <center>
                                <div class="col-4" style="display: inline-block;">
                                    <button type="submit" class="btn btn-primary">Salvar Politica</button>

                                    <a href="{{ route('homePoliticas') }}">
                                        <button class="btn btn-success">
                                            <font color="blue">Cancelar</font>
                                        </button>
                                    </a>
                                </div>
                            </center>
                        </form>

                    </center>


                </div>
            </div>
        </div>


    @endsection
