var idFornecedor = $("#idFornecedor").val();
var idEmpregado = $("#idEmpregado").val();
var tipoDespesa = $("#tipo_da_despesa").val();
$(document).ready(function () {
    $("#modal_valor_rateado").val("0,00");
});

//inicio função para buscar empresa
var conta_bancaria;

$("#busca_empresa").keyup(
    delay(function () {
        var words = $(this).val();
        if (words != "") {
            //requisição ajax para buscar empresa
            $.ajax({
                type: "GET",
                url: `/empresas/nome/${words}`,
                dataType: "json",
            })
                //caso a requisição seja bem sucedida
                .done(function (response) {
                    $("#results_empresa").html("");
                    //mostra os resultados da busca em uma div
                    $.each(response, function (key, val) {
                        $("#results_empresa").append(
                            `<div class="item" value="${val.id_empresa}">${val.de_empresa} - ${val.regiao_empresa} </div>`
                        );
                    });
                    //seleciona a empresa desejada
                    $(".item").click(function () {
                        $("#inst_banco").val("");
                        $("#busca_empresa").val($(this).text());
                        $("#empresa").html("");
                        var id_empresa = $(this).attr("value");
                        $("#id_busca_empresa").attr("value", id_empresa);
                        //busca centros de custo relacionados com a empresa e mostra no select
                        $("#results_empresa").html("");
                        $.ajax({
                            type: "GET",
                            url: `/lancamentos/filtro-empresaContas/${id_empresa}`,
                            dataType: "json",
                        }).done(
                            delay(function (response) {
                                $("#Resultado_inst_banco").html("");
                                // mostra os resultado do nome do banco e coloca em um div
                                $.each(response, function (key, val) {
                                    $("#Resultado_inst_banco").append(
                                        `<div class="item" value="${val.id_conta_bancaria}" >${val.de_banco} -- AG: ${val.nu_agencia} -- CONTA: ${val.nu_conta}</div>`
                                    );
                                });
                                // SELECIONAR CONTAS DAS INSTITUIÇÕES BANCARIAS PERTECENTE A EMPRESA
                                $(".item").click(function () {
                                    $("#inst_banco").val($(this).text());
                                    $("#Resultado_inst_banco").html("");
                                    conta_bancaria = $(this).attr("value");
                                    $("#inst_banco").val($(this).text());
                                });
                            }),
                            500
                        );
                    });
                })
                .fail(function () {
                    $("#results_empresa").html("");
                });
        } else {
            $("#results_empresa").html("");
        }
    }, 500)
);
//FIM função para buscar empresa

var valorTotalRateio = 0;
var valorRateado = 0;
var valorTotalDespesa = 0;
var novoValorTotal = 0;

btnSalvar.disabled = true;
var id_button_conta = 0;
var id_despesa = $("#id_despesa").val();
var fk_condicao_pagamento_id_tela = $("#fk_condicao_pagamento_id_tela").val();
var id_empresa = $("#id_empresa").val();
var valor_total_despesa = $("#valor_total_despesa").val();

var rateios_contas = [];

var testeValor = 0;

