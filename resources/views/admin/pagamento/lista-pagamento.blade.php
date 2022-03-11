@extends('layouts.templates.template')
@section('title', 'Pagamento')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>DESPESAS PAGAS</h1>
            </div>
            <div class="card-body">
                <form action="" method="GET">
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

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary" style="padding: 8px 12px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <table class='table table-striped' id="table1">
                    <thead>
                        @if( $pagamentos == null || empty($pagamentos))
                    <tbody>
                        <tr>
                            <td>Nenhum Fornecedor Cadastrado</td>
                        </tr>
                    </tbody>
                    @else
                    <tr>
                        <th>NÚMERO DA DESPESA</th>
                        <th>VALOR DA DEPESA</th>
                        <th>VALOR PAGO</th>
                        <th>STATUS</th>
                        <th>DATA DO PAGAMENTO</th>
                        <th></th>
                        <th>AÇÕES</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($pagamentos as $pagamento)
                        <tr>
                            <td>{{$pagamento->id_despesa}}</td>
                            <td>{{$mascara::maskMoeda($pagamento->valor_total_despesa)}}</td>
                            <td>{{$mascara::maskMoeda($pagamento->valor_pago)}}</td>
                            <td>{{$pagamento->de_status_despesa}}</td>
                            <td>{{date("d/m/Y", strtotime($pagamento->dt_efetivo_pagamento))}}</td>
                            <td></td>
                            <td>
                                <!-- muda a rota-->
                                <a href="/pagamentos/{{$pagamento->id_pagamento}}" class="btn btn-primary" style="padding: 8px 12px;">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
                {{ $filtros ? $pagamentos->appends([ 'results'=> $filtros['resultado_por_pagina'], 'dt_inicio' => $filtros['dt_inicio_periodo'], 'status' => $filtros['status_despesa_id'], 'dt_fim' => $filtros['dt_fim_periodo'] ])->links() : $pagamentos->links() }}
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>


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
</script>
@endsection
