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
                            <th>ID PARCELA</th>
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
                                {{ $lancamento->fk_tab_parcela_despesa_id }}
                                <input type="checkbox" class="inputs_selecionandos" name="inputs_selecionandos[]" value="{{ $lancamento->fk_tab_parcela_despesa_id }}" id="radio_lancamento_{{ $lancamento->id_tab_lancamento }}">
                            </td>
                            <td id="data_efetivo_pagamento_{{ $lancamento->id_tab_lancamento }}">{{date("d/m/Y", strtotime($lancamento->dt_efetivo_pagamento))}}</td>
                            <td>PARCELA {{ $lancamento->num_parcela }}</td>
                            <td style="padding:1px">{{ $mascara::maskMoeda($lancamento->valor_pago) }}<input type="hidden" id="valorDespesa{{$lancamento->fk_tab_parcela_despesa_id}}" value="{{$lancamento->valor_pago}}" /></td>
                            <td>{{ $lancamento->de_status_despesa }}</td>
                            <input type="hidden" id="conta_bancaria_lancamento{{ $lancamento->id_tab_lancamento }}" value="">

                            <td id="btn_abrir_extratos">
                                <div class="d-flex justify-content-space-between">
                                    <button id="{{ $lancamento->id_tab_lancamento }}" onclick="editLancamento(this.id)" class="btn btn-warning ms-5" style="padding: 8px 12px;"><i class="bi bi-pencil-fill"></i></button>
                                    <!-- <button id="{{ $lancamento->id_tab_lancamento }}" onclick="deleteLancamento(this.id)" class="btn btn-danger ms-2" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></button> -->
                                </div>

                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div>{{ $lancamentos->links() }}</div>
            </div>
        </div>

        <div class="card">
            <div class="d-flex justify-content-between">
                <div class="card-header">
                    <h1>EXTRATOS DISPONIVEIS</h1>
                </div>
                <div class="px-5 mt-4">
                    <button class="btn btn-primary" id="conciliacao">REALIZAR CONCILIAÇÃO</button>
                </div>
            </div>

            <div class="card-body">
                <table class='table table-striped' id="table2">
                    <thead>
                        <tr>
                            <th>ID EXTRATO</th>
                            <th>DATA PAGAMENTO</th>
                            <th>DESCRIÇÃO</th>
                            <th>NOME BANCO</th>
                            <th>PREÇO</th>
                            <th>NOME DO ARQUIVO</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($extratos as $extrato)
                        <tr class="table table-striped">
                            <td style="padding:5px;">{{$extrato->id_extrato}}<input style="margin-left: 5px;" type="checkbox" name="ids_extratos[]" value="{{$extrato->id_extrato}}" /></td>
                            <td style="padding:5px;">{{date("d/m/Y", strtotime($extrato->dtposted))}}</td>
                            <td style="padding:5px;">{{$extrato->memo}}</td>
                            <td style="padding:5px;">{{$extrato->org}}</td>
                            <td style="padding:5px;">{{$mascara::maskMoeda($extrato->trnamt)}} <input type="hidden" id="valorExtratoId{{$extrato->id_extrato}}" value="{{$extrato->trnamt}}"></td>
                            <td style="padding:5px;">{{$extrato->filename}}</td>
                            <input type="hidden" id="conta_bancaria_extrato{{$extrato->id_extrato}}" value="{{$extrato->fk_tab_conta_bancaria}}">
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


    var extratos = [];
    var lancamentos = [];
    valorExtrato = 0;
    valorDespesa = 0;

    $('input[name="ids_extratos[]"]:checked').each(function() {
        const extrato = {
            id: $(this).val(),
            conta_bancaria: $(`#conta_bancaria_extrato${$(this).val()}`).val(),
        }
        extratos.push(extrato);
        if (extratos.length > 1) {
            for (i = 1; i < extratos.length; i++) {
                if (extrato.conta_bancaria != extratos[i - 1].conta_bancaria) {
                    alert("As contas bancárias não são iguais");
                }
            }
        }
        valorExtrato = valorExtrato + Number($(`#valorExtratoId${$(this).val()}`).val());
    });

    $('input[name="inputs_selecionandos[]"]:checked').each(function() {
        const lancamento = {
            id: $(this).val(),
            conta_bancaria: '$(`#conta_bancaria_lancamento${$(this).val()}`).val()',
        }
        lancamentos.push(lancamento);
        valorDespesa = valorDespesa + Number($(`#valorDespesa${$(this).val()}`).val());
    });

    console.log({
        extratos,
        lancamentos
    });

    $(`#conciliacao`).click(function() {
        if (ids_lancamentos == '') {
            swal.fire({
                title: "Atenção",
                text: "Você não selecionou nenhum lançamento",
                icon: "warning",
                button: "Ok",
            });
        } else if (ids_extratos == '') {
            swal.fire({
                title: "Atenção",
                text: "Você não selecionou nenhum extrato",
                icon: "warning",
                button: "Ok",
            });
        } else if (valorDespesa + valorExtrato != 0) {
            swal.fire({
                title: "Atenção",
                text: "O valor da despesa é diferente do valor do(s) extrato(s)",
                icon: "warning",
                button: "Ok",
            });
        } else if (contaBancaria != '') {

        } else {

            console.log(ids_extratos);
            // $.ajax({
            //     type: "POST",
            //     url: `/conciliacao/${id}`,

            //     data: {
            //         "_token": "{{ csrf_token() }}",
            //         id_lancamento: id,
            //         ids_extratos: ids_extratos
            //     },
            //     dataType: "json",
            //     success: function(response) {
            //         swal({
            //             title: "Sucesso",
            //             text: "Conciliação realizada com sucesso",
            //             icon: "success",
            //         }).then(function() {
            //             window.location.href = "/extrato";
            //         });
            //     },
            //     fail: function(response) {
            //         swal({
            //             title: "Atenção",
            //             text: "Erro ao realizar a conciliação",
            //             icon: "warning",
            //             button: "Ok",
            //         });
            //     }
            // });
        }
    });

    //função para validar os checkboxes
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