// INICIO função para buscar Instituição bancaria
$("#addContas").click(function () {
    //  pega os valores dos campos preenchidos pelo usuario
    var inst_banco = $("#inst_banco").val();
    var rateio_empresa = $("#busca_empresa").val();

    if (inst_banco == "" || rateio_empresa == "") {
        swal({
            title: "Atenção",
            text: "Preencha todos os campos da conta!",
            icon: "warning",
            button: "Ok",
        });
    } else {
        if (rateios_contas.length > 0) {
            swal({
                title: "Atenção",
                text: "Já foi adicionada uma conta bancária para pagamento.",
                icon: "warning",
                button: "Ok",
            });
            limpaCamposRateio();
        } else {
            rateios_contas.push(inst_banco);
            porcentagem_valor = 100;
            btnSalvar.disabled = false;

            // criar novos itens com os valores preenchidos anteriormente

            $("#Tb").append(
                `<tr id="tab_conta${id_button_conta}">` +
                    `<td>${rateio_empresa}</td>` +
                    `<td>${inst_banco}</td>` +
                    `<td><button type="button" class="btn btn-danger btn_item" onclick="removeConta(${id_button_conta})" style="padding: 8px 12px;">` +
                    `<i class="bi bi-trash-fill"></i>` +
                    `</button></td>` +
                    "</tr>"
            );
            //retira virgulas do valor unitário

            //gera o input com os dados do item para submeter no form

            if (novoValorTotal == 0) {
                novoValorTotal = valor_total_despesa;
            } else {
                novoValorTotal = novoValorTotal
                    .replace("R$", "")
                    .replace(/\./g, "")
                    .replace(",", ".");
            }
            $("#hidden_inputs_itens").append(
                `<div id="input_generated_account${id_button_conta}">` +
                    `<input type="hidden"  name="id_busca_empresa" value="${rateio_empresa}"/>` +
                    `<input type="hidden"  name="id_inst_banco" value="${inst_banco}"/>` +
                    `<input type="hidden"  name="valor_rateio_pagamento" value="${novoValorTotal}"/>` +
                    `<input type="hidden"  name="fk_tab_conta_bancaria" value="${conta_bancaria}"/>` +
                    `<input type="hidden"  name="porcentagem_rateado" value="${porcentagem_valor}"/>` +
                    `<input type="hidden"  name="valor_pago" value="${novoValorTotal}"/>` +
                    `</div>`
            );
            limpaCamposRateio();
        }
    }
});
// Fim função para buscar Instituição bancaria

//remove a da tabela e das contas
function removeConta(id) {
    rateios_contas.splice(id, 1);

    $(`#tab_conta${id}`).remove();
    $(`#input_generated_account${id}`).remove();
    $("#modal_valor_rateado").val(valorTotalRateio.toFixed(2));
    btnSalvar.disabled = true;
    btn_juros.disabled = false;
}

// remove area de juros multa e desconto
function removeDadoAcrecimos() {
    $("#juros").val("");
    $("#multa").val("");
    $("#desconto").val("");
    $("#removeJurosMulta").remove();
    $("#removeJurosMultaHidden").remove();
    limparDescontoJurosMulta();
    $("#modalJurosMulta").attr("disabled", false);
}

// função para limpar os campos de rateio
function limpaCamposRateio() {
    $("#busca_empresa").val("");
    $("#inst_banco").val("");
    $("#porcentagem_rateado").val("");
    $("#valor_rateado").val("");
}

function limparDescontoJurosMulta() {
    var valorDescontoAtual = $("#desconto").val();
    var valorModalAtual = $("#modal_valor_total").val();
    var resultadoModalValorTotal = 0;

    resultadoModalValorTotal = valorModalAtual - valorDescontoAtual;
    $("#modal_valor_total").val(resultadoModalValorTotal);
}

//adiciona valor total ao input acima do modal de rateio
$("#adicionar_rateio").click(function () {
    var SOMA = 0;
    var valorTotal = $("#valorTotal").val();

    if (
        $("#hiddemJuros").val() != "" &&
        $("#hiddemMulta").val() != "" &&
        $("#hiddemJuros").val() != null &&
        $("#hiddemMulta").val() != null
    ) {
        var juros = $("#hiddemJuros").val();
        var multa = $("#hiddemMulta").val();

        SOMA = Number(juros) + Number(multa) + Number(valorTotal);

        SOMA = Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(SOMA);
        novoValorTotal = SOMA;
        $("#modal_valor_total").val(novoValorTotal);
    } else if (
        $("#hiddemDesconto").val() != "" &&
        $("#hiddemDesconto").val() != null
    ) {
        var desconto = $("#hiddemDesconto").val();
        SUB = Number(valorTotal) - Number(desconto);
        SUB = Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(SUB);
        novoValorTotal = SUB;
        $("#modal_valor_total").val(novoValorTotal);
    } else {
        var valorTotal = Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format($("#valorTotal").val());

        $("#modal_valor_total").val(valorTotal);
    }
});

// pega o valor da data do efetivo pagamento e coloca em um campo hidden
$("#input_efetivo_pagamento").on("change", function () {
    var dt_efetivo_pagamento = $(this).val();
    $("#hidden_dt_efetivo_pagamento").attr("value", dt_efetivo_pagamento);
});

