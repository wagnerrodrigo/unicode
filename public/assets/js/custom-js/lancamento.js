//inicio função para buscar empresa
$("#busca_empresa").keyup(function() {
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
                    }).done(function(response) {
                        $("#Resultado_inst_banco").html("");
                        // mostra os resultado do nome do banco e coloca em um div
                        $.each(response, function(key, val) {
                            $("#Resultado_inst_banco").append(
                                `<div class="item" value="${val.nu_agencia}" >${val.de_banco} -- AG: ${val.nu_agencia} -- CONTA: ${val.nu_conta}</div>`
                            );
                        });
                        // SELECIONAR CONTAS DAS INSTITUIÇÕES BANCARIAS PERTECENTE A EMPRESA
                        $(".item").click(function() {
                            $("#inst_banco").val($(this).text());
                            $("#Resultado_inst_banco").html("");
                            var nu_agencia = $(this).attr("value");

                            //busca as instituições bancarias relacionados com a agencia e mostra no select
                            $("#id_inst_banco").attr("value", nu_agencia);
                            $("#Resultado_inst_banco").html("");

                            // a cada nova requisição, limpa o option do select
                            $("#agencia").html("");
                            $.ajax({
                                    type: "GET",
                                    url: `/lancamentos/info-agencia/${nu_agencia}`,
                                    dataType: "json",
                                })
                                .done(function(response) {
                                    //mostra os resultados da busca em um select
                                    $.each(response, function(key, val) {
                                        $("#agencia").append(
                                            `<option selectd class="item" value="${val.nu_agencia}" >${val.nu_agencia}</option>`
                                            // Se a instuição bancaria não possuir um numero de agencia cadastrada informa a mensagem
                                        );
                                    });

                                });
                            $("#id_inst_banco").attr("value", nu_agencia);
                            $("#conta_banco").html("");
                            var nu_conta = $(this).attr("value");
                            console.log(nu_conta);
                            // a cada nova requisição, limpa o option do select
                            $.ajax({
                                //mostra os resultados da busca em um select
                                type: "GET",
                                url: `/lancamentos/info-contaBancaria/${nu_conta}`,
                                dataType: "json",
                            }).done(function(response) {
                                $.each(response, function(key, val) {
                                    $("#conta_banco").append(
                                        `<option selectd class="item" value="${val.nu_conta}" >${
                                        val.nu_conta !== ""
                                        ? val.nu_conta 
                                        : " ---- Número da Conta Bancaria não cadastrado ----"
                                    }</option>`
                                        // Se a agência não possuir um numero de Conta bancaria cadastrada informa a mensagem
                                    );
                                })
                            })
                        });
                    });
                });
            })
            .fail(function() {
                $("#results_empresa").html("");
            });
    } else {
        $("#results_empresa").html("");
    }
});
//FIM função para buscar empresa


var id_button_conta = 0;

