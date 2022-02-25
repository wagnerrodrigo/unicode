var idFornecedor;
var idEmpregado;
var tipoDespesa;
$(document).ready(function () {
    idFornecedor = 0;
    //fazer requisição ajax para buscar classificação contabil
    $.ajax({
        type: "GET",
        url: `/classificacao-contabil`,
        dataType: "json",
    })
        .done(function (response) {
            //traz os resultados do banco para uma div hidden
            $.each(response, function (key, val) {
                if (val.id_clasificacao_contabil != 11) {
                    $("#itens_classificacao")
                        .append(
                            `<div class="classificacao_despesa" value="${val.id_clasificacao_contabil}">${val.de_clasificacao_contabil}</div>`
                        )
                        .hide();
                }
            });
            //ao clicar aparece os campos com resultados do banco
            $("#classificacao_con").click(function () {
                $("#itens_classificacao").show();
            });

            //ao clicar em um item da lista, o campo recebe o valor do item
            $(".classificacao_despesa").click(function () {
                $("#classificacao_con").val($(this).text());
                $("#itens_classificacao").hide();

                var id_classificacao = $(this).attr("value");

                //verificar se foi selecionado despesa juridica
                if (id_classificacao == 6) {
                    limpaCamposDespesaJuridica();
                    //gera input do numero do processo
                    $("#despesa_juridica").append(
                        "<strong class='remove_processo'>NUMERO DO PROCESSO</strong>" +
                            '<input class="form-control  input-add remove_processo" onblur="getProcesso(this)" name="numero_processo" id="input_despesa_juridica"></input>'
                    );
                } else {
                    limpaCamposDespesaJuridica();
                }

                //a cada nova requisição, limpa o option do select
                $("#tipo_classificacao").html("");
                //faz a requisição ajax para buscar tipo de classificação
                $.ajax({
                    type: "GET",
                    url: `/classificacao-contabil/${id_classificacao}`,
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
        url: `/produto/show/classificacao`,
        dataType: "json",
    })
        .done(function (response) {
            //traz os resultados do banco para uma div hidden
            $.each(response, function (key, val) {
                $("#classificacao_tipo_produto").append(
                    `<option class="classificacao" value="${val.id_tipo_produto}-${val.de_tipo_produto}">${val.de_tipo_produto}</option>`
                );
            });
            //Inicio de itens
            //ao clicar em um item da lista, o campo recebe o valor do item
            $("#classificacao_tipo_produto").on("change", function () {
                var id_classificacao = $("#classificacao_tipo_produto")
                    .val()
                    .split("-");
                //a cada nova requisição, limpa o option do select
                $("#produto_servico").html("");
                //faz a requisição ajax para buscar tipo de classificação
                $.ajax({
                    type: "GET",
                    url: `/produto/classificacao/${id_classificacao[0]}`,
                    dataType: "json",
                }).done(function (response) {
                    //mostra os resultados da busca em uma div
                    $.each(response, function (key, val) {
                        $("#produto_servico").append(
                            `<option value="${val.id_produto}-${val.de_produto}">${val.de_produto}</option>`
                        );
                    });
                });
            });
        })
        .fail(function () {
            console.log("erro na requisição Ajax");
        });
    //Fim de itens
    // FIM FAZ A REQUISIÇÃO DA CLASSIFICAÇAO DO TIPO DO PRODUTO E O PRODUTO
});

var centro_de_custo_selecionado = "";
//função para buscar empresa
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
                        $("#busca_empresa").val($(this).text());
                        $("#empresa").html("");
                        var id_empresa = $(this).attr("value");
                        $("#id_busca_empresa").attr("value", id_empresa);
                        //busca centros de custo relacionados com a empresa e mostra no select
                        $("#results_empresa").html("");
                        $.ajax({
                            type: "GET",
                            url: `/centroCustoEmpresa/${id_empresa}`,
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
                            centro_de_custo_selecionado = $("#empresa").val();

                            $("#empresa").on("change", function () {
                                centro_de_custo_selecionado =
                                    $("#empresa").val();
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
    }, 500)
);

//seleciona tipo de despesa
document.getElementById("btnDespesa").onclick = function () {
    //limpa campos
    $("#Cnpj_Cpf").val("");

    var radios = document.getElementsByName("tipo_despesa");
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            if (radios[i].value == "fornecedor") {
                document.getElementById("titulo-modal").innerHTML =
                    "Adicionar Fornecedor";
                document.getElementById("tipo-documento").innerHTML =
                    "CNPJ/CPF";

                // Inico da busca dos cnpj/cpf dos fornecedores
                $("#Cnpj_Cpf").keyup(
                    delay(function () {
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
                                            `<div class="item-fornecedor-empregado" value="${val.nu_cpf_cnpj}">${val.nu_cpf_cnpj} --- ${val.de_razao_social} </div>`
                                        );
                                    });
                                    //seleciona o cnpj ou cpf desejada
                                    $(".item-fornecedor-empregado").click(
                                        function () {
                                            $("#Cnpj_Cpf").val($(this).text());
                                            var cpfFornecedor =
                                                $(this).attr("value");

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

                                                $("#btnCnpj_Cpf").click(
                                                    function () {
                                                        $(
                                                            "#input_cpf_cnpj"
                                                        ).val(
                                                            response[0]
                                                                .nu_cpf_cnpj
                                                        );
                                                        $(
                                                            "#input_razao_social"
                                                        ).val(
                                                            response[0]
                                                                .de_razao_social
                                                        );

                                                        $(
                                                            "#fk_empregado_fornecedor"
                                                        ).attr(
                                                            "value",
                                                            response[0]
                                                                .id_fornecedor
                                                        );

                                                        $("#Cnpj_Cpf").val("");
                                                        $("#modal-busca").modal(
                                                            "hide"
                                                        );
                                                    }
                                                );
                                            });
                                        }
                                    );
                                })
                                .fail(function () {
                                    $("#Cnpj_Cpf").val("");
                                    $("#ResultadoCnpjCpf").html("");
                                });
                        } else {
                            $("#ResultadoCnpjCpf").html("");
                        }
                    }, 500)
                );
                // fim da busca dos cnpj/cpf dos fornecedores
            }
            if (radios[i].value == "empregado") {
                document.getElementById("titulo-modal").innerHTML =
                    "Adicionar Empregado";
                document.getElementById("tipo-documento").innerHTML = "CPF";

                // Inicio da busca dos cpf dos empregodos
                $("#Cnpj_Cpf").keyup(
                    delay(function () {
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
                                            `<div class="item-fornecedor-empregado" value="${val.nu_cpf_cnpj}">${val.nu_cpf_cnpj} --- ${val.nome_empregado} </div>`
                                        );
                                    });
                                    //seleciona o cnpj ou cpf desejada
                                    $(".item-fornecedor-empregado").click(
                                        function () {
                                            $("#Cnpj_Cpf").val($(this).text());
                                            var cpfEmpregado =
                                                $(this).attr("value");

                                            $("#ResultadoCnpjCpf").html("");
                                            // preenche o campo de input_cpf_cnpj e o input_razao_social com base no item anterior
                                            $.ajax({
                                                type: "GET",
                                                url: `/empregados/cpf/${cpfEmpregado}`,
                                                dataType: "json",
                                            }).done(function (response) {
                                                $("#btnCnpj_Cpf").click(
                                                    function () {
                                                        //armazena id do empregado em uma variavel;
                                                        idEmpregado =
                                                            response[0]
                                                                .id_empregado;

                                                        $(
                                                            "#input_cpf_cnpj"
                                                        ).val(
                                                            response[0]
                                                                .nu_cpf_cnpj
                                                        );
                                                        $(
                                                            "#input_razao_social"
                                                        ).val(
                                                            response[0]
                                                                .nome_empregado
                                                        );

                                                        $(
                                                            "#fk_empregado_fornecedor"
                                                        ).attr(
                                                            "value",
                                                            response[0]
                                                                .id_empregado
                                                        );

                                                        $("#Cnpj_Cpf").val("");
                                                        $("#modal-busca").modal(
                                                            "hide"
                                                        );
                                                    }
                                                );
                                            });
                                        }
                                    );
                                })
                                .fail(function () {
                                    $("#Cnpj_Cpf").val("");
                                    $("#ResultadoCnpjCpf").html("");
                                });
                        } else {
                            $("#ResultadoCnpjCpf").html("");
                        }
                    }, 500)
                );
                // fim da busca dos cpf dos empregados
            }
        }
    }
};