$("#formRateio").on("submit", function () {
    if ($("#input_efetivo_pagamento").val() == "") {
        event.preventDefault();
        swal({
            title: "Atenção",
            text: "Preencha o campo data efetivo pagamento",
            icon: "warning",
            button: "Ok",
        });
        $("#input_efetivo_pagamento").focus();
    }
});

// FORMATAR CAMPO DE DATAS
var inputDataInicio;
var inputDataFim;
$("#inputDataInicio").on("click", function () {
    inputDataInicio = $(this).val();
    $("#inputDataFim").prop("min", function () {
        return inputDataInicio;
    });

    $("#inputDataFim").on("click", function () {
        inputDataFim = $(this).val();
        $("#inputDataInicio").prop("max", function () {
            return inputDataFim;
        });
    });

    if (inputDataInicio != "" && inputDataFim != "") {
        $.ajax({
            type: "GET",
            url: `/lancamentos/filtro-periodo/${inputDataInicio}/${inputDataFim}`,
            dataType: "json",
        }).done(function (response) {});
    }
});

// inputStatus e da tela de lista-lancamentos
var input = $("inputStatus :selected").val();

//adiciona delay nos campos de pesquisa
function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

// desabilita campos de juros e multa se existir desconto
$("#desconto").on("change", function () {
    var desconto = $(this).val();
    if (desconto != "") {
        $("#juros").attr("disabled", true);
        $("#multa").attr("disabled", true);
    } else {
        $("#juros").attr("disabled", false);
        $("#multa").attr("disabled", true);
    }
});

$("#multa").attr("disabled", true);

// desabilita o campo de desconto e habilita multa se existir juros
$("#juros").on("change", function () {
    var juros = $(this).val();
    if (juros != "") {
        $("#desconto").attr("disabled", true);
        $("#multa").attr("disabled", false);
    } else {
        $("#desconto").attr("disabled", false);
        $("#multa").attr("disabled", true);
    }
});

var valorTotalJurosMulta = 0;

$("#btnConciliacao").click(function () {
    var juros = $("#juros").val().replace(/\./g, "").replace(",", ".");
    var multa = $("#multa").val().replace(/\./g, "").replace(",", ".");
    var desconto = $("#desconto").val().replace(/\./g, "").replace(",", ".");
    var valorTotal = $("#valorTotal").val();
    var soma = Number(juros) + Number(multa);

    if (Number(desconto) >= Number(valorTotal)) {
        swal({
            title: "Atenção",
            text: "Valor do Desconto é superior ao VALOR ORIGINAL DA DESPESA. Por favor, verifique os valores digitados!",
            icon: "warning",
            button: "Ok",
        });
    } else if (Number(soma) > Number(valorTotal)) {
        swal({
            title: "Atenção",
            text: "Valor do Juros e Multa é superior ao VALOR ORIGINAL DA DESPESA. Por favor, verifique os valores digitados!",
            icon: "warning",
            button: "Ok",
        });
    } else {
        // adiciona os valores do que e digitado no modal ADICIONAR JUROS E MULTAS

        jurosForamatado = Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(juros);

        multaForamatado = Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(multa);

        descontoForamatado = Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(desconto);

        $("#acrescidos").append(
            `<div class="d-flex" id="removeJurosMulta">` +
                `<div class="col-md-4">` +
                `<div class="form-group">` +
                `<div>` +
                `<strong>JUROS</strong>` +
                `</div>` +
                `<span>${jurosForamatado}</span>` +
                `</div>` +
                `</div>` +
                `<div class="col-md-4">` +
                `<div class="form-group">` +
                `<div>` +
                `<strong>MULTA</strong>` +
                `</div>` +
                `<span>${multaForamatado}</span>` +
                `</div>` +
                `</div>` +
                `<div class="col-md-3">` +
                `<div class="form-group">` +
                `<div>` +
                ` <strong>DESCONTO</strong>` +
                `</div>` +
                `<span>${descontoForamatado}</span>` +
                `</div>` +
                `</div>` +
                `<div class="col-md-1">` +
                `<div class="form-group">` +
                `<div style="padding-top: 10px;">` +
                `</div>` +
                `<button type="button" id="btn_juros" class="btn btn-danger btn_item" info-mouse="Remover"
                            style="padding: 8px 12px;" onclick="removeDadoAcrecimos()">
                            <i class="bi bi-trash-fill">
                        </i></button>` +
                `</div>` +
                `</div>` +
                `</div>`
        );

        // adiciona campos hidden com os valores de juro multa e desconto
        $("#hiddenInputs").append(
            `<div class="d-flex" id="removeJurosMultaHidden">` +
                `<input type="hidden" id="hiddemJuros" name="juros" value="${juros}"/>` +
                `<input type="hidden" id="hiddemMulta" name="multa" value="${multa}"/>` +
                `<input type="hidden" id="hiddemDesconto" name="desconto" value="${desconto}"/>` +
                `</div>`
        );

        $("#modalJurosMulta").attr("disabled", true);
        if (rateios_contas.length > 0) {
            btn_juros.disabled = true;
        }
    }
});


