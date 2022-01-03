//inicio função para buscar empresa
var conta_bancaria;
$("#busca_empresa").keyup(
    delay(function() {
        var words = $(this).val();
        if (words != "") {
            //requisição ajax para buscar empresa
            $.ajax({
                    type: "GET",
                    url: `http://localhost:8000/empresas/nome/${words}`,
                    dataType: "json",
                })
                //caso a requisição seja bem sucedida
                .done(function(response) {
                    $("#results_empresa").html("");
                    //mostra os resultados da busca em uma div
                    $.each(response, function(key, val) {
                        $("#results_empresa").append(
                            `<div class="item" value="${val.id_empresa}">${val.de_empresa} - ${val.regiao_empresa} </div>`
                        );
                    });
                    //seleciona a empresa desejada
                    $(".item").click(function() {
                        $("#busca_empresa").val($(this).text());
                        $("#empresa").html("");
                        var id_empresa = $(this).attr("value");
                        console.log(id_empresa);
                        // console.log(id_empresa);
                        $("#id_busca_empresa").attr("value", id_empresa);
                        //busca centros de custo relacionados com a empresa e mostra no select
                        $("#results_empresa").html("");
                        $.ajax({
                            type: "GET",
                            url: `/lancamentos/filtro-empresaContas/${id_empresa}`,
                            dataType: "json",
                        }).done(
                            delay(function(response) {
                                $("#Resultado_inst_banco").html("");
                                // mostra os resultado do nome do banco e coloca em um div
                                $.each(response, function(key, val) {
                                    $("#Resultado_inst_banco").append(
                                        `<div class="item" value="${val.id_conta_bancaria}" >${val.de_banco} -- AG: ${val.nu_agencia} -- CONTA: ${val.nu_conta}</div>`
                                    );
                                });
                                // SELECIONAR CONTAS DAS INSTITUIÇÕES BANCARIAS PERTECENTE A EMPRESA
                                $(".item").click(function() {
                                    $("#inst_banco").val($(this).text());
                                    $("#Resultado_inst_banco").html("");
                                    conta_bancaria = $(this).attr("value");
                                    $("#inst_banco").val($(this).text());
                                });
                            }), 500);
                    });
                })
                .fail(function() {
                    $("#results_empresa").html("");
                });
        } else {
            $("#results_empresa").html("");
        }
    }, 500));
//FIM função para buscar empresa

var valorTotalRateio = 0;
var valorRateado = 0;
var valorTotalDespesa = 0;

//informa o valor e gera a porcentagem
$("#valor_rateado").blur(function() {
    var valorTotalItens = $("#valorTotal").val();
    valorTotalDespesa = valorTotalItens
        .replace(".", "")
        .replace(",", ".")
        .replace("R$", "");

    console.log(valorTotalDespesa, "<<<<< valor total despesa");

    valorRateado = Number(
        $("#valor_rateado").val().replace(",", ".").replace("R$", "")
    );

    if (valorTotalItens == "") {
        alert("Adicione os itens ou o valor total da despesa");
        $("#valor_rateado").val("");
    }

    var valorRateio = valorRateado * 100;
    var porcentagem = valorRateio / valorTotalDespesa;

    $("#porcentagem_rateado").val(porcentagem.toFixed(2));
});


var id_button_conta = 0;

