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

$("#seleciona_rateio").click(function () {
    rateio_empresa = $("#rateio_empresa").val();
    custo_rateio = $("#custo_rateio").val();
    valor_rateado = $("#valor_rateado").val();
    porcentagem_valor = $("#porcentagem_rateado").val();

    $("#table_rateio").append(
        `<tr id="tab-generated">` +
            `<td><div>${rateio_empresa}<input type="hidden" name="rateio_empresa[]" value="${rateio_empresa}"/></div></td>` +
            `<td><div>${custo_rateio}<input type="hidden" name="custo_rateio[]" value="${custo_rateio}"/></div></td>` +
            `<td><div>${valor_rateado}<input type="hidden" name="valor_rateado[]" value="${valor_rateado}"/></div></td>` +
            `<td><div>${porcentagem_valor}<input type="hidden" name="porcentagem_valor[]" value="${porcentagem_valor}"/></div></td>` +
            `<td><button id="remove" class="btn btn-danger btn-sm btn-delete-rateio">Excluir</button></td>` +
        `</tr>`
    );
});

$(document).on("click", "#remove", function () {
    $(`#tab-generated`).remove();
});