//Buscar condição de pagamento no banco de dados com requisição via AJAX
$.ajax({
    type: "GET",
    url: `/condicao_pagamento`,
    dataType: "json",
})
    .done(function (response) {
        //traz os resultados do banco para uma div hidden
        $.each(response, function (key, val) {
            if (val.id_condicao_pagamento != 9) {
                $("#itens_tipo_pagamento")
                    .append(
                        `<div class="item_condicao_pagamento" value="${val.id_condicao_pagamento}">${val.de_condicao_pagamento}</div>`
                    )
                    .hide();
            }
        });

        console.log(tipoDespesa);
        $("#condicao_pagamento").click(function () {
            $("#itens_tipo_pagamento").show();
        });

        $(".item_condicao_pagamento").click(function () {
            $("#fk_condicao_pagamento_id").attr("value", $(this).attr("value"));
            $("#condicao_pagamento").val($(this).text());
            $("#itens_tipo_pagamento").hide();

            var id_tipo_pagamento = $(this).attr("value");
            //tipos de pagamento  3 = Depósito; 6 = DOC; 7 = TED; 8 == Tranferência;
            console.log(id_tipo_pagamento);
            if (
                id_tipo_pagamento == 3 ||
                id_tipo_pagamento == 6 ||
                id_tipo_pagamento == 7 ||
                id_tipo_pagamento == 8
            ) {
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
                    endpoint = `${idEmpregado}/empregado`;
                    url = url + endpoint;
                } else if (tipoDespesa == 2) {
                    endpoint = `${idFornecedor}/fornecedor`;
                    url = url + endpoint;
                }
                console.log(url);

                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                }).done(function (response) {
                    //mostra os resultados da busca em uma div
                    $.each(response, function (key, val) {
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
                        .done(function (response) {
                            if (response.length == 0) {
                                $("#pix_fornecedor").empty();
                                $("#pix_fornecedor").append(
                                    `<option selected class="" value="">Nenhum pix cadastrado </option>`
                                );
                            } else {
                                $("#pix_fornecedor").empty();
                                $.each(response, function (key, val) {
                                    $("#pix_fornecedor").append(
                                        `<option class="pix_fornecedor_resultado" value="${val.id_pix}">${val.de_tipo_pix} - ${val.de_pix}</option>`
                                    );
                                });
                            }
                        })
                        .fail(function (response) {
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
                        .done(function (response) {
                            if (response.length == 0) {
                                $("#pix_fornecedor").empty();
                                $("#pix_fornecedor").append(
                                    `<option selected class="" value="">Nenhum pix cadastrado </option>`
                                );
                            } else {
                                $("#pix_fornecedor").empty();
                                $.each(response, function (key, val) {
                                    $("#pix_fornecedor").append(
                                        `<option class="pix_fornecedor_resultado" value="${val.id_pix}">${val.de_tipo_pix} - ${val.de_pix}</option>`
                                    );
                                });
                            }
                        })
                        .fail(function (response) {
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
            //faz a requisição ajax para buscar tipo de classificação
        });
    })
    .fail(function () {
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
