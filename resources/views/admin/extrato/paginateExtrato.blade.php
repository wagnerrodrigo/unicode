
@extends('layouts.templates.template')
@section('title', 'Extrato')
@section('content')

<form action="" method="" id="form_paginacao_extrato">
    <input type="hidden" id="page_extrato" name="page" value="0">
</form>

<form action="" id="form_paginacao_lancamento">
    <div class="card-header">
        <h1>CONCILIAÇÃO DE LANÇAMENTOS COM EXTRATOS</h1>
    <div class="d-flex">
        <div class="col-md-2">
            <div class="input-group mb-3" style="width: 250px">
                <label class="input-group-text" info-data="Data inicio do Pagamento" for="inputDataInicio">DATA INICIO</label>
                <input class="form-control" type="date" max="" name="dt_inicio" id="inputDataInicio">
            </div>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="col-md-2">
            <div class="input-group mb-3" style="width: 240px" >
                <label class="input-group-text" info-data="Data fim do Pagamento" for="inputDataFim">DATA FIM</label>
                <input class="form-control" type="date" min="" name="dt_fim" id="inputDataFim">
            </div>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       

        <div class="input-group mb-3" style="width: 250px">
            <label class="input-group-text" info-data="Agencia e Conta" for="inputConta">AG/Conta</label>
            <select class="form-select" id="inputConta" name="conta">
                <option selected value=""></option>
                @foreach($agenciaConta as $agenciaConta)
                <option value="{{$agenciaConta->nu_conta}}">{{$agenciaConta->de_banco}} &nbsp;&nbsp; A:{{$agenciaConta->nu_agencia}}  &nbsp;&nbsp; C:{{$agenciaConta->nu_conta}}</option>
                @endforeach
            </select>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


        <div class="col-md-2">
            <button type="submit" id="btnSearch" class="btn btn-primary" style="padding: 8px 24px; display: inline-block">
                <i class="bi bi-search"></i>
            </button>
        </div>        
    </div>
    
    </div>

    <input type="hidden" id="page_lancamento" name="page" value="0">
</form>

<div class="col-12 card" style="display: block">

<div class="col-6" style="display: inline-block;  position: absolute; top: 0; left: 0">
    <div class="card-lancamentos">
    <div id="" style="margin-top: 5px;" style="width: 50%">
    <div class="main-content container-fluid">
        <div class="">
            <div class="card-header">
                <h2>LANÇAMENTOS DISPONIVEIS PARA CONCILIAÇÃO</h2>
            </div>

            <div class="card-body">
                <!-- <form action="{{ route('extrato') }}" method="GET">
                   
                </form> -->

                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th style="padding: 10px;">ID PARCELA</th>
                            <th style="padding: 10px;">DATA DO PAGAMENTO</th>
                            <th style="padding: 10px;">DESCRIÇÃO</th>
                            <th style="padding: 10px;">VALOR</th>
                            <!-- <th style="padding:1px">AGENCIA/CONTA</th> -->
                            <!-- <th>STATUS</th> -->
                            <th style="padding: 10px;">AÇÕES</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($lancamentos != null || !empty($lancamentos))
                        @foreach ($lancamentos as $lancamento)
                        <tr>
                            <td style="padding:3px;">
                                {{ $lancamento->fk_tab_parcela_despesa_id }}
                                <input type="checkbox" class="inputs_selecionandos" name="inputs_selecionandos[]" value="{{ $lancamento->fk_tab_parcela_despesa_id }}" id="radio_lancamento_{{ $lancamento->id_tab_lancamento }}">
                                <input type="hidden" value="{{ $lancamento->id_tab_lancamento }}" id="id_lancamento_{{ $lancamento->fk_tab_parcela_despesa_id }}">
                            </td>
                            <td style="padding:3px;" id="data_efetivo_pagamento_{{ $lancamento->fk_tab_parcela_despesa_id }}">
                                {{date("d/m/Y", strtotime($lancamento->dt_efetivo_pagamento))}}
                                <input type="hidden" value="{{ $lancamento->dt_efetivo_pagamento }}" id="data_{{ $lancamento->fk_tab_parcela_despesa_id }}">
                            </td>
                            <td style="padding:3px;">PARCELA {{ $lancamento->num_parcela }}</td>
                            <td style="padding:3px;">{{ $mascara::maskMoeda($lancamento->valor_pago) }}<input type="hidden" id="valorDespesa{{$lancamento->fk_tab_parcela_despesa_id}}" value="{{$lancamento->valor_pago}}" /></td>
                            <!-- <td>A:{{ $lancamento->nu_agencia }} C:{{$lancamento->nu_conta }}</td> -->
                            <!-- <td>{{ $lancamento->de_status_despesa }}</td> -->
                            <input type="hidden" id="conta_bancaria_lancamento{{$lancamento->fk_tab_parcela_despesa_id}}" value="{{$lancamento->fk_tab_conta_bancaria}}">
                            <td style="padding:3px;" id="btn_abrir_extratos">
                                <div class="d-flex justify-content-space-between">
                                    <button id="{{ $lancamento->id_tab_lancamento }}" onclick="editLancamento(this.id)" class="btn btn-warning" style="padding: 3px 6px; color: black;"><i class="bi bi-pencil-fill"></i></button>
                                    <!-- <button id="{{ $lancamento->id_tab_lancamento }}" onclick="deleteLancamento(this.id)" class="btn btn-danger ms-2" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></button> -->
                                </div>

                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div id="pagination_lancamentos">{{ $lancamentos->links() }}</div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

