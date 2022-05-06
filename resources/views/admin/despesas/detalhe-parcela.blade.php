@extends('layouts.templates.template')
@section('title', 'Despesa')
@section('content')


<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>INFORMAÇÕES DA DESPESA N°{{ $despesa->id_despesa }}</h1>
            </div>
            <div class="card-body" style="font-size: 18px;">

                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" id="tipo_despesa" value="{{$despesa->fk_tab_tipo_despesa_id}}">
                            @if ($despesa->fk_tab_tipo_despesa_id == $tipo::FORNECEDOR)
                            <div>
                                <strong>EMPRESA</strong>
                            </div>
                            <span>{{ $despesa->de_razao_social }}</span>
                            <input type="hidden" id="id_fornecedor" value="{{$despesa->fk_tab_fornecedor_id}}">

                            @elseif($despesa->fk_tab_tipo_despesa_id == $tipo::EMPREGADO)
                            <input type="hidden" id="id_empregado" value="{{$despesa->fk_tab_empregado_id}}">
                            <div>
                                <strong>EMPREGADO</strong>
                            </div>
                            <span>{{ $despesa->nome_empregado }}</span>
                            @else
                            <strong>EMPREGADO/FORNECEDOR</strong>
                            <span></span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>NUMERO DA DESPESA</strong>
                            </div>
                            <span>{{ $despesa->id_despesa }}</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>EMPRESA</strong>
                            </div>
                            <span>{{ $despesa->de_empresa }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>CENTRO DE CUSTO</strong>
                            </div>
                            <span>{{ $despesa->de_departamento ?? 'NÃO CADASTRADO'}}</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>STATUS</strong>
                            </div>
                            <span>{{ $despesa->de_status_despesa }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>DATA DE EMISSÃO</strong>
                            </div>
                            <span>{{ $despesa->dt_inicio == null ? 'NÃO CADASTRADO' : date('d/m/Y', strtotime($despesa->dt_inicio))}}</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>CLASSIFICAÇÃO</strong>
                            </div>
                            <span>{{ $despesa->de_plano_contas }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>TIPO</strong>
                            </div>
                            <span>{{ $despesa->de_clasificacao_contabil }}</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>PARCELAS</strong>
                            </div>
                            <span>{{ $despesa->qt_parcelas_despesa }}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>VALOR TOTAL</strong>
                            </div>
                            <span>{{ $mascara::maskMoeda($despesa->valor_total_despesa) }}</span>
                        </div>
                    </div>
                </div>

                <hr />

                @if(count($rateios) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th style="padding:10px;">ID</th>
                            <th>Empresa</th>
                            <th>Centro de custo</th>
                            <th>Valor</th>
                            <th style="padding:5px;">%</th>
                        </thead>

                        <tbody>
                            @foreach($rateios as $rateio)
                            <tr>
                                <td style="padding:5px;">{{$rateio->id_rateio_despesa}}</td>
                                <td>{{$rateio->de_empresa}} {{$rateio->regiao_empresa}}</td>
                                <td>{{$rateio->de_departamento}}</td>
                                <td>{{$mascara::maskMoeda($rateio->valor_rateio_despesa)}}</td>
                                <td style="padding:5px;">{{$rateio->porcentagem_rateio_despesa}}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div></div>
                @endif
                </hr>
            </div>
        </div>

        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1>INFORMAÇÕES DA PARCELA N°{{ $parcela->num_parcela }}</h1>
                </div>
                <div class="card-body" style="font-size: 18px;">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <strong>VALOR PARCELA</strong>
                                    </div>
                                    <span>{{ $mascara::maskMoeda($parcela->valor_parcela) }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <strong>STATUS PARCELA</strong>
                                    </div>
                                    <span>{{ $parcela->de_status_despesa}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <strong>DATA DE EMISSÃO</strong>
                                    </div>
                                    <span>{{ date('d/m/Y', strtotime($parcela->dt_emissao)) }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <strong>DATA DE VENCIMENTO</strong>
                                    </div>
                                    <span>{{ date('d/m/Y', strtotime($parcela->dt_vencimento)) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <strong>DATA DE PROVISIONAMENTO</strong>
                                    </div>
                                    <span>{{ $parcela->dt_provisionamento == null ? 'NÃO CADASTRADO' : date('d/m/Y', strtotime($parcela->dt_provisionamento)) }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <strong>FORMA DE PAGAMENTO</strong>
                                    </div>
                                    <span>{{ $parcela->fk_condicao_pagamento == null ? 'NÃO CADASTRADO' : $parcela->fk_condicao_pagamento}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        @if($despesa->de_status_despesa == 'A PAGAR' ||$despesa->de_status_despesa == 'EM ATRASO')
                        <button class="btn btn-success" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#xlarge">Editar</button>
                        @endif

                        <a href="{{ route('despesas') }}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Inicio Modal Editar-->
        <div class="me-1 mb-1 d-inline-block">
            <!--Extra Large Modal -->
            <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel16">EDITAR PARCELA</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x" data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/parcelas/alterar/{{$parcela->id_parcela_despesa}}" method="POST" style="padding: 10px;">
                                @csrf
                                <div class="d-flex mt-10" style="width: 100%">
                                    <div class="px-5 mb-3">
                                        <strong>DATA DE PROVISIONAMENTO</strong>
                                        <input type="date" required class="form-control input-add" value="{{ $parcela->dt_provisionamento }}" id="data_provisionamento" name="data_provisionamento" style="width: 358px" />
                                        <span id="erro_dt_emissao"></span>
                                    </div>

                                    <div class="px-5 mb-3">
                                        <strong>CONDIÇÃO PAGAMENTO</strong>
                                        <select required class="form-control input-add teste"  name="tipo_pagamento" id="condicao_pagamento">
                                            <option selected value=""></option>
                                        </select>

                                    </div>
                                </div>

                                <div class="d-flex" style="width: 100%">
                                    <div class="px-5 mb-3" id="conta_hidden">
                                        <!-- CAMPO DE CONTA BANCARIA E PIX -->
                                    </div>

                                    <div class="px-5 mb-3" id="modal_conta">
                                        <!-- BUTTON MODAL -->
                                    </div>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" id="btnSalvar" class="btn btn-primary me-1 mb-1">
                                    <i data-feather="check-circle"></i>Salvar
                                </button>
                                <!-- mudar para produto -->
                                <a href="{{ route('despesas') }}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- fim modal -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <script>
        $("#dt_emissao").on("change", function() {
            var dateObj = $("#dt_emissao").val();

            var dataDividida = dateObj.split("-");
            var data = new Date(dataDividida[0], dataDividida[1] - 1, dataDividida[2]);
            var now = new Date();
            var dataAtual = new Date(now.getFullYear(), now.getMonth(), now.getDate());

            if (data > dataAtual) {
                $(this).css({
                    color: "red"
                });
                $("#erro_dt_emissao")
                    .html("Data de emissão maior que a data atual")
                    .css({
                        color: "red",
                        fontStyle: "italic"
                    });
                $("#btnSalvar").attr("disabled", true);
                $("#dt_emissao").focus();
            } else {
                $("#erro_dt_emissao").html("");
                $(this).css({
                    color: "black"
                });
                $("#btnSalvar").attr("disabled", false);
            }
        });
    </script>

    <script>
        var valor = document.getElementById("tipo_documento").value;
        window.onload = removeOption(valor);

        function removeOption(value) {
            var select = document.getElementById("tipo_documento");

            var i = select.options.length;
            while (i--) {
                if (select.options[i].value == value) {
                    if (document.getElementById('tipo_documento').options[i].getAttribute('selected') == null) {
                        select.remove(i);
                    }
                }
            }
        }
    </script>

    <script>
        //Buscar condição de pagamento no banco de dados com requisição via AJAX
        var tipoDespesa = document.getElementById("tipo_despesa").value;
        $.ajax({
                type: "GET",
                url: `/condicao_pagamento`,
                dataType: "json",
            })
            .done(function(response) {
                //traz os resultados do banco para uma div hidden
                $.each(response, function(key, val) {
                    if (val.id_condicao_pagamento != 9) {
                        $("#condicao_pagamento")
                            .append(
                                `<option class="item_condicao_pagamento" value="${val.id_condicao_pagamento}">${val.de_condicao_pagamento}</option>`
                            )
                    }
                });

                $("#condicao_pagamento").change(function() {
                    var id_tipo_pagamento = $(this).val();

                    //tipos de pagamento  3 = Depósito; 6 = DOC; 7 = TED; 8 == Tranferência;


                    if (
                        id_tipo_pagamento == 3 ||
                        id_tipo_pagamento == 6 ||
                        id_tipo_pagamento == 7 ||
                        id_tipo_pagamento == 8
                    ) {
                        alert('sou um deposito');
                        limpaCamposContaBancariaPix();
                        //gera input de conta
                        $("#conta_hidden").append(
                            "<strong class='remove_conta'>CONTA BANCÁRIA DO FORNECEDOR/EMPREGADO</strong>" +
                            "<select name='conta_bancaria' onclick='getContaBancaria(this)' class='form-control input-add remove_conta' id='contas_fornecedor'>" +
                            "<option value='' class='contas_fornecedor_resultado'></option>" +
                            "</select>"
                        );
                        var endpoint;
                        var url = "/contas-bancarias/";



                        if (tipoDespesa == 1) {
                            let idEmpregado = document.getElementById("id_empregado").value; ;
                            endpoint = `${idEmpregado}/empregado`;
                            url = url + endpoint;
                        } else if (tipoDespesa == 2) {
                            let idFornecedor = document.getElementById("id_fornecedor").value; ;
                            endpoint = `${idFornecedor}/fornecedor`;
                            url = url + endpoint;
                        }

                        $.ajax({
                            type: "GET",
                            url: url,
                            dataType: "json",
                        }).done(function(response) {
                            //mostra os resultados da busca em uma div
                            $.each(response, function(key, val) {
                                $("#contas_fornecedor").append(
                                    `<option class="contas_fornecedor_resultado" value="${val.id_conta_bancaria}">${val.co_banco} - ${val.de_banco} AG: ${val.nu_agencia} CONTA: ${val.nu_conta}</option>`
                                );
                            });
                        });

                        //botão modal de conta bancaria
                        $("#modal_conta").append(
                            `<strong class="remove_btn_modal">ADICIONAR CONTA BANCÁRIA</strong>` +
                            `<div class="remove_btn_modal">
                        <button type="button" onclick="adicionaContaBancaria()" id="btn_modal_conta" class="btn btn-primary remove_btn_modal" data-bs-toggle="modal" data-bs-target="#modal_conta_bancaria" style="padding: 8px 12px;">
                        <i class="bi bi-plus"></i>
                        </button>
                    </div>`
                        );
                        //tipo de pagamento 2 = pix
                    } else if (id_tipo_pagamento == 2) {
                        limpaCamposContaBancariaPix();

                        $("#conta_hidden").append(
                            "<strong class='remove_conta'>PIX DO FORNECEDOR</strong>" +
                            "<select onclick='getPix(this)' class='form-control input-add remove_pix' id='pix_fornecedor'>" +
                            "<option value='' class='pix_fornecedor_resultado'></option>" +
                            "</select>"
                        );


                        if (tipoDespesa == 2) {
                            $.ajax({
                                    type: "GET",
                                    url: `/pix/fornecedor/${idFornecedor}`,
                                    dataType: "json",
                                })
                                .done(function(response) {
                                    if (response.length == 0) {
                                        $("#pix_fornecedor").empty();
                                        $("#pix_fornecedor").append(
                                            `<option selected class="" value="">Nenhum pix cadastrado </option>`
                                        );
                                    } else {
                                        $("#pix_fornecedor").empty();
                                        $.each(response, function(key, val) {
                                            $("#pix_fornecedor").append(
                                                `<option class="pix_fornecedor_resultado" value="${val.id_pix}">${val.de_tipo_pix} - ${val.de_pix}</option>`
                                            );
                                        });
                                    }
                                })
                                .fail(function(response) {
                                    swal({
                                        title: "Atenção",
                                        text: "Não foi possível buscar os PIX",
                                        icon: "warning",
                                        button: "OK",
                                    });
                                });
                        } else {
                            // [REGRA DE NEGOCIO]-> não exite uma definição para o pix do empregado
                            // ajax de busca do pix do empregado
                            $.ajax({
                                    type: "GET",
                                    url: `/pix/empregado/${idEmpregado}`,
                                    dataType: "json",
                                })
                                .done(function(response) {
                                    if (response.length == 0) {
                                        $("#pix_fornecedor").empty();
                                        $("#pix_fornecedor").append(
                                            `<option selected class="" value="">Nenhum pix cadastrado </option>`
                                        );
                                    } else {
                                        $("#pix_fornecedor").empty();
                                        $.each(response, function(key, val) {
                                            $("#pix_fornecedor").append(
                                                `<option class="pix_fornecedor_resultado" value="${val.id_pix}">${val.de_tipo_pix} - ${val.de_pix}</option>`
                                            );
                                        });
                                    }
                                })
                                .fail(function(response) {
                                    swal({
                                        title: "Atenção",
                                        text: "Não foi possível buscar os PIX",
                                        icon: "warning",
                                        button: "OK",
                                    });
                                });
                        }

                        //botão do modal de conta pix
                        $("#modal_conta").append(
                            `<strong class="remove_btn_modal">ADICIONAR PIX</strong>` +
                            `<div class="remove_btn_modal">
                        <button type="button" onclick="adicionaPix()" id="btn_modal_conta" class="btn btn-primary remove_btn_modal" data-bs-toggle="modal" data-bs-target="#modal_pix" style="padding: 8px 12px;">
                        <i class="bi bi-plus"></i>
                        </button>
                    </div>`
                        );
                    } else {
                        limpaCamposContaBancariaPix();
                    }
                });

                // $(".item_condicao_pagamento").click(function() {
                //     $("#condicao_pagamento").val($(this).text());

                //     console.log($(this).text());


                //     //faz a requisição ajax para buscar tipo de classificação
                // });
            })
            .fail(function() {
                console.log("erro na requisição Ajax");
            });

        // limpa campos de conta bancaria e pix
        function limpaCamposContaBancariaPix() {
            $(".remove_btn_modal").remove();
            $(".remove_conta").remove();
            $(".remove_pix").remove();
            $("#contas_fornecedor").empty();
            $("#pix_fornecedor").empty();
            $("#numero_pix").attr("value", "");
            $("#numero_conta_bancaria").attr("value", "");
        }

        // nao esta funcionado o limpaCamposContaPix
        function limpaCamposContaPix() {
            $("#option_Pix").remove();
        }

        $("#form_despesa").submit(function(event) {
            if ($("#condicao_pagamento").val() == "") {
                swal({
                    title: "Atenção",
                    text: "Selecione a condição de pagamento",
                    icon: "warning",
                    button: "OK",
                });
                event.preventDefault();
            }
        });

        function limpaCamposDespesaJuridica() {
            $(".remove_processo").remove();
            $("input[name=numero_processo]").attr("value", "");
        }

        //adiciona delay nos campos de pesquisa
        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this,
                    args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function() {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }

        function getPix(object) {
            $("input[name=numero_pix]").attr("value", object.value);
        }

        function getContaBancaria(object) {
            $("input[name=numero_conta_bancaria]").attr("value", object.value);
        }
    </script>


    @endsection