// INICIO função para buscar Instituição bancaria
$("#addContas").click(function() {
    //  pega os valores dos campos preenchidos pelo usuario
    var inst_banco = $("#inst_banco").val();
    var porcentagem_valor = $("#porcentagem_rateado").val();
    var valor_rateado = $("#valor_rateado").val();
    var data_efetivo_pag = $("#data_efetivo_pag").val();
    var rateio_empresa = $("#busca_empresa").val();

    console.log(conta_bancaria);

    console.log(inst_banco, valor_rateado, data_efetivo_pag);

    valorTotalDespesa = $("#valorTotal")
        .val()
        .replace(".", "")
        .replace(".", "")
        .replace(".", "")
        .replace(",", ".")
        .replace("R$", "");


    if (inst_banco == "" || valor_rateado == "" || data_efetivo_pag == "") {
        alert("Preencha todos os campos da Conta !");
    } else {
        // criar novos itens com os valores preenchidos anteriormente
        dataFormatada(data_efetivo_pag);
        $("#Tb").append(
            `<tr id="tab_conta${id_button_conta}">` +
            `<td>${rateio_empresa}</td>` +
            `<td>${inst_banco}</td>` +
            `<td>${valor_rateado}</td>` +
            `<td>${dataFormatada(data_efetivo_pag)}</td>` +
            `<td>${porcentagem_valor}</td>` +
            `<td><button type="button" class="btn btn-danger" onclick="removeConta(${id_button_conta})" style="padding: 8px 12px;">` +
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
            `<input type="hidden" name="dt_inicio[]" value="${data_efetivo_pag}"/>` +
            `</div>`
        );

        id_button_conta++;
        limpaCamposRateio();
    }
});
// Fim função para buscar Instituição bancaria



//remove a da tabela e das contas
function removeConta(id) {
    console.log(id);
    $(`#tab_conta${id}`).remove();
    $(`#input_generated_account${id}`).remove();

}

// Formata input data
$("#data_efetivo_pag").on("change", function() {
    data_efetivo_pag = $(this).val();
    console.log(data_efetivo_pag, "aqui");
    return data_efetivo_pag;
})





function limpaCamposRateio() {
    $("#busca_empresa").val("");
    $("#inst_banco").val("");
    $("#porcentagem_rateado").val("");
    $("#valor_rateado").val("");
    $("#data_efetivo_pag").val("");
}



$(document).ready(function() {
    $("#modal_valor_rateado").val("0,00");
});


//informa a porcentagem e gera o valor do rateio
$("#porcentagem_rateado").blur(function() {
    var valorTotalItens = $("#valorTotal").val();
    valorTotalDespesa = valorTotalItens
        .replace(".", "")
        .replace(",", ".")
        .replace("R$", "");

    var valorPorcentagem = Number($("#porcentagem_rateado").val());

    var porcentagem = valorTotalDespesa / 100;
    valorRateado = valorPorcentagem * porcentagem;
    $("#valor_rateado").val(tipoMoeda(valorRateado, "real"));
});



//remove o rateio da tabela e do form
function removeRateio(id, valorRateado) {
    //subtrai o valor removido do valor total do rateio
    valorTotalRateio = valorTotalRateio - valorRateado;
    //atualiza o valor total do rateio no input
    $("#modal_valor_rateado").val(valorTotalRateio.toFixed(2));

    $(`#tab-generated${id}`).remove();
    $(`#input-generated${id}`).remove();
}

//adiciona valor total ao input acima do modal de rateio
$("#adicionar_rateio").click(function() {
    var valorTotal = $("#valorTotal").val();
    $("#modal_valor_total").val(valorTotal);
});






// FORMATAR CAMPO DE DATAS
var inputDataInicio;
var inputDataFim;
$("#inputDataInicio").on("click", function() {
    inputDataInicio = $(this).val();
    $("#inputDataFim").prop("min", function() {

        return inputDataInicio;
    })
    console.log(inputDataInicio);
    $("#inputDataFim").on("click", function() {
        inputDataFim = $(this).val();
        $("#inputDataInicio").prop("max", function() {
            return inputDataFim;
        })


    })

    console.log($("#inputDataFim").val().toString());
    if (inputDataInicio != "" && inputDataFim != "") {
        $.ajax({
            type: "GET",
            url: `/lancamentos/filtro-periodo/${inputDataInicio}/${inputDataFim}`,
            dataType: "json"
        }).done(function(response) {

        })
    }

})

// inputStatus e da tela de lista-lancamentos
var input = $("inputStatus :selected").val()

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
