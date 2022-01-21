@extends('layouts.templates.template')
@section('title', 'Extrato')
@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">

        <div class="card">
            <div class="card-header">
                <h1>DESPESA </h1>
            </div>
            <div class="card-body">
                {{-- INICIO DOS CAMPOS DE SELECT --}}
                <form action="{{ route('extrato') }}" method="GET">
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
                            <button type="submit" class="btn btn-primary" style="padding: 8px 12px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                {{-- FIM DOS CAMPOS DE SELECT --}}

                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>ID DESPESA</th>
                            <th>DATA DO VENCIMENTO DESPESA</th>
                            <th>DESCRIÇÃO</th>
                            <th>STATUS</th>
                            <th>AÇÕES</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="d-flex" style="width: 100%;justify-content:start; align-items:center">
                            <div class="px-5 mb-3">
                                <h3>Conciliação</h3>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#xconciliacao">
                                    CONCILIAR
                                </button>
                            </div>
                        </div>
                        @if ($lancamentos != null || !empty($lancamentos))
                        @foreach ($lancamentos as $lancamento)
                        <tr>
                            <td>
                                {{ $lancamento->id_despesa }}
                                <input type="checkbox" name="despesa" value="{{ $lancamento->fk_tab_despesa_id }}" id="">
                            </td>
                            <td>{{date("d/m/Y", strtotime($lancamento->dt_vencimento))}}</td>
                            <td>{{ $lancamento->de_despesa }}</td>
                            <td>{{ $lancamento->de_status_despesa }}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#xlarge-view" class="btn btn-primary" style="padding: 8px 12px;">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </td>

                            <td>
                                <button class="accordion-button custon-btn custon-btn-accordion" type="button" data-bs-toggle="collapse" href="#collapseExample{{ $lancamento->fk_tab_despesa_id }}" role="button" aria-expanded="false" id="" aria-controls="collapseExample" style="width: 25px">
                                </button>
                            </td>
                        </tr>
                        @if ($extratos != null || !empty($extratos))
                        <table class="collapse table table-borderless" id="collapseExample{{ $despesa->id_despesa }}">
                            <tr class="table-dark">
                                <th>ID EXTRATO</th>
                                <th>NOME BANCO</th>
                                <th>NUMERO CONTA</th>
                                <th>DATA FIM</th>
                                <th>VALOR TOTAL</th>
                            </tr>
                            @foreach ($extratos as $extrato)
                            <tr>
                                <td>
                                    {{ $extrato->id_extrato }}
                                    <input type="checkbox" value="{{ $extrato->id_extrato }}" name="" id="">
                                </td>
                                <td>
                                    {{ $extrato->de_banco }}
                                </td>
                                <td>
                                    {{ $extrato->nu_conta }}
                                </td>
                                <td>

                                    {{date("d/m/Y", strtotime($extrato->dtend))}}
                                </td>
                                <td>
                                    {{ $mascara::maskMoeda($extrato->balamt) }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        @endif
                    </tbody>
                    @endforeach
                    @endif
                </table>
                <div>{{ $lancamentos->links() }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Inicio Modal Conciliação-->
<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xconciliacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Conciliação</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <h3>DESPESA N - 1818</h3>
                        </div>
                    </div>
                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>DATA DO EFETIVO PAGAMENTO</strong>
                            <input class="form-control" type="date" autocomplete="off" placeholder="data" style="width: 60rem" />
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>VALOR DESPESA</strong>
                            <input class="form-control" readonly type="text" autocomplete="off" placeholder="VALOR DA DESPESA" style="width: 60rem" />
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>JUROS</strong>
                            <input class="form-control" onkeyup="formataValor(this)" type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" autocomplete="off" placeholder="JUROS" style="width: 60rem" />
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>MULTA</strong>
                            <input class="form-control" type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" autocomplete="off" placeholder="MULTA" style="width: 60rem" />
                        </div>
                    </div>


                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>VALOR TOTAL PAGO</strong>
                            <input class="form-control" readonly type="text" autocomplete="off" placeholder="VALOR TOTAL PAGO" style="width: 60rem" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button class="btn btn-success me-1 mb-1" type="button" id="seleciona_rateio">
                            <i data-feather="check-circle"></i>ADICIONAR
                        </button>
                        <button type="button" class="close btn btn-secondary me-1 mb-1" data-bs-dismiss="modal" aria-label="Close">
                            CANCELAR
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar -->

<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<!-- <script src="{{ asset('assets/js/custom-js/extrato.js') }}"></script> -->


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
