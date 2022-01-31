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
                url: `http://localhost:8000/empresas/nome/${words}`,
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

//informa o valor e gera a porcentagem
$("#valor_rateado").blur(function () {
    var valorTotalItens = Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
    }).format($("#valorTotal").val());

    valorTotalDespesa = Number(
        valorTotalItens.replace(/\./g, "").replace(",", ".").replace("R$", "")
    );

    console.log(valorTotalDespesa, "<<<<< valor total despesa");

    valorRateado = $("#valor_rateado")
        .val()
        .replace(/\./g, "")
        .replace(",", ".")
        .replace("R$", "");

    valorRateado = Number(valorRateado);

    if (valorTotalItens == "") {
        alert("Adicione os itens ou o valor total da despesa");
        $("#valor_rateado").val("");
    }

    var valorRateio = valorRateado * 100;
    var porcentagem = valorRateio / valorTotalDespesa;

    $("#porcentagem_rateado").val(porcentagem.toFixed(2));
});

//informa a porcentagem e gera o valor do rateio
$("#porcentagem_rateado").blur(function () {
    var valorTotalItens = Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
    }).format($("#valorTotal").val());
    valorTotalDespesa = valorTotalItens
        .replace(/\./g, "")
        .replace(",", ".")
        .replace("R$", "");

    var valorPorcentagem = Number($("#porcentagem_rateado").val());

    var porcentagem = valorTotalDespesa / 100;
    valorRateado = valorPorcentagem * porcentagem;

    console.log({ porcentagem: valorPorcentagem, valorRateado: valorRateado });

    $("#valor_rateado").val(
        Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        })
            .format(valorRateado)
            .toString()
            .replace("R$", "")
    );
});

btnSalvar.disabled = true;
var id_button_conta = 0;
var id_despesa = $("#id_despesa").val();
var fk_condicao_pagamento_id_tela = $("#fk_condicao_pagamento_id_tela").val();
var id_empresa = $("#id_empresa").val();
var valor_total_despesa = $("#valor_total_despesa").val();

// INICIO função para buscar Instituição bancaria
$("#addContas").click(function () {
    //  pega os valores dos campos preenchidos pelo usuario
    var inst_banco = $("#inst_banco").val();
    var porcentagem_valor = $("#porcentagem_rateado").val();
    var valor_rateado = $("#valor_rateado").val();
    var rateio_empresa = $("#busca_empresa").val();

    if (
        inst_banco == "" ||
        porcentagem_valor == "" ||
        valor_rateado == "" ||
        rateio_empresa == ""
    ) {
        alert("Preencha todos os campos do Rateio !");
        // console.log(inst_banco);
    } else if (
        valorRateado > valorTotalDespesa ||
        valorTotalRateio + valorRateado > valorTotalDespesa ||
        valorTotalRateio > valorTotalDespesa
    ) {
        alert("Valor Rateado é maior que o valor total da despesa");
    } else {
        valorTotalRateio = valorTotalRateio + valorRateado;
        $("#modal_valor_rateado").val(valorTotalRateio.toFixed(2));
        // criar novos itens com os valores preenchidos anteriormente
        $("#Tb").append(
            `<tr id="tab_conta${id_button_conta}">` +
                `<td>${rateio_empresa}</td>` +
                `<td>${inst_banco}</td>` +
                `<td>${valor_rateado}</td>` +
                `<td>${porcentagem_valor}</td>` +
                `<td><button type="button" class="btn btn-danger btn_item" onclick="removeConta(${id_button_conta}, ${valor_rateado
                    .replace(/\./g, "")
                    .replace(",", ".")
                    .replace("R$", "")})" style="padding: 8px 12px;">` +
                `<i class="bi bi-trash-fill"></i>` +
                `</button></td>` +
                "</tr>"
        );
        //retira virgulas do valor unitário
        // var valorFormatado = valor_uni.replace(".", "").replace(",", ".");
        //gera o input com os dados do item para submeter no form
        $("#hidden_inputs_itens").append(
            `<div id="input_generated_account${id_button_conta}">` +
                `<input type="hidden"  name="id_busca_empresa[]" value="${rateio_empresa}"/>` +
                `<input type="hidden"  name="id_inst_banco[]" value="${inst_banco}"/>` +
                `<input type="hidden"  name="valor_rateio_pagamento[]" value="${valor_rateado}"/>` +
                `<input type="hidden"  name="fk_tab_conta_bancaria[]" value="${conta_bancaria}"/>` +
                `<input type="hidden"  name="porcentagem_rateado[]" value="${porcentagem_valor}"/>` +
                `</div>`
        );

        console.log({
            valorTotalRateio: valorTotalRateio,
            valorTotalDespesa: valorTotalDespesa,
        });
        if (valorTotalRateio == valorTotalDespesa) {
            btnSalvar.disabled = false;
        }

        id_button_conta++;
        limpaCamposRateio();
    }
});
// Fim função para buscar Instituição bancaria

