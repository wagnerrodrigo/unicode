function getPedidos(object, url) {
    //recebe as informações do href
    var href = object.getAttribute("href");
    //pega as informações de id de dentro do href
    var id = href.substring(href.indexOf("-") + 1);

    let expanded = event.target.getAttribute("aria-expanded");
    event.target.setAttribute(
        "aria-expanded",
        expanded == "true" ? "false" : "true"
    );

    let icon = event.target.getAttribute("class");
    event.target.setAttribute(
        "class",
        expanded == "true" ? "bi bi-caret-up" : "bi bi-caret-down"
    );
    if (expanded == "true") {
        $.ajax({
            type: "GET",
            url: `/parcelas/${id}`,
            dataType: "json",
            success: function (response) {
                if (response.length > 0) {
                    for (i = 0; i < response.length; i++) {
                        $(`#parcela_${id}`).append(
                            `<tr class="table-dark tr_generated_${id} ${
                                response[i].de_status_despesa == "EM ATRASO"
                                    ? "font-color-despesa-vencida"
                                    : "font-color-despesa"
                            }">` +
                                `<td><input style="margin-right: 5px" type="checkbox" name="ids_despesas" value="${response[i].id_parcela_despesa}">` +
                                response[i].id_parcela_despesa +
                                "</td>" +
                                "<td>" +
                                Intl.NumberFormat("pt-BR", {
                                    style: "currency",
                                    currency: "BRL",
                                }).format(response[i].valor_parcela) +
                                "</td>" +
                                `<td>PARCELA ${response[i].num_parcela}</td>` +
                                "<td>" +
                                Intl.DateTimeFormat("pt-BR").format(
                                    new Date(response[i].dt_emissao)
                                ) +
                                "</td>" +
                                "<td>" +
                                Intl.DateTimeFormat("pt-BR").format(
                                    new Date(response[i].dt_vencimento)
                                ) +
                                "</td>" +
                                `<td>${response[i].de_status_despesa}</td>` +
                                `<td><a href="${
                                    url + response[i].id_parcela_despesa
                                }" class='btn btn-primary' style='padding: 8px 12px;'><i class='bi bi-eye-fill'></i></a></td>`
                        );
                    }
                } else {
                    $(`#parcela_${id}`).append(
                        `<tr class="table-light tr_generated_${id}">` +
                            `<td><span style="color: red; font-weight: bold;">Não há parcelas</span></td>` +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "</tr>"
                    );
                }
            },
        });
    } else {
        expanded = "true";
        $(`.tr_generated_${id}`).remove();
    }
}


function getParcelas(object, url) {
    //recebe as informações do href
    var href = object.getAttribute("href");
    //pega as informações de id de dentro do href
    var id = href.substring(href.indexOf("-") + 1);

    let expanded = event.target.getAttribute("aria-expanded");
    event.target.setAttribute(
        "aria-expanded",
        expanded == "true" ? "false" : "true"
    );

    let icon = event.target.getAttribute("class");
    event.target.setAttribute(
        "class",
        expanded == "true" ? "bi bi-caret-up" : "bi bi-caret-down"
    );
    if (expanded == "true") {
        $.ajax({
            type: "GET",
            url: `/parcelas/${id}`,
            dataType: "json",
            success: function (response) {
                if (response.length > 0) {
                    for (i = 0; i < response.length; i++) {
                        $(`#parcela_${id}`).append(
                            `<tr class="table-dark tr_generated_${id} ${
                                response[i].de_status_despesa == "EM ATRASO"
                                    ? "font-color-despesa-vencida"
                                    : "font-color-despesa"
                            }">` +
                                `<td><input style="margin-right: 5px" type="checkbox" name="ids_despesas" value="${response[i].id_parcela_despesa}">` +
                                response[i].id_parcela_despesa +
                                "</td>" +
                                "<td>" +
                                Intl.NumberFormat("pt-BR", {
                                    style: "currency",
                                    currency: "BRL",
                                }).format(response[i].valor_parcela) +
                                "</td>" +
                                `<td>PARCELA ${response[i].num_parcela}</td>` +
                                "<td>" +
                                Intl.DateTimeFormat("pt-BR").format(
                                    new Date(response[i].dt_emissao)
                                ) +
                                "</td>" +
                                "<td>" +
                                Intl.DateTimeFormat("pt-BR").format(
                                    new Date(response[i].dt_vencimento)
                                ) +
                                "</td>" +
                                `<td>${response[i].de_status_despesa}</td>` +
                                `<td><a href="${
                                    url + response[i].id_parcela_despesa
                                }" class='btn btn-primary' style='padding: 8px 12px;'><i class='bi bi-eye-fill'></i></a></td>`
                        );
                    }
                } else {
                    $(`#parcela_${id}`).append(
                        `<tr class="table-light tr_generated_${id}">` +
                            `<td><span style="color: red; font-weight: bold;">Não há parcelas</span></td>` +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "</tr>"
                    );
                }
            },
        });
    } else {
        expanded = "true";
        $(`.tr_generated_${id}`).remove();
    }
}