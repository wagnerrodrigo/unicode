$(document).ready(function() {
    //Seleciona quais campos irão aparecer na tela
    $('input:radio[name="seleciona_tela"]').on("change", function() {
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
        .done(function(response) {
            //traz os resultados do banco para uma div hidden
            $.each(response, function(key, val) {
                $("#itens_classificacao")
                    .append(
                        `<div class="classificacao" value="${val.id_clasificacao_contabil}">${val.de_clasificacao_contabil}</div>`
                    )
                    .hide();
            });
            //ao clicar aparece os campos com resultados do banco
            $("#classificacao_con").click(function() {
                $("#itens_classificacao").show();
            });
            //ao clicar em um item da lista, o campo recebe o valor do item
            $(".classificacao").click(function() {
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
                }).done(function(response) {
                    //mostra os resultados da busca em uma div
                    $.each(response, function(key, val) {
                        $("#tipo_classificacao").append(
                            `<option value="${val.id_plano_contas}">${val.de_plano_contas}</option>`
                        );
                    });
                });
            });
        })
        .fail(function() {
            console.log("erro na requisição Ajax");
        });

    // INICIO FAZ A REQUISIÇÃO DA CLASSIFICAÇAO DO TIPO DO PRODUTO E O PRODUTO

    $.ajax({
            type: "GET",
            url: `http://localhost:8000/produto/classificacao`,
            dataType: "json",
        })
        .done(function(response) {
            //traz os resultados do banco para uma div hidden
            $.each(response, function(key, val) {
                $("#classificacao_tipo_produto")
                    .append(
                        `<div class="classificacao" value="${val.id_tipo_produto}">${val.de_tipo_produto}</div>`
                    )
                    .hide();
            });
            //ao clicar aparece os campos com resultados do banco
            $("#classificacao_prod").click(function() {
                $("#classificacao_tipo_produto").show();
            });
            //ao clicar em um item da lista, o campo recebe o valor do item
            $(".classificacao").click(function() {
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
                }).done(function(response) {
                    //mostra os resultados da busca em uma div
                    $.each(response, function(key, val) {
                        $("#produto_servico").append(
                            `<option value="${val.id_produto}">${val.de_produto}</option>`
                        );
                    });
                });
            });
        })
        .fail(function() {
            console.log("erro na requisição Ajax");
        });

    // FIM FAZ A REQUISIÇÃO DA CLASSIFICAÇAO DO TIPO DO PRODUTO E O PRODUTO

    // INICIO FAZ A REQUISIÇÃO DA CLASSIFICAÇAO DO TIPO DO SERVICO E O SERVICO

    $.ajax({
            type: "GET",
            url: `http://localhost:8000/servico/classificacao`,
            dataType: "json",
        })
        .done(function(response) {
            //traz os resultados do banco para uma div hidden
            $.each(response, function(key, val) {
                $("#classificacao_tipo_servico")
                    .append(
                        `<div class="classificacao" value="${val.id_tipo_servico}">${val.de_tipo_servico}</div>`
                    )
                    .hide();
            });
            //ao clicar aparece os campos com resultados do banco
            $("#classificacao_serv").click(function() {
                $("#classificacao_tipo_servico").show();
            });
            //ao clicar em um item da lista, o campo recebe o valor do item
            $(".classificacao").click(function() {
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
                }).done(function(response) {
                    //mostra os resultados da busca em uma div
                    $.each(response, function(key, val) {
                        $("#servico").append(
                            `<option value="${val.id_servico}">${val.de_servico}</option>`
                        );
                    });
                });
            });
        })
        .fail(function() {
            console.log("erro na requisição Ajax");
        });

    // FIM FAZ A REQUISIÇÃO DA CLASSIFICAÇAO DO TIPO DO SERVICO E O SERVICO
});

//Buscar condição de pagamento no banco de dados com requisição via AJAX

$.ajax({
        type: "GET",
        url: `http://localhost:8000/condicao_pagamento`,
        dataType: "json",
    })
    .done(function(response) {
        //traz os resultados do banco para uma div hidden
        $.each(response, function(key, val) {
            $("#condicao_pagamento").append(
                `<option class="classificacao" value="${val.id_condicao_pagamento}">${val.de_condicao_pagamento}</option>`
            );
        });
    })
    .fail(function() {
        console.log("erro na requisição Ajax");
    });

//Fim de busca de condição de pagamento

