var idFornecedor;
$(document).ready(function () {
    idFornecedor = 0;
    //Seleciona quais campos irão aparecer na tela
    $('input:radio[name="seleciona_tela"]').on("change", function () {
        if (this.checked && this.value == "1") {
            $("#campo_razao_social").show();
            $(
                "#input-custom-field4, #input-custom-field5, #input-custom-field6"
            ).hide();
        } else {
            $(
                "#input-custom-field4, #input-custom-field5, #input-custom-field6"
            ).show();
            $("#campo_razao_social").hide();
        }
    });

    //fazer requisição ajax para buscar classificação contabil
    $.ajax({
        type: "GET",
        url: `http://localhost:8000/classificacao-contabil`,
        dataType: "json",
    })
        .done(function (response) {
            //traz os resultados do banco para uma div hidden
            $.each(response, function (key, val) {
                $("#itens_classificacao")
                    .append(
                        `<div class="classificacao" value="${val.id_clasificacao_contabil}">${val.de_clasificacao_contabil}</div>`
                    )
                    .hide();
            });
            //ao clicar aparece os campos com resultados do banco
            $("#classificacao_con").click(function () {
                $("#itens_classificacao").show();
            });
            //ao clicar em um item da lista, o campo recebe o valor do item
            $(".classificacao").click(function () {
                $("#classificacao_con").val($(this).text());
                $("#itens_classificacao").hide();

                var id_classificacao = $(this).attr("value");
                //a cada nova requisição, limpa o option do select
                $("#tipo_classificacao").html("");
                //faz a requisição ajax para buscar tipo de classificação
                $.ajax({
                    type: "GET",
                    url: `http://localhost:8000/classificacao-contabil/${id_classificacao}`,
                    dataType: "json",
                }).done(function (response) {
                    //mostra os resultados da busca em uma div
                    $.each(response, function (key, val) {
                        $("#tipo_classificacao").append(
                            `<option value="${val.id_plano_contas}">${val.de_plano_contas}</option>`
                        );
                    });
                });
            });
        })
        .fail(function () {
            console.log("erro na requisição Ajax");
        });

    // INICIO FAZ A REQUISIÇÃO DA CLASSIFICAÇAO DO TIPO DO PRODUTO E O PRODUTO

    $.ajax({
        type: "GET",
        url: `http://localhost:8000/produto/classificacao`,
        dataType: "json",
    })
        .done(function (response) {
            //traz os resultados do banco para uma div hidden
            $.each(response, function (key, val) {
                $("#classificacao_tipo_produto")
                    .append(
                        `<div class="classificacao" value="${val.id_tipo_produto}">${val.de_tipo_produto}</div>`
                    )
                    .hide();
            });
            //ao clicar aparece os campos com resultados do banco
            $("#classificacao_prod").click(function () {
                $("#classificacao_tipo_produto").show();
            });
            //ao clicar em um item da lista, o campo recebe o valor do item
            $(".classificacao").click(function () {
                $("#classificacao_prod").val($(this).text());
                $("#classificacao_tipo_produto").hide();

                var id_classificacao = $(this).attr("value");
                //a cada nova requisição, limpa o option do select
                $("#produto_servico").html("");
                //faz a requisição ajax para buscar tipo de classificação
                $.ajax({
                    type: "GET",
                    url: `http://localhost:8000/produto/classificacao/${id_classificacao}`,
                    dataType: "json",
                }).done(function (response) {
                    //mostra os resultados da busca em uma div
                    $.each(response, function (key, val) {
                        $("#produto_servico").append(
                            `<option value="${val.id_produto}">${val.de_produto}</option>`
                        );
                    });
                });
            });
        })
        .fail(function () {
            console.log("erro na requisição Ajax");
        });

    // FIM FAZ A REQUISIÇÃO DA CLASSIFICAÇAO DO TIPO DO PRODUTO E O PRODUTO

    // INICIO FAZ A REQUISIÇÃO DA CLASSIFICAÇAO DO TIPO DO SERVICO E O SERVICO

    $.ajax({
        type: "GET",
        url: `http://localhost:8000/servico/classificacao`,
        dataType: "json",
    })
        .done(function (response) {
            //traz os resultados do banco para uma div hidden
            $.each(response, function (key, val) {
                $("#classificacao_tipo_servico")
                    .append(
                        `<div class="classificacao" value="${val.id_tipo_servico}">${val.de_tipo_servico}</div>`
                    )
                    .hide();
            });
            //ao clicar aparece os campos com resultados do banco
            $("#classificacao_serv").click(function () {
                $("#classificacao_tipo_servico").show();
            });
            //ao clicar em um item da lista, o campo recebe o valor do item
            $(".classificacao").click(function () {
                $("#classificacao_serv").val($(this).text());
                $("#classificacao_tipo_servico").hide();

                var id_classificacao = $(this).attr("value");
                //a cada nova requisição, limpa o option do select
                $("#servico").html("");
                //faz a requisição ajax para buscar tipo de classificação
                $.ajax({
                    type: "GET",
                    url: `http://localhost:8000/servico/classificacao/${id_classificacao}`,
                    dataType: "json",
                }).done(function (response) {
                    //mostra os resultados da busca em uma div
                    $.each(response, function (key, val) {
                        $("#servico").append(
                            `<option value="${val.id_servico}">${val.de_servico}</option>`
                        );
                    });
                });
            });
        })
        .fail(function () {
            console.log("erro na requisição Ajax");
        });

    // FIM FAZ A REQUISIÇÃO DA CLASSIFICAÇAO DO TIPO DO SERVICO E O SERVICO
});

