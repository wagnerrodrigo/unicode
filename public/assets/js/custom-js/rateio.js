//busca empresa no modal de rateio
$("#rateio_empresa").keyup(function () {
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
                        url: `http://localhost:8000/centroCustoEmpresa/${id_empresa_rateio}`,
                        dataType: "json",
                    }).done(function (response) {
                        //mostra os resultados da busca em uma div
                        $.each(response, function (key, val) {
                            $("#custo_rateio").append(
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
                $("#results_rateio_empresa").html("");
            });
    } else {
        $("#results_rateio_empresa").html("");
    }
});

//id utilizado para autoincrementar os ids dos inputs e tabelas ao adicionar um rateio
var id_button_rateio = 0;
//função para pegar os valores dos inputs e adicionar na tabela
$("#seleciona_rateio").click(function () {
    var rateio_empresa = $("#rateio_empresa").val();
    var custo_rateio = $("#custo_rateio").val();
    var valor_rateado = $("#valor_rateado").val();
    var porcentagem_valor = $("#porcentagem_rateado").val();

    //gera a tabela com os dados do rateio
    $("#table_rateio").append(
        `<tr id="tab-generated${id_button_rateio}">` +
            `<td>${rateio_empresa}</td>` +
            `<td>${custo_rateio}</td>` +
            `<td>${valor_rateado}</td>` +
            `<td>${porcentagem_valor}</td>` +
            `<td><button onclick="removeRateio(${id_button_rateio})" class="btn btn-danger btn-sm btn-delete-rateio">Excluir</button></td>` +
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
});

//remove o rateio da tabela e do form
function removeRateio(id) {
    console.log(id);
    $(`#tab-generated${id}`).remove();
    $(`#input-generated${id}`).remove();
}

//adiciona valor total ao input acima do modal de rateio
$("#adicionar_rateio").click(function () {
    var valorTotal = $("#valorTotal").val();
    $("#modal_valor_total").val(valorTotal);
});

//gera a porcentagem do rateio de acordo com o valor fornecido no input
$("#valor_rateado").blur(function () {
    var valorTotalItens = $("#valorTotal").val();
    var valorFormatadoItens = valorTotalItens
        .replace(".", "")
        .replace(",", ".")
        .replace("R$", "");
    var valorRateado = Number($("#valor_rateado").val());
    var porcentagem = (valorFormatadoItens / 100) * valorRateado;
    console.log(valorFormatadoItens);
    console.log(porcentagem);
    //$("#porcentagem_rateado").val(porcentagem);
});