//função para buscar empresa
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
                    //console.log(id_empresa);
                    $("#id_busca_empresa").attr("value", id_empresa);
                    //busca centros de custo relacionados com a empresa e mostra no select
                    $("#results_empresa").html("");
                    $.ajax({
                        type: "GET",
                        url: `http://localhost:8000/centroCustoEmpresa/${id_empresa}`,
                        dataType: "json",
                    }).done(function(response) {
                        //mostra os resultados da busca em uma div
                        $.each(response, function(key, val) {
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
            .fail(function() {
                $("#results_empresa").html("");
            });
    } else {
        $("#results_empresa").html("");
    }
});

//seleciona tipo de despesa
document.getElementById("btnDespesa").onclick = function() {
    var radios = document.getElementsByName("tipo_despesa");
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            if (radios[i].value == "fornecedor") {
                document.getElementById("titulo-modal").innerHTML =
                    "Adicionar Fornecedor";
                document.getElementById("tipo-documento").innerHTML =
                    "CNPJ/CPF";

                // Inico da busca dos cnpj/cpf dos fornecedores
                $("#Cnpj_Cpf").keyup(function() {
                    var digitoCnpjCpf = $(this).val();

                    if (digitoCnpjCpf != "") {
                        $.ajax({
                                url: `/fornecedores/cnpj_cpf/${digitoCnpjCpf}`,
                                type: "GET",
                                dataType: "json",
                            })
                            .done(function(response) {
                                $("#ResultadoCnpjCpf").html("");
                                //mostra os resultados da busca em uma div
                                $.each(response, function(key, val) {
                                    $("#ResultadoCnpjCpf").append(
                                        `<div class="item" value="${val.nu_cpf_cnpj}">${val.nu_cpf_cnpj} --- ${val.de_razao_social} </div>`
                                    );
                                });
                                //seleciona o cnpj ou cpf desejada
                                $(".item").click(function() {
                                    $("#Cnpj_Cpf").val($(this).text());
                                    var idFornecedor = $(this).attr("value");

                                    $("#ResultadoCnpjCpf").html("");
                                    // preenche o campo de input_cpf_cnpj e o input_razao_social com base no item anterior
                                    $.ajax({
                                        type: "GET",
                                        url: `/fornecedores/cnpj_cpf/${idFornecedor}`,
                                        dataType: "json",
                                    }).done(function(response) {
                                        $("#btnCnpj_Cpf").click(function() {
                                            $("#input_cpf_cnpj").val(
                                                response[0].nu_cpf_cnpj
                                            );
                                            $("#input_razao_social").val(
                                                response[0].de_razao_social
                                            );
                                            $("#Cnpj_Cpf").val("");
                                            $("#modal-busca").modal("hide");
                                        });
                                    });
                                });
                            })
                            .fail(function() {
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
                $("#Cnpj_Cpf").keyup(function() {
                    var digitoCpf = $(this).val();

                    if (digitoCpf != "") {
                        $.ajax({
                                url: `/empregados/cpf/${digitoCpf}`,
                                type: "GET",
                                dataType: "json",
                            })
                            .done(function(response) {
                                $("#ResultadoCnpjCpf").html("");
                                //mostra os resultados da busca em uma div
                                $.each(response, function(key, val) {
                                    $("#ResultadoCnpjCpf").append(
                                        `<div class="item" value="${val.nu_cpf_cnpj}">${val.nu_cpf_cnpj} --- ${val.nome_empregado} </div>`
                                    );
                                });
                                //seleciona o cnpj ou cpf desejada
                                $(".item").click(function() {
                                    $("#Cnpj_Cpf").val($(this).text());
                                    var idEmpregado = $(this).attr("value");

                                    $("#ResultadoCnpjCpf").html("");
                                    // preenche o campo de input_cpf_cnpj e o input_razao_social com base no item anterior
                                    $.ajax({
                                        type: "GET",
                                        url: `/empregados/cpf/${idEmpregado}`,
                                        dataType: "json",
                                    }).done(function(response) {
                                        $("#btnCnpj_Cpf").click(function() {
                                            $("#input_cpf_cnpj").val(
                                                response[0].nu_cpf_cnpj
                                            );
                                            $("#input_razao_social").val(
                                                response[0].nome_empregado
                                            );
                                            $("#Cnpj_Cpf").val("");
                                            $("#modal-busca").modal("hide");
                                        });
                                    });
                                });
                            })
                            .fail(function() {
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

var valorTotal = 0;
$("#Prod").click(function() {
    //  pega os valores dos campos preenchidos pelo usuario
    var class_prod = $("#classificacao_prod").val();
    var prod_ser = $("#produto_servico").val();
    var valor_uni = $("#valor_item").val();
    var quanti = $("#quantidade").val();
    var valor_tl = parseFloat(valor_uni * quanti);
    var btnDeletar = `<td><button type="button" class="btn btn-danger" id="remover" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></button></td>`;
    var html = "";

    // criar novos itens com os valores preenchidos anteriormente
    html += '<tr id="tab">';
    html += `<td>${class_prod}</td>`;
    html += `<td>${prod_ser}</td>`;
    html += `<td>${valor_uni}</td>`;
    html += `<td>${quanti}</td>`;
    html += `${btnDeletar}`;
    html += `<input type="hidden" name="input1"  value="${class_prod}"/>`;
    html += `<input type="hidden" name="input2" value="${prod_ser}"/>`;
    html += `<input type="hidden" name="input3" value="${valor_uni}"/>`;
    html += `<input type="hidden" name="input4" value="${quanti}"/>`;
    html += "</tr>";
    $("#Tb").append(html);

    // limpar campos do item
    $("#classificacao_prod").val("");
    $("#produto_servico").val("");
    $("#valor_item").val("");
    $("#quantidade").val("");

    // soma de todos os valores dos items
    valorTotal = valorTotal += valor_tl;
    $("#valorTotal").val(valorTotal);
});

// remove o item da despesa
$(document).on("click", "#remover", function() {
    $("#acao_titulo").hide(); // oculta a th acao da tela
    $("#acao_dados").hide(); // oculta a th botão de acao da tela
    $("#tab").remove();
});
// remover o style da th (acao) da tela
$(document).on("click", "#Prod", function() {
    $("#acao_titulo").removeAttr("style");
    $("#acao_dados").removeAttr("style");
});