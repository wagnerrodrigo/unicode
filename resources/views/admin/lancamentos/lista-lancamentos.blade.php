@extends('layouts.templates.template')
@section('title', 'Lançamento')

@section('content')
<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Detalhe do lançamento</h1>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="d-flex">
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
                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" for="inputStatus">STATUS</label>
                                <select class="form-select" id="inputStatus" name="status">
                                    <option value="" selected></option>
                                    <option name="a_pagar" value="6">A PAGAR</option>
                                    <option name="cancelado" value="3">CANCELADO</option>
                                    <option name="em_atraso" value="4">EM ATRASO</option>
                                    <option name="migracao" value="5">MIGRAÇÃO</option>
                                    <option name="pago" value="2">PAGO</option>
                                    <option name="provisionado" value="1">PROVISIONADO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary" style="padding: 8px 12px;">
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
                        <th>DATA DO PROVISIONAMENTO</th>
                        <th>DATA VENCIMENTO</th>
                        <th>STATUS</th>
                        <th>AÇÕES</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($lancamentos as $lancamento)
                        <tr>
                            <td>{{$lancamento->id_despesa}}</td>
                            <td>{{$lancamento->de_despesa}}</td>
                            <td>{{$mascara::maskMoeda($lancamento->valor_total_despesa)}}</td>
                            <td>{{date("d/m/Y", strtotime($lancamento->dt_provisionamento))}}</td>
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
            <div>{{ $lancamentos->links() }}</div>
        </div>
    </div>
</div>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/vendors.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="{{ asset('assets/js/custom-js/lancamento.js') }}"></script>



<script>

</script>


@endsection
