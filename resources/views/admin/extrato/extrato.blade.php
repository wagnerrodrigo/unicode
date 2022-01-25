@extends('layouts.templates.template')
@section('title', 'Extrato')
@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">

        <div class="card">
            <div class="card-header">
                <h1>LANÇAMENTOS DISPONIVEIS PARA CONCILIAÇÃO </h1>
            </div>
            <div class="card-body">
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

                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>ID DESPESA</th>
                            <th>DATA DO VENCIMENTO DESPESA</th>
                            <th>DESCRIÇÃO</th>
                            <th>VALOR</th>
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
                                <button class="accordion-button custon-btn custon-btn-accordion" onclick="getExtrato(this)" type="button" data-bs-toggle="collapse" href="#collapseExample-{{ $lancamento->fk_tab_despesa_id }}" role="button" aria-expanded="false" id="" aria-controls="collapseExample" style="width: 25px">
                                </button>
                            </td>
                        </tr>

                    </tbody>
                    @endforeach
                    @endif
                </table>
                <div>{{ $lancamentos->links() }}</div>
            </div>
        </div>
    </div>
</div>

<script>
    function getExtrato(object) {
        var href = object.getAttribute("href");
        var id = href.substring(href.indexOf("-") + 1);

        $.ajax({
            url: `extrato/lancamento/${id}`,
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data);
                //$("#collapseExample-" + id).html(data);
            }
        });
    };
</script>


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
