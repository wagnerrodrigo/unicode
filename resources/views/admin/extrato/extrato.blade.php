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
                            <th>DATA DO PAGAMENTO</th>
                            <th>DESCRIÇÃO</th>
                            <th style="padding:1px">VALOR</th>
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
                                {{ $lancamento->id_tab_lancamento }}
                                <input type="checkbox" class="inputs_selecionandos" name="radio_lancamento" value="{{ $lancamento->id_tab_lancamento }}" id="radio_lancamento_{{ $lancamento->id_tab_lancamento }}">
                            </td>
                            <td>{{date("d/m/Y", strtotime($lancamento->dt_vencimento))}}</td>
                            <td>{{ $lancamento->de_despesa }}</td>
                            <td style="padding:1px">{{ $mascara::maskMoeda($lancamento->valor_total_despesa) }}</td>
                            <td>{{ $lancamento->de_status_despesa }}</td>

                            <td id="btn_abrir_extratos">
                                <button type="button" id="abrir_extratos_{{ $lancamento->id_tab_lancamento }}" disabled class="accordion-button custon-btn custon-btn-accordion" onclick="getExtrato(this)" type="button" data-bs-toggle="collapse" href="#collapseExample-{{ $lancamento->id_tab_lancamento }}" role="button" aria-expanded="false" aria-controls="collapseExample" style="width: 25px">
                                </button>
                            </td>
                        </tr>

                        <tr class="collapse" id="collapseExample-{{ $lancamento->id_tab_lancamento }}">
                            <th></th>
                            <th>ID EXTRATO</th>
                            <th>NOME BANCO</th>
                            <th>DATA PAGAMENTO</th>
                            <th>PREÇO</th>
                            <th> <button class="btn btn-small btn-primary" id="conciliacao_{{ $lancamento->id_tab_lancamento }}">Conciliar</button></th>
                        </tr>
                        <tr>
                    <tbody id="extrato_{{ $lancamento->id_tab_lancamento }}">

                    </tbody>
                    </tr>
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

<script>
    function getExtrato(object) {
        var href = object.getAttribute("href");
        var id = href.substring(href.indexOf("-") + 1);
        var expanded = object.getAttribute("aria-expanded");

        if (expanded == 'true') {
            $.ajax({
                type: "GET",
                url: `http://localhost:8000/extrato/lancamento/${id}`,
                dataType: "json",
                success: function(response) {
                    if (response != []) {
                        for (i = 0; i < response.length; i++) {
                            $.each(response[i], function(key, val) {
                                $(`#extrato_${id}`).append(
                                    `<tr class="table-dark tr_generated_${id}">` +
                                    "<td></td>" +
                                    `<td>` + val.id_extrato + `<input type="checkbox" name="ids_extratos[]" value="${val.id_extrato}"/></td>` +
                                    `<td>${val.org}</td>` +
                                    "<td>" + Intl.DateTimeFormat('pt-BR').format(new Date(val.dtposted)) + "</td>" +
                                    "<td>" + Intl.NumberFormat('pt-BR', {
                                        style: 'currency',
                                        currency: 'BRL'
                                    }).format(val.balamt) + "</td>" +
                                    "<td></td>"

                                );

                            });
                        }
                    } else {
                        $(`#extrato_${id}`).append(
                            `<tr class="table-light tr_generated_${id}">` +
                            `<td><span style="color: red; font-weight: bold;">Não há extrato</span></td>` +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "</tr>"
                        );
                    }
                }
            });
        } else {
            $(`.tr_generated_${id}`).remove();
        }
    }

    $(function() {
        $('input.inputs_selecionandos').click(function() {
            if ($(this).is(":checked")) {
                $('input.inputs_selecionandos').attr('disabled', true);
                $('#abrir_extratos_' + $(this).val()).removeAttr('disabled');
                $(this).removeAttr('disabled');
            } else {
                $('input.inputs_selecionandos').removeAttr('disabled');
                $('#abrir_extratos_' + $(this).val()).attr('disabled', true);
                
                if($('#abrir_extratos_' + $(this).val()).attr('aria-expanded') == 'true'){
                    $('#collapseExample-' + $(this).val()).attr('class', 'collapse');
                    $(".tr_generated_" + $(this).val()).remove();
                    $('#abrir_extratos_' + $(this).val()).attr('aria-expanded', false);
                }
            }
        })
    })
</script>

@endsection