<div class="col-4" style="display: inline-block;  position: absolute; top: 0; right: 250px">
        <div class="card-extratos"></div>
</div>


</div>


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>

    var pageExtrato = 1;
    var pageLancamento = 1;
    var contaBancaria = null;
    $(document).ready(function() {
        loadTableExtrato(0);
        loadTableLancamentos(0);
    });

    $(document).on('click', '#pagination_extratos a', function(event) {
        event.preventDefault();
        pageExtrato = $(this).attr('href').split('page=')[1];
        var url = $(this).attr('href').split('extrato')[1];
        url = url.split('/');
        if(url[1] == 'filter'){
            loadTableExtratoWithId(contaBancaria, pageExtrato);
        }else{
            loadTableExtrato(pageExtrato);
        }
    });
    
    $(document).on('click', '#pagination_lancamentos a', function(event) {
        event.preventDefault();
        pageLancamento = $(this).attr('href').split('/parcelas?page=')[1];

        loadTableLancamentos(pageLancamento);
        loadTableExtrato(1);
    });

    // $(document).on('keyup submit', '#form_paginacao_lancamento', function(event) {
    //     event.preventDefault();
    //     loadTableLancamentos(pageLancamento);
    // });


    $(document).on('click', '.inputs_selecionandos', function(event) {
        if ($(this).prop("checked") == true) {
            contaBancaria = $(`#conta_bancaria_lancamento${$(this).val()}`).val();
            loadTableExtratoWithId(contaBancaria, pageExtrato);
        }else{
            contaBancaria = null;
            loadTableExtrato(pageExtrato);
        }
    });

    function loadTableExtrato(page) {
        $('#page_extrato').val(page);
        var dados = $('#form_paginacao_extrato').serialize();
        $.ajax({
            url: "{{ route('extrato2') }}",
            type: 'GET',
            data: dados,
        }).done(function(data) {
            $('.card-extratos').html(data);
        });
    }

    function loadTableExtratoWithId(id, page) {
        $('#page_extrato').val(page);
        var dados = $('#form_paginacao_extrato').serialize();
        $.ajax({
            url: "extrato/filter/account/" + id,
            type: 'GET',
            data: dados,
        }).done(function(data) {
            $('.card-extratos').html(data);
        });
    }



    function loadTableLancamentos(page) {
        $('#page_lancamento').val(page);
        var dados = $('#form_paginacao_lancamento').serialize();
        $.ajax({
            url: "{{ route('paginate-lancamento') }}",
            type: 'GET',
            data: dados,
        }).done(function(data) {
            $('.card-lancamentos').html(data);
        });
    }
