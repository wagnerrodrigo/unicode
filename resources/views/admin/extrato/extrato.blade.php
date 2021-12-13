@extends('layouts.templates.template')
@section('title', 'Extrato')
@section('content')

    <div id="main" style="margin-top: 5px;">
        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1>Extratos</h1>
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


                        <div class="col-md-2">
                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" for="inputBanco">BANCO</label>
                                <select class="form-select" id="inputBanco">
                                    <option value="" class="resultado-busca"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" for="inputConta">CONTA</label>
                                <select class="form-select" id="inputConta">
                                    <option value="" class="resultado-busca"></option>
                                </select>
                            </div>
                        </div>

                    </div>

                    {{-- FIM DOS CAMPOS DE SELECT --}}

                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>ID Extrato</th>
                                <th>CONTA BANCARIA</th>
                                <th>DATA DO PAGAMENTO</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>asdf</td>
                                <td>asdf</td>
                                <td> ASDF</td>
                                <td>
                                    <button class="accordion-button custon-btn custon-btn-accordion" type="button"
                                        data-bs-toggle="collapse" href="#collapseExample" role="button"
                                        aria-expanded="false" aria-controls="collapseExample" style="width: 25px">
                                    </button>
                                </td>

                            </tr>
                            <tr class="collapse" id="collapseExample">
                                <td colspan="3">
                                    Some placeholder content for the collapse component. This panel is hidden by default
                                    but
                                    revealed when the user activates the relevant trigger.
                                    Some placeholder content for the collapse component. This panel is hidden by default
                                    but
                                    revealed when the user activates the relevant trigger.
                                </td>
                                <td>
                                    <a href="/extrato/id" class="btn btn-primary" style="padding: 8px 12px;">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
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