//função para buscar empresa
$("#busca_empresa").keyup(function () {
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
                    //console.log(id_empresa);
                    $("#id_busca_empresa").attr("value", id_empresa);
                    //busca centros de custo relacionados com a empresa e mostra no select
                    $("#results_empresa").html("");
                    $.ajax({
                        type: "GET",
                        url: `http://localhost:8000/centroCustoEmpresa/${id_empresa}`,
                        dataType: "json",
                    }).done(function (response) {
                        //mostra os resultados da busca em uma div
                        $.each(response, function (key, val) {
                            $("#empresa").append(
                                `<option value="${
                                    val.id_centro_custo
                                }" class="centro_custo_item">${
                                    val.de_carteira == ""
                                        ? val.de_departamento
                                        : val.de_departamento +
                                          " - " +
                                          val.de_carteira
                                }</option>`
                            );
                        });
                    });
                });
            })
            .fail(function () {
                $("#results_empresa").html("");
            });
    } else {
        $("#results_empresa").html("");
    }
});

//seleciona tipo de despesa
document.getElementById("btnDespesa").onclick = function () {
    var radios = document.getElementsByName("tipo_despesa");
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            if (radios[i].value == "fornecedor") {
                document.getElementById("titulo-modal").innerHTML =
                    "Adicionar Fornecedor";
                document.getElementById("tipo-documento").innerHTML =
                    "CNPJ/CPF";

                // Inico da busca dos cnpj/cpf dos fornecedores
                $("#Cnpj_Cpf").keyup(function () {
                    var digitoCnpjCpf = $(this).val();

                    if (digitoCnpjCpf != "") {
                        $.ajax({
                            url: `/fornecedores/cnpj_cpf/${digitoCnpjCpf}`,
                            type: "GET",
                            dataType: "json",
                        })
                            .done(function (response) {
                                $("#ResultadoCnpjCpf").html("");
                                //mostra os resultados da busca em uma div
                                $.each(response, function (key, val) {
                                    $("#ResultadoCnpjCpf").append(
                                        `<div class="item" value="${val.nu_cpf_cnpj}">${val.nu_cpf_cnpj} --- ${val.de_razao_social} </div>`
                                    );
                                });
                                //seleciona o cnpj ou cpf desejada
                                $(".item").click(function () {
                                    $("#Cnpj_Cpf").val($(this).text());
                                    var cpfFornecedor = $(this).attr("value");

                                    $("#ResultadoCnpjCpf").html("");
                                    // preenche o campo de input_cpf_cnpj e o input_razao_social com base no item anterior
                                    $.ajax({
                                        type: "GET",
                                        url: `/fornecedores/cnpj_cpf/${cpfFornecedor}`,
                                        dataType: "json",
                                    }).done(function (response) {
                                        //armazena id do fonecedor em uma variavel;
                                        idFornecedor =
                                            response[0].id_fornecedor;

                                        $("#btnCnpj_Cpf").click(function () {
                                            $("#input_cpf_cnpj").val(
                                                response[0].nu_cpf_cnpj
                                            );
                                            $("#input_razao_social").val(
                                                response[0].de_razao_social
                                            );

                                            $("#fk_empregado_fornecedor").attr(
                                                "value",
                                                response[0].id_fornecedor
                                            );

                                            $("#Cnpj_Cpf").val("");
                                            $("#modal-busca").modal("hide");
                                        });
                                    });
                                });
                            })
                            .fail(function () {
                                $("#Cnpj_Cpf").val("");
                                $("#ResultadoCnpjCpf").html("");
                            });
                    } else {
                        $("#ResultadoCnpjCpf").html("");
                    }
                });
                // fim da busca dos cnpj/cpf dos fornecedores
            }
            if (radios[i].value == "empregado") {
                document.getElementById("titulo-modal").innerHTML =
                    "Adicionar Empregado";
                document.getElementById("tipo-documento").innerHTML = "CPF";

                // Inicio da busca dos cpf dos empregodos
                $("#Cnpj_Cpf").keyup(function () {
                    var digitoCpf = $(this).val();

                    if (digitoCpf != "") {
                        $.ajax({
                            url: `/empregados/cpf/${digitoCpf}`,
                            type: "GET",
                            dataType: "json",
                        })
                            .done(function (response) {
                                $("#ResultadoCnpjCpf").html("");
                                //mostra os resultados da busca em uma div
                                $.each(response, function (key, val) {
                                    $("#ResultadoCnpjCpf").append(
                                        `<div class="item" value="${val.nu_cpf_cnpj}">${val.nu_cpf_cnpj} --- ${val.nome_empregado} </div>`
                                    );
                                });
                                //seleciona o cnpj ou cpf desejada
                                $(".item").click(function () {
                                    $("#Cnpj_Cpf").val($(this).text());
                                    var idEmpregado = $(this).attr("value");

                                    $("#ResultadoCnpjCpf").html("");
                                    // preenche o campo de input_cpf_cnpj e o input_razao_social com base no item anterior
                                    $.ajax({
                                        type: "GET",
                                        url: `/empregados/cpf/${idEmpregado}`,
                                        dataType: "json",
                                    }).done(function (response) {
                                        $("#btnCnpj_Cpf").click(function () {
                                            $("#input_cpf_cnpj").val(
                                                response[0].nu_cpf_cnpj
                                            );
                                            $("#input_razao_social").val(
                                                response[0].nome_empregado
                                            );

                                            $("#fk_empregado_fornecedor").attr(
                                                "value",
                                                response[0].id_empregado
                                            );

                                            $("#Cnpj_Cpf").val("");
                                            $("#modal-busca").modal("hide");
                                        });
                                    });
                                });
                            })
                            .fail(function () {
                                $("#Cnpj_Cpf").val("");
                                $("#ResultadoCnpjCpf").html("");
                            });
                    } else {
                        $("#ResultadoCnpjCpf").html("");
                    }
                });
                // fim da busca dos cpf dos empregados
            }
        }
    }
};

