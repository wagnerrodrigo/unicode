@extends('layouts.templates.template')
@section('title', 'Lista Politicas')

@section('content')


    <div id="main" style="margin-top: 5px;">
        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1>POLITICAS DA EMPRESA</h1>
                </div>
                <div class="card-header">
                    <a href="/politicas/adicionar" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> NOVA POLITICA
                    </a>
                </div>

                <br>

                <form class="col-md-10">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <div class="col-md-3" style="display: inline-block">
                        <div class="input-group mb-3" style="width: 250px">
                            <label class="input-group-text" for="inputDataInicio">DATA INICIO</label>
                            <input class="form-control" value="{{ $dt_inicio ?? '' }}" type="date" max=""
                                name="dt_inicio" id="inputDataInicio">
                        </div>
                    </div>

                    <div class="col-md-3" style="display: inline-block">
                        <div class="input-group mb-3" style="width: 250px">
                            <label class="input-group-text" for="inputDataFim">DATA FIM</label>
                            <input class="form-control" value="{{ $dt_fim ?? '' }}" type="date" min=""
                                name="dt_fim" id="inputDataFim">
                        </div>
                    </div>

                    <div class="col-md-3" style="display: inline-block">
                        <input class="form-control me-2" type="search" placeholder="Buscar REMETENTE ou POLITICA"
                            aria-label="Search">
                    </div>

                    <div class="col-md-2" style="display: inline-block">
                        <div class="input-group mb-3" style="width: 250px">
                            <button class="btn btn btn-primary" type="submit">Buscar</button>
                        </div>
                    </div>

                </form>


                <br>
                <table class="table table-striped table-hover">
                    <tr>
                        <th>ID</th>
                        <th>REMETENTE</th>
                        <th>TITULO</th>
                        <th>DATA</th>
                        <th>AÇÕES</th>
                    </tr>

                    <tbody>
                        @foreach ($politicas as $politica)
                            <tr>
                                <td>{{ $politica->id_politica }}</td>
                                <td>{{ $politica->remetente }}</td>
                                <td>{{ Str::limit($politica->titulo_politica, 30) }}</td>
                                <td>{{ date('d/m/Y', strtotime($politica->data_cadastro)) }}</td>
                                <td>
                                    <a href="#exampleModal3{{ $politica->id_politica }}" data-bs-toggle="modal" data-bs-target="#exampleModal3{{ $politica->id_politica }}"
                                        class="btn btn-outline-primary"
                                        style="padding-left: 15px ; padding-right:15px ; margin-right: 5px;"><i
                                            class="bi bi-pencil"></i></a>

                                    <a href="#exampleModal" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        class="btn btn-outline-primary"
                                        style="padding-left: 15px ; padding-right:15px ; margin-right: 5px;"><i
                                            class="bi bi-trash"></i></a>
                                </td>
                            </tr>



                            <!-- Modal Visualizar-->
                            <form class="login100-form validate-form" method="POST"
                                action="">
                                @csrf
                                <div class="modal fade" id="exampleModal3{{ $politica->id_politica }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel3{{ $politica->id_politica }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Visualizar / Editar
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                politica:
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="politica" maxlength="3000" placeholder="Leave a comment here"
                                                        id="floatingTextarea2" style="height: 100px" require>{{ $politica->politica }}</textarea>
                                                    
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Salvar</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </tbody>




            </div>

            </table>
            <div class="d-flex p-2 bd-highlight" style="width: 10%; margin-left: auto; margin-right: auto; ">
                {!! $politicas->appends(['data' => $data, 'busca' => $busca])->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
    </div>



@endsection
