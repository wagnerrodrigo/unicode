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
var novoValorTotal = 0;

//informa o valor e gera a porcentagem
$("#valor_rateado").blur(function () {
    var valorTotalItens = Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
    }).format($("#valorTotal").val());

    valorTotalDespesa = Number(
        valorTotalItens.replace(/\./g, "").replace(",", ".").replace("R$", "")
    );

    novoValorTotal = $("#modal_valor_total").val()
    .replace(/\./g, "")
    .replace(",", ".")
    .replace("R$", "");


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
    var porcentagem = valorRateio / novoValorTotal;

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


    novoValorTotal = $("#modal_valor_total").val()
    .replace(/\./g, "")
    .replace(",", ".")
    .replace("R$", "");

    var valorPorcentagem = Number($("#porcentagem_rateado").val());

    var porcentagem = novoValorTotal / 100;
    valorRateado = valorPorcentagem * porcentagem;


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

var rateios_contas = [];

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
    } else if (
        valorRateado > novoValorTotal ||
        valorTotalRateio + valorRateado > novoValorTotal ||
        valorTotalRateio > novoValorTotal
    ) {
        alert("Valor Rateado é maior que o valor total da despesa");
    }
       else {

        console.log({inst_banco:inst_banco});
        if (rateios_contas.includes(inst_banco)){
            $("#valor_rateado").val("");
            $("#porcentagem_rateado").val("");
            alert("Já foi adicionado um rateio para essa Conta por favor selecione outra conta.");
            limpaCamposRateio();
            console.log({inst_banco:inst_banco});
        }
        else{
            rateios_contas.push(inst_banco);
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
                    `<input type="hidden"  name="valor_pago" value="${novoValorTotal}"/>` +
                    `</div>`
            );

            if (valorTotalRateio == novoValorTotal) {
                btnSalvar.disabled = false;
            }

            id_button_conta++;
            limpaCamposRateio();
        }


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
        var juros = $("#hiddemJuros").val();
        var multa = $("#hiddemMulta").val();

        SOMA = Number(juros) + Number(multa) + Number(valorTotal);

        SOMA = Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(SOMA);
        novoValorTotal = SOMA
        $("#modal_valor_total").val(novoValorTotal);
    }
   else if ($("#hiddemDesconto").val() != "" && $("#hiddemDesconto").val() != null) {
            var desconto = $("#hiddemDesconto").val();
            SUB = (Number(valorTotal) - Number(desconto));
            SUB = Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL",
            }).format(SUB);
            novoValorTotal = SUB
            $("#modal_valor_total").val(novoValorTotal);
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

    if( (Number(desconto) >= Number(valorTotal) )){
        alert("Valor do Desconto é superio ao VALOR ORIGINAL DA DESPESA por favor verifique os valores digitado !");
    }
    else if(Number(soma) >  Number(valorTotal)){
        alert("Valor do Juros e Multa é superio ao VALOR ORIGINAL DA DESPESA por favor verifique os valores digitados !");
    }
     else{
         // adiciona os valores do que e digitado no modal ADICIONAR JUROS E MULTAS

          jurosForamatado = Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL",
            }).format(juros)

            multaForamatado = Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL",
            }).format(multa)

            descontoForamatado = Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL",
            }).format(desconto)


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

    }



});
