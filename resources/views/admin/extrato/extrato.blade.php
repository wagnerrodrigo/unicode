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
                    </tbody>
                    @endforeach
                    @endif
                </table>
                <div>{{ $lancamentos->links() }}</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h1>EXTRATOS DISPONIVEIS</h1>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table2">
                    <thead>
                        <tr>
                            <th>ID EXTRATO</th>
                            <th>NOME BANCO</th>
                            <th>DESCRIÇÃO</th>
                            <th>DATA PAGAMENTO</th>
                            <th>PREÇO</th>
                            <th>NOME DO ARQUIVO</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($extratos as $extrato)
                        <tr class="table-dark">
                            <td style="padding:5px;"><input style="margin-right: 5px;" type="checkbox" name="ids_extratos[]" value="{{$extrato->id_extrato}}" />{{$extrato->id_extrato}}</td>
                            <td style="padding:5px;">{{$extrato->org}}</td>
                            <td style="padding:5px;">{{$extrato->memo}}</td>
                            <td style="padding:5px;">{{date("d/m/Y", strtotime($extrato->dtposted))}}</td>
                            <td style="padding:5px;">{{$mascara::maskMoeda($extrato->trnamt)}}</td>
                            <td style="padding:5px;">{{$extrato->filename}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>{{ $extratos->render() }}</div>
            </div>
        </div>
    </div>
</div>

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
        console.log(inputDataInicio);
        $("#inputDataFim").attr("disabled", false);
        $("#inputDataFim").prop("required", true);
    })
    var inputDataFim;
    $("#inputDataFim").on("change", function() {
        inputDataFim = $(this).val();
        $("#inputDataInicio").prop("max", function() {
            return inputDataFim;
        })
        // $("#btnSearch").attr("disabled", false);
        console.log(inputDataFim);
        console.log($("#inputDataInicio").val());
        $("#inputDataInicio").prop("required", true);
    })
</script>



<script>
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
</script>

@endsection