var id_button_item = 0;
var totalItens = 0;
var valorTotal = 0;
var valorRemovido = 0;

var moeda = $("#moeda").val();

//click do botão de itens
$("#Prod").click(function () {
    //  pega os valores dos campos preenchidos pelo usuario
    var class_prod = $("#classificacao_tipo_produto").val().split("-");
    var class_prod_value = class_prod[0];
    var desc_class = class_prod[1];
    var prod_ser = $("#produto_servico").val().split("-");
    var value_item = prod_ser[0];
    var desc_item = prod_ser[1];
    var valor_uni = $("#valor_item").val();
    var quanti = $("#quantidade").val();

    if (
        class_prod_value == "" ||
        prod_ser == "" ||
        valor_uni == "" ||
        quanti == ""
    ) {
        swal({
            title: "Atenção",
            text: "Preencha todos os campos do produto!",
            icon: "warning",
            button: "Ok",
        });
    } else if (valor_uni <= 0 || quanti == 0) {
        swal({
            title: "Atenção",
            text: "Valores precisam ser maiores do que ZERO!",
            icon: "warning",
            button: "Ok",
        });
    } else {
        // criar novos itens com os valores preenchidos anteriormente
        $("#Tb").append(
            `<tr id="tab${id_button_item}">` +
                `<td>${desc_class}</td>` +
                `<td>${desc_item}</td>` +
                `<td>${valor_uni}</td>` +
                `<td>${quanti}</td>` +
                `<td><button type="button" class="btn btn-danger btn_item" onclick="removeItem(${id_button_item})" style="padding: 8px 12px;">` +
                `<i class="bi bi-trash-fill"></i>` +
                `</button></td>` +
                "</tr>"
        );
        //retira virgulas do valor unitário
        var valorFormatado = valor_uni.replace(/\./g, "").replace(",", ".");
        //gera o input com os dados do item para submeter no form
        $("#hidden_inputs_itens").append(
            `<div id="input_generated_itens${id_button_item}">` +
                `<input type="hidden"  name="id_produto[]" value="${value_item}"/>` +
                `<input type="hidden" id="val_produto${id_button_item}" name="valor_unitario[]" value="${valorFormatado}"/>` +
                `<input type="hidden" id="quantidade${id_button_item}" name="quantidade[]" value="${quanti}"/>` +
                `</div>`
        );

        id_button_item++;
        //adiciona 1 ao total de itens
        totalItens++;

        // limpar campos do item
        $("#classificacao_tipo_produto").val("");
        $("#produto_servico").val("");
        $("#valor_item").val("");
        $("#quantidade").val("");

        // soma de todos os valores dos items
        Number(valorFormatado);
        Number(valorTotal);
        Number(quanti);

        valorTotal = valorTotal + valorFormatado * quanti;
        $("#valorTotal").attr("readonly", true);

        //verificar campo vazio!

        if (moeda == "REAL") {
            $("#valorTotal").val(tipoMoeda(valorTotal, "REAL"));
        }
        if (moeda == "DOLAR") {
            $("#valorTotal").val(tipoMoeda(valorTotal, "DOLAR"));
        }
        if (moeda == "EURO") {
            $("#valorTotal").val(tipoMoeda(valorTotal, "EURO"));
        }
    }
});