//remove a da tabela e das contas
function removeConta(id, valorRateado) {
    //subtrai o valor removido do valor total do rateio
    valorTotalRateio = valorTotalRateio - valorRateado;
    //atualiza o valor total do rateio no input

    $(`#tab_conta${id}`).remove();
    $(`#input_generated_account${id}`).remove();
    $("#modal_valor_rateado").val(valorTotalRateio.toFixed(2));
    btnSalvar.disabled = true;
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

function limparDescontoJurosMulta(){   
    var valorDescontoAtual = $("#desconto").val();
    var valorModalAtual = $("#modal_valor_total").val();
    var resultadoModalValorTotal = 0;

    resultadoModalValorTotal = (valorModalAtual - valorDescontoAtual);
    $("#modal_valor_total").val(resultadoModalValorTotal);

}

//adiciona valor total ao input acima do modal de rateio
$("#adicionar_rateio").click(function () {
    var SOMA = 0;
    var valorTotal = $("#valorTotal").val();   
   
    if (($("#hiddemJuros").val() != "" && $("#hiddemMulta").val() != "") && 
        $("#hiddemJuros").val() != null && $("#hiddemMulta").val() != null) {
        var juros = $("#hiddemJuros").val().replace(/\./g, "").replace(",", ".");
        var multa = $("#hiddemMulta").val().replace(/\./g, "").replace(",", ".");

        SOMA = Number(juros) + Number(multa) + Number(valorTotal);

        SOMA = Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(SOMA);

        $("#modal_valor_total").val(SOMA);
    }
   else if ($("#hiddemDesconto").val() != "" && $("#hiddemDesconto").val() != null) {
            var desconto = $("#hiddemDesconto").val().replace(/\./g, "").replace(",", ".");
            SUB = (Number(valorTotal) - Number(desconto));            
            SUB = Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL",
            }).format(SUB);        
            $("#modal_valor_total").val(SUB);
    }
    else{
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
    console.log(dt_efetivo_pagamento);
    $("#hidden_dt_efetivo_pagamento").attr("value", dt_efetivo_pagamento);
});

$("#formRateio").on("submit", function () {
    if ($("#input_efetivo_pagamento").val() == "") {
        event.preventDefault();
        alert("FAVOR INSERIR UM DATA DE EFETIVO PAGAMENTO");
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
    console.log(inputDataInicio);
    $("#inputDataFim").on("click", function () {
        inputDataFim = $(this).val();
        $("#inputDataInicio").prop("max", function () {
            return inputDataFim;
        });
    });

    console.log($("#inputDataFim").val().toString());
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
    var juros = $("#juros").val();
    var multa = $("#multa").val();
    var desconto = $("#desconto").val();

    // adiciona os valores do que e digitado no modal ADICIONAR JUROS E MULTAS
    $("#acrescidos").append(
        `<div class="d-flex" id="removeJurosMulta">` +
            `<div class="col-md-4">` +
            `<div class="form-group">` +
            `<div>` +
            `<strong>JUROS</strong>` +
            `</div>` +
            `<span>${juros}</span>` +
            `</div>` +
            `</div>` +
            `<div class="col-md-4">` +
            `<div class="form-group">` +
            `<div>` +
            `<strong>MULTA</strong>` +
            `</div>` +
            `<span>${multa}</span>` +
            `</div>` +
            `</div>` +
            `<div class="col-md-3">` +
            `<div class="form-group">` +
            `<div>` +
            ` <strong>DESCONTO</strong>` +
            `</div>` +
            `<span>${desconto}</span>` +
            `</div>` +
            `</div>` +
            `<div class="col-md-1">` +
            `<div class="form-group">` +
            `<div style="padding-top: 10px;">` +
            `</div>` +
            `<button type="button" class="btn btn-danger btn_item" info-mouse="Remover" 
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

    // valorTotalJurosMulta = juros + multa;
    // console.log({valor_Total_Juros_Multa: valorTotalJurosMulta});
});
