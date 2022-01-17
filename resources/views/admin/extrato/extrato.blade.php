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
                <div class="d-flex">
                    <div class="col-md-2">
                        <div class="input-group mb-3" style="width: 250px">
                            <label class="input-group-text" for="inputDataInicio">DATA INICIO</label>
                            <input class="form-control" type="date" max="" name="" id="inputDataInicio">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-3" style="width: 250px">
                            <label class="input-group-text" for="inputDataFim">DATA FIM</label>
                            <input class="form-control" type="date" min="" name="" id="inputDataFim">
                        </div>
                    </div>
                </div>
                {{-- FIM DOS CAMPOS DE SELECT --}}

                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>ID EXTRATO</th>
                            <th>DATA DO VENCIMENTO</th>
                            <th>DESCRIÇÃO</th>
                            <th>STATUS</th>
                            <th>AÇÕES</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
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
                        <!-- @if ($extratos != null || !empty($extratos))
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
                        @endif -->
                    </tbody>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors.js') }}"></script>
<script src="{{ asset('assets/js/vendors.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
{{-- <script src="{{ asset('assets/js/custom-js/extrato.js') }}"></script> --}}


<script>
    var inputDataInicio;
    $("#inputDataInicio").on("change", function() {
        inputDataInicio = $(this).val();
        $("#inputDataFim").prop("min", function() {
            return inputDataInicio;
        })
        console.log(inputDataInicio);
        $.ajax({

        })
    })


    var inputDataFim;
    $("#inputDataFim").on("change", function() {
        inputDataFim = $(this).val();
        $("#inputDataInicio").prop("max", function() {
            return inputDataFim;
        })
    })
</script>


@endsection