//fim click botão itens

//remove o rateio da tabela e do form e subtrai valor do total
function removeItem(id) {
    valorRemovido = Number($(`#val_produto${id}`).val());
    qtdItems = Number($(`#quantidade${id}`).val());
    //subtrai 1 ao total de itens
    totalItens--;

    valorTotal = valorTotal - valorRemovido * qtdItems;

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
                        "<select name='conta_bancaria' onclick='getContaBancaria(this)' class='form-control input-add remove_conta' id='contas_fornecedor'>" +
                        "<option value='' class='contas_fornecedor_resultado'></option>" +
                        "</select>"
                );
                var endpoint;
                var url = "/contas-bancarias/";

                tipoDespesa = $("input[name=tipo_despesa]:checked").val();

                if (tipoDespesa == "empregado") {
                    endpoint = `${idEmpregado}/${tipoDespesa}`;
                    url = url + endpoint;
                } else if (tipoDespesa == "fornecedor") {
                    endpoint = `${idFornecedor}/${tipoDespesa}`;
                    url = url + endpoint;
                }

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
                tipoDespesa = $("input[name=tipo_despesa]:checked").val();

                if (tipoDespesa == "fornecedor") {
                    $.ajax({
                        type: "GET",
                        url: `/pix/fornecedor/${idFornecedor}`,
                        dataType: "json",
                    }).done(function (response) {
                        $.each(response, function (key, val) {
                            $("#pix_fornecedor").append(
                                `<option class="pix_fornecedor_resultado" value="${val.id_pix}">${val.de_tipo_pix} - ${val.de_pix}</option>`
                            );
                        });
                    });
                } else {
                    // [REGRA DE NEGOCIO]-> não exite uma definição para o pix do empregado
                    // ajax de busca do pix do empregado
                    $.ajax({
                        type: "GET",
                        url: `/pix/empregado/${idEmpregado}`,
                        dataType: "json",
                    }).done(function (response) {
                        $.each(response, function (key, val) {
                            $("#pix_fornecedor").append(
                                `<option class="pix_fornecedor_resultado" value="${val.id_pix}">${val.de_tipo_pix} - ${val.de_pix}</option>`
                            );
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

function limpaCamposDespesaJuridica() {
    $(".remove_processo").remove();
    $("input[name=numero_processo]").attr("value", "");
}

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

function getPix(object) {
    $("input[name=numero_pix]").attr("value", object.value);
}

function getContaBancaria(object) {
    $("input[name=numero_conta_bancaria]").attr("value", object.value);
}

function getProcesso(object) {
    $("input[name=numero_processo]").attr("value", object.value);
}

// $("#dt_prov").on("focusout", function () {
//     var dateObj = $("#dt_prov").val();

//     var dataDividida = dateObj.split("-");
//     var data = new Date(dataDividida[0], dataDividida[1] - 1, dataDividida[2]);
//     var now = new Date();
//     var dataAtual = new Date(now.getFullYear(), now.getMonth(), now.getDate());

//     if (data < dataAtual) {
//         $(this).css({ color: "red" });
//         $("#erro_dt_prov")
//             .html("Data de provisionamento menor que a data atual")
//             .css({ color: "red", fontStyle: "italic" });
//         $(this).focus();
//     } else {
//         $("#erro_dt_prov").html("");
//         $(this).css({ color: "black" });
//     }
// });

// $("#dt_venc").on("change", function () {
//     var dateObj = $("#dt_venc").val();

//     var dataDividida = dateObj.split("-");
//     var data = new Date(dataDividida[0], dataDividida[1] - 1, dataDividida[2]);
//     var now = new Date();
//     var dataAtual = new Date(now.getFullYear(), now.getMonth(), now.getDate());

//     if (data < dataAtual) {
//         $(this).css({ color: "red" });
//         $("#erro_dt_venc")
//             .html("Data de vencimento menor que a data atual")
//             .css({ color: "red", fontStyle: "italic" });
//         $(this).focus();
//     } else {
//         $("#erro_dt_venc").html("");
//         $(this).css({ color: "black" });
//     }
// });

$("#dt_emissao").on("change", function () {
    var dateObj = $("#dt_emissao").val();

    var dataDividida = dateObj.split("-");
    var data = new Date(dataDividida[0], dataDividida[1] - 1, dataDividida[2]);
    var now = new Date();
    var dataAtual = new Date(now.getFullYear(), now.getMonth(), now.getDate());

    if (data > dataAtual) {
        $(this).css({ color: "red" });
        $("#erro_dt_emissao")
            .html("Data de emissão maior que a data atual")
            .css({ color: "red", fontStyle: "italic" });
        $("#dt_emissao").focus();
    } else {
        $("#erro_dt_emissao").html("");
        $(this).css({ color: "black" });
    }
});
