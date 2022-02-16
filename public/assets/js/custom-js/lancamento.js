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
                url: `http://10.175.3.209:8000/empresas/nome/${words}`,
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
        alert("Preencha todos os campos da conta!");
    } else {
        if (rateios_contas.length > 0) {
            alert("Já foi adicionada uma conta bancária para pagamento.");
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
        alert("FAVOR INSERIR UMA DATA DE PAGAMENTO");
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
        alert(
            "Valor do Desconto é superior ao VALOR ORIGINAL DA DESPESA. Por favor, verifique os valores digitados!"
        );
    } else if (Number(soma) > Number(valorTotal)) {
        alert(
            "Valor do Juros e Multa é superior ao VALOR ORIGINAL DA DESPESA. Por favor, verifique os valores digitados!"
        );
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
