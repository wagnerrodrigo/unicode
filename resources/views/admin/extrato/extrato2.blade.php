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
                                <label class="input-group-text" info-data="Data inicio do Pagamento" for="inputDataInicio">DATA INICIO</label>
                                <input class="form-control" type="date" max="" name="dt_inicio" id="inputDataInicio">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3" style="width: 240px">
                                <label class="input-group-text" info-data="Data fim do Pagamento" for="inputDataFim">DATA FIM</label>
                                <input class="form-control" type="date" min="" name="dt_fim" id="inputDataFim">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" id="btnSearch" class="btn btn-primary" style="padding: 8px 12px;">
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

                        </tr>
                    </thead>

                    <tbody>
                        @if ($lancamentos != null || !empty($lancamentos))
                        @foreach ($lancamentos as $lancamento)
                        <tr>
                            <td>
                                {{ $lancamento->fk_tab_despesa_id }}
                                <input type="checkbox" class="inputs_selecionandos" name="radio_lancamento" value="{{ $lancamento->id_tab_lancamento }}" id="radio_lancamento_{{ $lancamento->id_tab_lancamento }}">
                            </td>
                            <td id="data_efetivo_pagamento_{{ $lancamento->id_tab_lancamento }}">{{date("d/m/Y", strtotime($lancamento->dt_efetivo_pagamento))}}</td>
                            <td>{{ $lancamento->de_despesa }}</td>
                            <td style="padding:1px">{{ $mascara::maskMoeda($lancamento->valor_pago) }}<input type="hidden" id="valorDespesa{{$lancamento->id_tab_lancamento}}" value="{{$lancamento->valor_pago}}" /></td>
                            <td>{{ $lancamento->de_status_despesa }}</td>

                            <td id="btn_abrir_extratos">
                                <div class="d-flex justify-content-space-between">
                                    <button type="button" id="abrir_extratos_{{ $lancamento->id_tab_lancamento }}" disabled class="accordion-button custon-btn custon-btn-accordion" onclick="getExtrato(this)" type="button" data-bs-toggle="collapse" href="#collapseExample-{{ $lancamento->id_tab_lancamento }}" role="button" aria-expanded="false" aria-controls="collapseExample" style="width: 25px">
                                    </button>
                                    <button id="{{ $lancamento->id_tab_lancamento }}" onclick="editLancamento(this.id)" class="btn btn-warning ms-5" style="padding: 8px 12px;"><i class="bi bi-pencil-fill"></i></button>
                                    <button id="{{ $lancamento->id_tab_lancamento }}" onclick="deleteLancamento(this.id)" class="btn btn-danger ms-2" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></button>
                                </div>

                            </td>
                        </tr>

                        <tr class="collapse" id="collapseExample-{{ $lancamento->id_tab_lancamento }}">
                            <th>ID EXTRATO</th>
                            <th>NOME BANCO</th>
                            <th>DESCRIÇÃO</th>
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

        <div class="card">
            <div class="card-header">
                <h1>EXTRATOS DISPONÍVEIS</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('extrato') }}" method="GET">
                    <div class="d-flex">
                        <div class="col-md-3">
                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" info-data="Data inicio do Pagamento" for="inputDataInicio">DATA INICIO</label>
                                <input class="form-control" type="date" max="" name="dt_inicio" id="inputDataInicio">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3" style="width: 240px">
                                <label class="input-group-text" info-data="Data fim do Pagamento" for="inputDataFim">DATA FIM</label>
                                <input class="form-control" type="date" min="" name="dt_fim" id="inputDataFim">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" id="btnSearch" class="btn btn-primary" style="padding: 8px 12px;">
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
                            <th>BANCO</th>
                            <th style="padding:1px">VALOR</th>
                            <th>DESCRIÇÃO</th>
                            <th>AÇÕES</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if ($extratos)
                        @foreach ($extratos as $extrato)
                        <tr>
                            <td>
                                {{$extrato->id_extrato}}
                                <input type="checkbox" class="inputs_selecionandos" name="radio_lancamento" value="{{ $extrato->id_extrato }}" id="radio_extrato_{{ $extrato->id_extrato }}">
                            </td>
                            <td>{{date("d/m/Y", strtotime($extrato->dataserver))}}</td>
                            <td>{{$extrato->org}}</td>
                            <td>{{$mascara::maskMoeda($extrato->trnamt)}}</td>
                            <td>{{$extrato->memo}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                    @endif
                </table>
                <div>{{ $extratos->links() }}</div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="{{ asset('assets/js/custom-js/extrato.js') }}"></script> -->

<script>
    $("#inputDataFim").attr("disabled", true);
    var inputDataInicio;
    $("#inputDataInicio").on("change", function() {
        inputDataInicio = $(this).val();
        $("#inputDataFim").prop("min", function() {
            return inputDataInicio;
        })
        $("#inputDataFim").attr("disabled", false);
        $("#inputDataFim").prop("required", true);
    })
    var inputDataFim;
    $("#inputDataFim").on("change", function() {
        inputDataFim = $(this).val();
        $("#inputDataInicio").prop("max", function() {
            return inputDataFim;
        })
        $("#inputDataInicio").prop("required", true);
    })
</script>



<!-- <script>
    var valorExtrato = 0;
    var valorDespesa = 0;

    function getExtrato(object) {
        var href = object.getAttribute("href");
        var id = href.substring(href.indexOf("-") + 1);
        var expanded = object.getAttribute("aria-expanded");

        if (expanded == 'true') {
            $.ajax({
                type: "GET",
                url: `/extrato/lancamento/${id}`,
                dataType: "json",
                success: function(response) {
                    if (response != '') {
                        for (i = 0; i < response.length; i++) {
                            $.each(response[i], function(key, val) {
                                $(`#extrato_${id}`).append(
                                    `<tr class="table-dark tr_generated_${id}">` +
                                    `<td>` + val.id_extrato + `<input type="checkbox" name="ids_extratos[]" value="${val.id_extrato}"/></td>` +
                                    `<td>${val.org}</td>` +
                                    `<td>${val.memo}</td>` +
                                    "<td>" + Intl.DateTimeFormat('pt-BR').format(new Date(val.dtposted)) + "</td>" +
                                    "<td>" + Intl.NumberFormat('pt-BR', {
                                        style: 'currency',
                                        currency: 'BRL'
                                    }).format(val.trnamt) + `<input type="hidden" id="valorExtratoId${val.id_extrato}" value="${val.trnamt}"/></td>` +
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
                },
            });

            $(`#conciliacao_${id}`).click(function() {
                var id = $(this).attr('id').substring(12);
                var ids_extratos = [];
                valorExtrato = 0;
                valorDespesa = 0;
                $('input[name="ids_extratos[]"]:checked').each(function() {
                    if (Number($(`#valorExtratoId${$(this).val()}`).val()) > 0) {
                        alert("Você selecionou um extrato de entrada");
                    } else {
                        ids_extratos.push($(this).val());
                        valorExtrato = valorExtrato + Number($(`#valorExtratoId${$(this).val()}`).val());
                    }
                });

                valorDespesa = Number($(`#valorDespesa${id}`).val());

                if (ids_extratos == '') {
                    swal({
                        title: "Atenção",
                        text: "Você não selecionou nenhum extrato",
                        icon: "warning",
                        button: "Ok",
                    });
                } else if (valorDespesa + valorExtrato != 0) {
                    swal({
                        title: "Atenção",
                        text: "O valor da despesa é diferente do valor do(s) extrato(s)",
                        icon: "warning",
                        button: "Ok",
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: `/conciliacao/${id}`,

                        data: {
                            "_token": "{{ csrf_token() }}",
                            id_lancamento: id,
                            ids_extratos: ids_extratos
                        },
                        dataType: "json",
                        success: function(response) {
                            swal({
                                title: "Sucesso",
                                text: "Conciliação realizada com sucesso",
                                icon: "success",
                            }).then(function() {
                                window.location.href = "/extrato";
                            });
                        },
                        fail: function(response) {
                            swal({
                                title: "Atenção",
                                text: "Erro ao realizar a conciliação",
                                icon: "warning",
                                button: "Ok",
                            });
                        }
                    });
                }
            });
        } else {
            $(`.tr_generated_${id}`).remove();
        }
    }
    //função para validar os checkboxes
    $(function() {
        $('input.inputs_selecionandos').click(function() {
            if ($(this).is(":checked")) {
                $('input.inputs_selecionandos').attr('disabled', true);
                $('#abrir_extratos_' + $(this).val()).removeAttr('disabled');
                $(this).removeAttr('disabled');
            } else {
                $('input.inputs_selecionandos').removeAttr('disabled');
                $('#abrir_extratos_' + $(this).val()).attr('disabled', true);

                if ($('#abrir_extratos_' + $(this).val()).attr('aria-expanded') == 'true') {
                    $('#collapseExample-' + $(this).val()).attr('class', 'collapse');
                    $(".tr_generated_" + $(this).val()).remove();
                    $('#abrir_extratos_' + $(this).val()).attr('aria-expanded', false);
                }
            }
        })
    })

    function deleteLancamento(id) {
        Swal.fire({
            title: 'Atenção!',
            text: `Deseja Realmente Excluir o Lançamento ${id}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#820AD1',
            cancelButtonColor: '#D1611F',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: `/lancamentos/delete/${id}`,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id_lancamento: id,
                    },
                    success: function(data) {
                        if (data) {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Deletado',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Erro!',
                                text: 'Erro ao deletar',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    },
                });
            }
        });
    }

    function editLancamento(id) {
        var dt_pagamento = $(`#data_efetivo_pagamento_${id}`).text();
        var dt_pagamento_formatada = FormataStringData(dt_pagamento);

        Swal.fire({
            title: '<h3>EDITAR DATA DE PAGAMENTO</h3>',
            html: ', ' +
                `<form action="/lancamentos/edit/${id}" method="post">` +
                '<div class="input-group mx-auto" style="width: 250px">' +
                `<input type="date" class="form-control" name="payment_date" value="${dt_pagamento_formatada}">` +
                `<input type="hidden" name="_token" value="{{ csrf_token() }}">` +
                '</div>' +
                `<button type="submit" class="btn btn-primary mt-5">Salvar</button>` +
                `</form>`,
            showCloseButton: true,
            showCancelButton: false,
            showConfirmButton: false,
            focusConfirm: false,
        })
    }

    function FormataStringData(data) {
        var dia = data.split("/")[0];
        var mes = data.split("/")[1];
        var ano = data.split("/")[2];

        return ano + '-' + ("0" + mes).slice(-2) + '-' + ("0" + dia).slice(-2);
        // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
    }
</script> -->

@endsection