// INICIO função para buscar Instituição bancaria
$("#addContas").click(function() {
    //  pega os valores dos campos preenchidos pelo usuario
    var inst_banco = $("#inst_banco").val();
    var porcentagem_rateado = $("#porcentagem_rateado").val();
    var valor_rateado = $("#valor_rateado").val();
    var data_efetivo_pag = $("#data_efetivo_pag").val();



    console.log(inst_banco, valor_rateado, data_efetivo_pag);

    if (inst_banco == "" || valor_rateado == "" || data_efetivo_pag == "") {
        alert("Preencha todos os campos da Conta !");
    } else {
        // criar novos itens com os valores preenchidos anteriormente
        dataFormatada(data_efetivo_pag);
        $("#Tb").append(
            `<tr id="tab_conta${id_button_conta}">` +
            `<td>${inst_banco}</td>` +
            `<td>${valor_rateado}</td>` +
            `<td>${dataFormatada(data_efetivo_pag)}</td>` +
            `<td>${porcentagem_rateado}</td>` +
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
            `<input type="hidden"  name="id_inst_banco[]" value="${inst_banco}"/>` +
            `<input type="hidden" id="valor_rateado${id_button_conta}" name="valor_rateado[]" value="${valor_rateado}"/>` +
            `<input type="hidden" name="data_efetivo_pag[]" value="${data_efetivo_pag}"/>` +
            `</div>`
        );

        id_button_conta++;
        limpaCamposRateio();

        // limpar campos do item

        // soma de todos os valores dos items
        Number(valorFormatado);
        Number(valorTotal);
        Number(quanti);

        valorTotal = valorTotal + valorFormatado * quanti;
        $("#valorTotal").attr("readonly", true);

        $("#valorTotal").val(tipoMoeda(valorTotal, moeda));
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

var valorTotalRateio = 0;
var valorRateado = 0;
var valorTotalDespesa = 0;

//informa o valor e gera a porcentagem
$("#valor_rateado").blur(function() {
    var valorTotalItens = $("#valorDespesa").val();
    ValorTotalDespesa = valorTotalItens
        .replace(".", "")
        .replace(",", ".")
        .replace("R$", "");

    valorRateado = Number(
        $("#valor_rateado").val().replace(",", ".").replace("R$", "")
    );

    if (valorTotalItens == "") {
        alert("Adicione os itens ou o valor total da despesa");
        $("#valor_rateado").val("");
    }

    var valorRateio = valorRateado * 100;
    var porcentagem = valorRateio / ValorTotalDespesa;

    $("#porcentagem_rateado").val(porcentagem.toFixed(2));
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

//id utilizado para autoincrementar os ids dos inputs e tabelas ao adicionar um rateio
var id_button_rateio = 0;
//função para pegar os valores dos inputs e adicionar na tabela
$("#seleciona_rateio").click(function() {
    var rateio_empresa = $("#rateio_empresa").val();
    var custo_rateio = $("#custo_rateio").val();
    var valor_rateado = $("#valor_rateado").val();
    var porcentagem_valor = $("#porcentagem_rateado").val();

    valorTotalDespesa = $("#valorTotal")
        .val()
        .replace(".", "")
        .replace(",", ".")
        .replace("R$", "");

    if (
        rateio_empresa != "" &&
        custo_rateio != "" &&
        valor_rateado != "" &&
        porcentagem_valor != ""
    ) {
        if (
            valorRateado > valorTotalDespesa ||
            valorTotalRateio + valorRateado > valorTotalDespesa ||
            valorTotalRateio > valorTotalDespesa
        ) {
            alert("Valor maior que o valor total da despesa");
            $("#valor_rateado").val("");
        } else if (valorRateado == 0) {
            alert("O valor rateado não pode ser 0");
        } else {
            valorTotalRateio = valorTotalRateio + valorRateado;
            $("#modal_valor_rateado").val(valorTotalRateio.toFixed(2));

            //gera a tabela com os dados do rateio
            $("#table_rateio").append(
                `<tr id="tab-generated${id_button_rateio}">` +
                `<td>${rateio_empresa}</td>` +
                `<td>${custo_rateio}</td>` +
                `<td>${valor_rateado}</td>` +
                `<td>${porcentagem_valor}</td>` +
                `<td><button onclick="removeRateio(${id_button_rateio}, ${valor_rateado})" class="btn btn-danger btn-sm btn-delete-rateio">Excluir</button></td>` +
                "</tr>"
            );

            //gera o input com os dados do rateio para submeter no form
            $("#hidden_inputs").append(
                `<div id="input-generated${id_button_rateio}"><input type="hidden" name="empresa_rateio[]" value="${rateio_empresa}"/>` +
                `<input type="hidden" name="custo_rateio[]" value="${custo_rateio}"/>` +
                `<input type="hidden" name="valor_rateio[]" value="${valor_rateado}"/>` +
                `<input type="hidden" name="porcentagem_rateio[]" value="${porcentagem_valor}"/></div>`
            );

            id_button_rateio++;
            limpaCamposRateio();
        }
    } else {
        alert("Preencha todos os campos!");
    }
    valorRateado = 0;
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

console.log(input);