</script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="{{ asset('assets/js/custom-js/extrato.js') }}"></script> -->
<script>
    function conciliacao() {
        if (lancamentos.length == 0) {
            swal.fire({
                title: "Atenção",
                text: "Você não selecionou nenhum lançamento",
                icon: "warning",
                showConfirmButton: true,
            });
        } else if (extratos.length == 0) {
            swal.fire({
                title: "Atenção",
                text: "Você não selecionou nenhum extrato",
                icon: "warning",
                showConfirmButton: true,
            });
        } else if (valorDespesa + valorExtrato != 0) {
            swal.fire({
                title: "Atenção",
                text: "O valor da despesa é diferente do valor do(s) extrato(s)",
                icon: "warning",
                showConfirmButton: true,
            });
        } else if (lancamentos[0].conta_bancaria != extratos[0].conta_bancaria) {
            swal.fire({
                title: "Atenção",
                text: "As contas bancárias dos lançamentos e extratos selecionados não são iguais",
                icon: "warning",
                showConfirmButton: true,
            });
        } else {
            $.ajax({
                type: "POST",
                url: `/conciliacao`,
                data: {
                    "_token": "{{ csrf_token() }}",
                    lancamentos,
                    extratos
                },
                dataType: "json",
                success: function(response) {
                    swal.fire({
                        title: "Sucesso",
                        text: "Conciliação realizada com sucesso",
                        icon: "success",
                    }).then(function() {
                        window.location.href = "/extrato";
                    });
                },
                fail: function(response) {
                    swal.fire({
                        title: "Atenção",
                        text: "Erro ao realizar a conciliação",
                        icon: "warning",
                        button: "Ok",
                    });
                }
            });
        }
    };

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
    var valorDespesa = 0;
    var lancamentos = [];
    $('input[name="inputs_selecionandos[]"]').change(function() {
        if ($(this).prop("checked") == true) {
            const lancamento = {
                id: $(`#id_lancamento_${$(this).val()}`).val(),
                conta_bancaria: $(`#conta_bancaria_lancamento${$(this).val()}`).val(),
                data: $(`#data_${$(this).val()}`).val(),
            }

            if (lancamentos.length < 1) {
                lancamentos.push(lancamento);
                console.log(lancamentos);
            } else {
                if (lancamento.conta_bancaria != lancamentos[0].conta_bancaria) {
                    swal.fire({
                        title: 'Atenção',
                        text: 'Selecione lancamentos de mesma conta bancaria',
                        type: 'warning',
                        confirmButtonText: 'Fechar'
                    });
                    $(this).prop('checked', false);
                } else {
                    lancamentos.push(lancamento);
                }
            }
            valorDespesa = valorDespesa + Number($(`#valorDespesa${$(this).val()}`).val());
        } else if (lancamentos.length > 0 && extratos.length > 1) {
            swal.fire({
                title: 'Atenção',
                text: 'Selecione apenas um extrato',
                type: 'warning',
                confirmButtonText: 'Fechar'
            });
            $(this).prop('checked', false);
        } else {
            const lancamento = {
                id: $(this).val(),
                conta_bancaria: $(`#conta_bancaria_lancamento${$(this).val()}`).val(),
                data: $(`#data_${$(this).val()}`).val(),
            }

            var lancamentoFiltrado = lancamentos.find(lancamento => lancamento.id === $(this).val());
            lancamentos.splice(lancamentos.indexOf(lancamentoFiltrado), 1);
            valorDespesa = valorDespesa - Number($(`#valorDespesa${$(this).val()}`).val());
        }
    });
</script>
@endsection
