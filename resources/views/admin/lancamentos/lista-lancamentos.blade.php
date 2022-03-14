@extends('layouts.templates.template')
@section('title', 'Lançamento')

@section('content')
<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>LANÇAMENTOS</h1>
            </div>
            <div class="card-body">
                <form action="" method="GET" name="form_busca_lancamento">
                    <div class="d-flex">
                        <div class="col-md-2">
                            <div class="input-group mb-3" style="width: 170px">
                                <label class="input-group-text" for="inputStatus">RESULTADOS</label>
                                <select class="form-select" id="inputStatus" name="results">
                                    <option selected value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" for="inputDataInicio">DATA INICIO</label>
                                <input class="form-control" type="date" max="" name="dt_inicio" id="inputDataInicio">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" for="inputDataFim">DATA FIM</label>
                                <input class="form-control" type="date" min="" name="dt_fim" id="inputDataFim">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="input-group mb-3" style="width: 240px">
                                <label class="input-group-text" for="inputStatus">STATUS</label>
                                <select class="form-select" id="inputStatus" name="status">
                                    <option value="" selected></option>
                                    <option name="a_pagar" value="6">A PAGAR</option>
                                    <option name="em_atraso" value="4">EM ATRASO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary" id="busca_lancamento" style="padding: 8px 12px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>


                <table class='table table-striped' id="table1">
                    <thead>
                        @if( $lancamentos == null || empty($lancamentos))
                    <tbody>
                        <tr>
                            <td>Nenhum Lancamento Cadastrado</td>
                        </tr>
                    </tbody>
                    @else
                    <tr>
                        <th>DESPESA</th>
                        <th>DESCRIÇÃO DESPESA</th>
                        <th>VALOR DA DESPESA</th>
                        <th>DATA VENCIMENTO</th>
                        <th>STATUS</th>
                        <th>AÇÕES</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($lancamentos as $lancamento)
                        <tr class={{$lancamento->de_status_despesa != 'EM ATRASO' ? "font-color-despesa" : "font-color-despesa-vencida"}}>
                            <td>{{$lancamento->id_despesa}}</td>
                            <td>{{$lancamento->de_despesa}}</td>
                            <td>{{$mascara::maskMoeda($lancamento->valor_total_despesa)}}</td>
                            <td>{{date("d/m/Y", strtotime($lancamento->dt_vencimento))}}</td>
                            <td>{{$lancamento->de_status_despesa}}</td>
                            <td>
                                <!-- muda a rota-->
                                <a href="lancamentos/provisionamento/{{$lancamento->id_despesa}}" class="btn btn-success" style="padding: 8px 12px;">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
            </div>
            <div>{{ $filtros ? $lancamentos->appends([ 'results'=> $filtros['resultado_por_pagina'], 'dt_inicio' => $filtros['dt_inicio_periodo'], 'status' => $filtros['status_despesa_id'], 'dt_fim' => $filtros['dt_fim_periodo'] ])->links() : $lancamentos->links() }}</div>
        </div>
    </div>
</div>

<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="{{ asset('assets/js/custom-js/lancamento.js') }}"></script>

<script>
    var inputDataInicio;
    $("#inputDataInicio").on("change", function() {
        inputDataInicio = $(this).val();
        $("#inputDataFim").prop("min", function() {
            return inputDataInicio;
        })
        console.log(inputDataInicio);
    })

    var inputDataFim;
    $("#inputDataFim").on("change", function() {
        inputDataFim = $(this).val();
        $("#inputDataInicio").prop("max", function() {
            return inputDataFim;
        })
        console.log(inputDataFim);
    })

    $("#busca_lancamento").click(function() {
        if (inputDataInicio != '' && inputDataFim == '') {
            console.log("Data Inicio preenchida");
            event.preventDefault();
            swal({
                title: "Atenção",
                text: "Preencha o campo Data Fim!",
                icon: "warning",
                button: "Ok",
            });
        } else if (inputDataInicio == '' && inputDataFim != '') {
            console.log("Data Fim preenchida");
            event.preventDefault();
            swal({
                title: "Atenção",
                text: "Preencha o campo Data Início!",
                icon: "warning",
                button: "Ok",
            });
        }
    });
</script>


@endsection
