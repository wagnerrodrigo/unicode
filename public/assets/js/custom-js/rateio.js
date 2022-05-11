$(document).ready(function () {
    $("#modal_valor_rateado").val("0,00");
});
//busca empresa no modal de rateio
$("#rateio_empresa").keyup(function () {
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
                $("#results_rateio_empresa").html("");
                //mostra os resultados da busca em uma div
                $.each(response, function (key, val) {
                    $("#results_rateio_empresa").append(
                        `<div class="item-rateio item" value="${val.id_empresa}">${val.de_empresa} - ${val.regiao_empresa} </div>`
                    );
                });
                //seleciona a empresa desejada
                $(".item-rateio").click(function () {
                    $("#rateio_empresa").val($(this).text());
                    $("#custo_rateio").html("");
                    var id_empresa_rateio = $(this).attr("value");
                    //busca centros de custo relacionados com a empresa e mostra no select
                    $("#results_rateio_empresa").html("");
                    $.ajax({
                        type: "GET",
                        url: `/centroCustoEmpresa/${id_empresa_rateio}`,
                        dataType: "json",
                    }).done(function (response) {
                        //mostra os resultados da busca em uma div
                        $.each(response, function (key, val) {
                            $("#custo_rateio").append(
                                `<option value="${val.id_centro_custo}-${
                                    val.de_departamento
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
                $("#results_rateio_empresa").html("");
            });
    } else {
        $("#results_rateio_empresa").html("");
    }
});

var valorTotalRateio = 0;
var valorRateado = 0;
var valorTotalDespesa = 0;

var rateios = [];

//informa o valor e gera a porcentagem
$("#valor_rateado").blur(function () {
    var valorTotalItens = $("#valorTotal").val();
    valorTotalDespesa = Number(
        valorTotalItens.replace(/\./g, "").replace(",", ".").replace("R$", "")
    );

    valorRateado = $("#valor_rateado")
        .val()
        .replace(/\./g, "")
        .replace(",", ".")
        .replace("R$", "");

        console.log(valorTotalDespesa)

    valorRateado = Number(valorRateado);

    if (valorTotalItens == "") {
        swal({
            title: "Atenção",
            text: "Adicione os itens ou o valor total da despesa",
            icon: "warning",
            button: "Ok",
        });
        $("#valor_rateado").val("");
    }

    var valorRateio = valorRateado * 100;
    var porcentagem = valorRateio / valorTotalDespesa;

    $("#porcentagem_rateado").val(porcentagem.toFixed(2));
});

//informa a porcentagem e gera o valor do rateio
$("#porcentagem_rateado").blur(function () {
    var valorTotalItens = $("#valorTotal").val();
    valorTotalDespesa = valorTotalItens
        .replace(/\./g, "")
        .replace(",", ".")
        .replace("R$", "");

    var valorPorcentagem = Number($("#porcentagem_rateado").val());

    var porcentagem = valorTotalDespesa / 100;
    valorRateado = valorPorcentagem * porcentagem;

    $("#valor_rateado").val(
        Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        })
            .format(valorRateado.toFixed(2))
            .toString()
            .replace("R$", "")
    );
    console.log(valorTotalDespesa);
    console.log(valorRateado);
});


//id utilizado para autoincrementar os ids dos inputs e tabelas ao adicionar um rateio
var id_button_rateio = 0;
//função para pegar os valores dos inputs e adicionar na tabela
$("#seleciona_rateio").click(function () {
    var rateio_empresa = $("#rateio_empresa").val();
    var custo_rateio = $("#custo_rateio").val().split("-");
    var value_centro_custo = custo_rateio[0];
    var desc_centro_custo = custo_rateio[1];
    var valor_rateado = $("#valor_rateado").val();
    var porcentagem_valor = $("#porcentagem_rateado").val();

    valorTotalDespesa = $("#valorTotal")
        .val()
        .replace(/\./g, "")
        .replace(",", ".")
        .replace("R$", "");

    if (
        rateio_empresa != "" &&
        custo_rateio != "" &&
        valor_rateado != "" &&
        porcentagem_valor != ""
    ) {
        if (
            Number(valorRateado.toFixed(2)) > Number(valorTotalDespesa) ||
            valorTotalRateio + Number(valorRateado.toFixed(2)) >
                Number(valorTotalDespesa) ||
            valorTotalRateio > Number(valorTotalDespesa)
        ) {
            swal({
                title: "Atenção",
                text: "Valor maior que o valor total da despesa",
                icon: "warning",
                button: "Ok",
            });
            $("#valor_rateado").val("");
        } else if (valorRateado == 0) {
            $("#valor_rateado").val("");
            $("#porcentagem_rateado").val("");
            swal({
                title: "Atenção",
                text: "O valor rateado não pode ser 0",
                icon: "warning",
                button: "Ok",
            });
        } else {
            if (value_centro_custo == centro_de_custo_selecionado) {
                $("#valor_rateado").val("");
                $("#porcentagem_rateado").val("");
                swal({
                    title: "Atenção",
                    text: "Este centro de custo ja foi adicionado como centro de custo padrão para essa despesa.",
                    icon: "warning",
                    button: "Ok",
                });
            } else if (rateios.includes(value_centro_custo)) {
                $("#valor_rateado").val("");
                $("#porcentagem_rateado").val("");
                swal({
                    title: "Atenção",
                    text: "Já foi adicionado um rateio para esse centro de custo.",
                    icon: "warning",
                    button: "Ok",
                });
            } else {
                rateios.push(value_centro_custo);
                valorTotalRateio = valorTotalRateio + valorRateado;
                $("#modal_valor_rateado").val(valorTotalRateio.toFixed(2));

                //gera a tabela com os dados do rateio
                $("#table_rateio").append(
                    `<tr id="tab-generated${id_button_rateio}">` +
                        `<td>${rateio_empresa}</td>` +
                        `<td>${desc_centro_custo}</td>` +
                        `<td>${valor_rateado}</td>` +
                        `<td>${porcentagem_valor}</td>` +
                        `<td><button onclick="removeRateio(${id_button_rateio}, ${valor_rateado
                            .replace(/\./g, "")
                            .replace(",", ".")
                            .replace(
                                "R$",
                                ""
                            )}, ${value_centro_custo})" class="btn btn-danger btn-sm btn-delete-rateio">Excluir</button></td>` +
                        "</tr>"
                );
                //gera o input com os dados do rateio para submeter no form
                $("#hidden_inputs").append(
                    `<div id="input-generated${id_button_rateio}"><input type="hidden" name="empresa_rateio[]" value="${rateio_empresa}"/>` +
                        `<input type="hidden" name="custo_rateio[]" value="${value_centro_custo}"/>` +
                        `<input type="hidden" name="valor_rateio[]" value="${valor_rateado
                            .replace(/\./g, "")
                            .replace(",", ".")
                            .replace("R$", "")}"/>` +
                        `<input type="hidden" name="porcentagem_rateio[]" value="${porcentagem_valor}"/></div>`
                );
                id_button_rateio++;
                limpaCamposRateio();
            }
        }
    } else {
        swal({
            title: "Atenção",
            text: "Preencha todos os campos",
            icon: "warning",
            button: "Ok",
        });
    }
    valorRateado = 0;

    //se houver rateio cadastrado, desabilita o campo de valor total e de adicionar produto
    if (rateios != "") {
        $("#valorTotal").attr("readonly", true);
        $("#Prod").attr("disabled", true);
        $(".btn_item").attr("disabled", true);
    }
});

//remove o rateio da tabela e do form
function removeRateio(id, valorRateado, centro_custo) {
    //subtrai o valor removido do valor total do rateio
    valorTotalRateio = valorTotalRateio - valorRateado;
    //atualiza o valor total do rateio no input
    $("#modal_valor_rateado").val(valorTotalRateio.toFixed(2));

    rateios.splice(rateios.indexOf(centro_custo), 1);

    $(`#tab-generated${id}`).remove();
    $(`#input-generated${id}`).remove();

    //se não houver rateio cadastrado, habilita o campo de valor total e de adicionar produto
    if (rateios == "") {
        if (totalItens > 0) {
            $("#Prod").attr("disabled", false);
            $(".btn_item").attr("disabled", false);
        } else {
            $("#valorTotal").attr("readonly", false);
            $("#Prod").attr("disabled", false);
            $(".btn_item").attr("disabled", false);
        }
    }
}

//adiciona valor total ao input acima do modal de rateio
function pegaValorDespesa(){
    var valorTotalDaDespesa = document.getElementById("valorTotal").value;
    $("#modal_valor_total").attr("value", valorTotalDaDespesa);
    $("#modal_valor_total").val(valorTotalDaDespesa);
}

function limpaCamposRateio() {
    $("#rateio_empresa").val("");
    $("#custo_rateio").val("");
    $("#valor_rateado").val("");
    $("#porcentagem_rateado").val("");
}

function handleChange(object) {
    //verifica se existe um centro de custo selecionado
    if (centro_de_custo_selecionado == "") {
        swal({
            title: "Atenção",
            text: "Selecione um centro de custo principal antes de inserir um rateio",
            icon: "warning",
            button: "Ok",
        });

        var radio_false = document.getElementById("radio_false");
        radio_false.checked = true;
        return;
    }
    //gera tabela de rateio
    if (object.value == "true") {
        var rateios = document.getElementById("div_rateio");
        rateios.innerHTML +=
            '<div class="d-flex flex-column" id="div_rateio_gerado" style="width: 100%;" > ' +
            '<div class="px-5" style="padding: 8px 12px;">' +
            '<button class="btn btn-primary" id="adicionar_rateio" onclick="pegaValorDespesa()" type="button" data-bs-toggle="modal" data-bs-target="#xrateio" style="padding: 8px 12px;"><i class="bi bi-plus"></i></button>' +
            "</div>" +
            '<div class="px-5 mb-3">' +
            '<div class="table-responsive">' +
            '<table class="table table-bordered mb-0">' +
            "<thead>" +
            "<tr>" +
            "<th>EMPRESA</th>" +
            "<th>CENTRO DE CUSTO</th>" +
            "<th>RATEIO</th>" +
            "<th>%</th>" +
            "<th>EDITAR</th>" +
            "</tr>" +
            "</thead>" +
            '<tbody id="table_rateio">' +
            "</tbody>" +
            "</table>" +
            "</div>" +
            "</div>" +
            "</div>";
    } else {
        var rateio_gerado = document.getElementById("div_rateio_gerado");
        rateio_gerado.remove();
    }
}