var id_button_item = 0;
var totalItens = 0;
var valorTotal = 0;
var valorRemovido = 0;

$("#Prod").click(function () {
    //  pega os valores dos campos preenchidos pelo usuario
    var class_prod = $("#classificacao_prod").val();
    var prod_ser = $("#produto_servico").val();
    var valor_uni = $("#valor_item").val();
    var quanti = $("#quantidade").val();

    if (class_prod == "" || prod_ser == "" || valor_uni == "" || quanti == "") {
        alert("Preencha todos os campos do produto!");
    } else {
        // criar novos itens com os valores preenchidos anteriormente
        $("#Tb").append(
            `<tr id="tab${id_button_item}">` +
                `<td>${class_prod}</td>` +
                `<td>${prod_ser}</td>` +
                `<td>${valor_uni}</td>` +
                `<td>${quanti}</td>` +
                `<td><button type="button" class="btn btn-danger" onclick="removeItem(${id_button_item})" style="padding: 8px 12px;">` +
                `<i class="bi bi-trash-fill"></i>` +
                `</button></td>` +
                "</tr>"
        );
        //retira virgulas do valor unitário
        var valorFormatado = valor_uni.replace(".", "").replace(",", ".");
        //gera o input com os dados do item para submeter no form
        $("#hidden_inputs_itens").append(
            `<div id="input_generated_itens${id_button_item}">` +
                `<input type="hidden"  name="id_produto[]" value="${prod_ser}"/>` +
                `<input type="hidden" id="val_produto${id_button_item}" name="valor_unitario[]" value="${valorFormatado}"/>` +
                `<input type="hidden" name="quantidade[]" value="${quanti}"/>` +
                `</div>`
        );

        id_button_item++;
        //adiciona 1 ao total de itens
        totalItens++;

        // limpar campos do item
        $("#classificacao_prod").val("");
        $("#produto_servico").val("");
        $("#valor_item").val("");
        $("#quantidade").val("");

        // soma de todos os valores dos items
        Number(valorFormatado);
        Number(valorTotal);
        Number(quanti);

        valorTotal = valorTotal + valorFormatado * quanti;
        $("#valorTotal").attr("readonly", true);

        $("#valorTotal").val(tipoMoeda(valorTotal, moeda));
    }
});

var moeda = $("#moeda").val();
$("#moeda").click(function () {
    moeda = $(this).val();
    $("#valorTotal").val(tipoMoeda(valorTotal, moeda));
});

//remove o rateio da tabela e do form e subtrai valor do total
function removeItem(id) {
    valorRemovido = Number($(`#val_produto${id}`).val());
    //subtrai 1 ao total de itens
    totalItens--;

    valorTotal = valorTotal - valorRemovido;

    //verifica quantos itens existem na table e modifica o campo valorTotal para readonly caso seja difernte de 0
    if (totalItens == 0) {
        $("#valorTotal").attr("readonly", false);
    } else {
        $("#valorTotal").attr("readonly", true);
    }

    $(`#tab${id}`).remove();
    $(`#input_generated_itens${id}`).remove();
    $("#valorTotal").val(tipoMoeda(valorTotal, moeda));
}

//Buscar condição de pagamento no banco de dados com requisição via AJAX
$.ajax({
    type: "GET",
    url: `http://localhost:8000/condicao_pagamento`,
    dataType: "json",
})
    .done(function (response) {
        //traz os resultados do banco para uma div hidden
        $.each(response, function (key, val) {
            $("#itens_tipo_pagamento")
                .append(
                    `<div class="item_condicao_pagamento" value="${val.id_condicao_pagamento}">${val.de_condicao_pagamento}</div>`
                )
                .hide();
        });

        $("#condicao_pagamento").click(function () {
            $("#itens_tipo_pagamento").show();
        });

        $(".item_condicao_pagamento").click(function () {
            $("#condicao_pagamento").val($(this).text());
            $("#itens_tipo_pagamento").hide();

            var id_tipo_pagamento = $(this).attr("value");
            //tipos de pagamento  3 = Depósito; 6 = DOC; 7 = TED; 8 == Tranferência;
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
                        "<select class='form-control input-add remove_conta' id='contas_fornecedor'>" +
                        "<option value='' class='contas_fornecedor_resultado'></option>" +
                        "</select>"
                );

                $.ajax({
                    type: "GET",
                    url: `http://localhost:8000/contas-bancarias/fornecedor/${idFornecedor}`,
                    dataType: "json",
                }).done(function (response) {
                    //mostra os resultados da busca em uma div
                    $.each(response, function (key, val) {
                        $("#contas_fornecedor").append(
                            `<option class="contas_fornecedor_resultado" value="${val.id_conta_bancaria}">${val.co_banco} - ${val.de_banco} AG: ${val.nu_agencia} CONTA: ${val.nu_conta}</option>`
                        );
                    });
                });
            } else if (id_tipo_pagamento == 2) {
                limpaCamposContaBancariaPix();

                $("#conta_hidden").append(
                    "<strong class='remove_conta'>PIX DO FORNECEDOR</strong>" +
                        "<select class='form-control input-add remove_pix' id='pix_fornecedor'>" +
                        "<option value='' class='pix_fornecedor_resultado'></option>" +
                        "</select>"
                );

                $.ajax({
                    type: "GET",
                    url: `http://localhost:8000/pix/fornecedor/${idFornecedor}`,
                    dataType: "json",
                }).done(function (response) {
                    $.each(response, function (key, val) {
                        $("#pix_fornecedor").append(
                            `<option class="pix_fornecedor_resultado" value="${val.id_pix}">${val.de_tipo_pix} - ${val.de_pix}</option>`
                        );
                    });
                });
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
    $(".remove_conta").remove();
    $(".remove_pix").remove();
    $("#contas_fornecedor").empty();
    $("#pix_fornecedor").empty();
}

//Fim de busca de condição de pagamento
