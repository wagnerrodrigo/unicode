var adicionar_parcela = document.getElementById("adicionar_parcela");
var parcela = document.getElementsByName("tipo_parcela");
var numeroParcelas = document.getElementById("numero_parcelas");
var parcelasGeradas = document.getElementById("parcelas_geradas");
var parcelasGeradasHidden = document.getElementById("hidden_inputs_parcelas");

var parcelaFixa = parcela[1];

var valorTotal = document.getElementById("valorTotal");

adicionar_parcela.onclick = () => geraParcelas(valorTotal, numeroParcelas);

function geraParcelas(valorTotal, numeroParcelas) {
    valorTotal = valorTotal.value;
    var valorFinal = valorTotal.replace(/\./g, "").replace(",", ".").replace("R$", "");
    if (numeroParcelas.value > 0 && valorFinal > 0) {
        removeItens();
        for (let i = 0; i < numeroParcelas.value; i++) {
            if (!parcelaFixa.checked) {
                parcelasGeradas.innerHTML +=
                    '<div class="d-flex">' +
                    '<div class="px-5 mb-5">' +
                    `<label for="parcela${i + 1}">Parcela ${i + 1}</label>` +
                    `<input type="text" class="form-control input-add parcela_gerada" onkeyup="formataValor(this)" onblur="validaValor(this)" id="parcela${
                        i + 1
                    }" name="parcela[]" placeholder="Digite o valor da parcela">` +
                    "</div>" +
                    '<div class="px-5 mb-5">' +
                    `<label for="data_vencimento${i + 1}">Data Vencimento ${
                        i + 1
                    }</label>` +
                    `<input type="date" class="form-control vencimento_parcela_gerada" id="vencimento_parcela${
                        i + 1
                    }" name="vencimento_parcela[]" value="${geraDataVencimentoParcelas(
                        i + 1
                    )}">` +
                    "</div>" +
                    "</div>";
                parcelasGeradasHidden.innerHTML +=
                    `<input type="hidden" name="parcelas[]" id="parcela_numero${
                        i + 1
                    }" value="">` +
                    `<input type="hidden" name="vencimento_parcela[]" id="vencimento_parcela_numero${
                        i + 1
                    }" value="">`;
            } else {
                parcelasGeradas.innerHTML +=
                    '<div class="d-flex">' +
                    '<div class="px-5 mb-5">' +
                    `<label for="parcela${i + 1}">Parcela ${i + 1}</label>` +
                    `<input type="text" readonly value="${Intl.NumberFormat(
                        "pt-BR",
                        { style: "currency", currency: "BRL" }
                    ).format(
                        (valorFinal / numeroParcelas.value).toFixed(2)
                    )}" class="form-control input-add parcela_gerada" id="parcela${
                        i + 1
                    }" name="parcela[]" >` +
                    "</div>" +
                    '<div class="px-5 mb-5">' +
                    `<label for="data_vencimento${i + 1}">Data Vencimento ${
                        i + 1
                    }</label>` +
                    `<input type="date" class="form-control vencimento_parcela_gerada vencimento_parcela_gerada" id="vencimento_parcela${
                        i + 1
                    }" name="vencimento_parcela[]" value="${geraDataVencimentoParcelas(
                        i + 1
                    )}">` +
                    "</div>" +
                    "</div>";
                parcelasGeradasHidden.innerHTML +=
                    `<input type="hidden" name="parcelas[]"  id="parcela_numero${
                        i + 1
                    }" value="${(valorFinal / numeroParcelas.value).toFixed(
                        2
                    )}">` +
                    `<input type="hidden" name="vencimento_parcela[]" id="vencimento_parcela_numero${
                        i + 1
                    }" value="">`;
            }
        }
    }else{
        swal({
            title: "Atenção",
            text: "Verifique o numero de parcelas e o valor total",
            icon: "warning",
            button: "Fechar",
        });
    }
}

function atribuiValorAParcelaGerada() {
    let parcelasGeradas = document.getElementsByClassName("parcela_gerada");
    var parcelasGeradasHidden = document.getElementsByClassName("parcelas");
    var datasParcelasGeradas = document.getElementsByClassName(
        "vencimento_parcela_gerada"
    );
    var datasParcelasGeradasHidden =
        document.getElementsByClassName("vencimento_parcela");
    var valorTotalDespesa = document.getElementById("valorTotal").value;
    valorTotalDespesa = parseFloat(
        valorTotalDespesa.replace(/\./g, "").replace(",", ".").replace("R$", "")
    );

    var valorTotalParcelas = 0;

    for (let i = 0; i < parcelasGeradas.length; i++) {
        parcelasGeradasHidden = document.getElementById(
            "parcela_numero" + (i + 1)
        );
        datasParcelasGeradasHidden = document.getElementById(
            "vencimento_parcela_numero" + (i + 1)
        );

        parcelasGeradasHidden.value = Number(
            parseFloat(
                parcelasGeradas[i].value
                    .replace(/[^0-9,]*/g, "")
                    .replace(",", ".").replace("R$", "")
            ).toFixed(2)
        );
        datasParcelasGeradasHidden.value = datasParcelasGeradas[i].value;
        valorTotalParcelas += Number(
            parseFloat(
                parcelasGeradas[i].value
                    .replace(/[^0-9,]*/g, "")
                    .replace(",", ".").replace("R$", "")
            ).toFixed(2)
        );
    }

    if (valorTotalParcelas != valorTotalDespesa) {
        swal({
            title: "Valor total das parcelas é diferente do valor total da despesa!",
            text: "Por favor, verifique os valores das parcelas!",
            icon: "warning",
            dangerMode: true,
        });
        valorTotalParcelas = 0;
        for (let i = 0; i < parcelasGeradas.length; i++) {
            parcelasGeradasHidden = document.getElementById(
                "parcela_numero" + (i + 1)
            );
            datasParcelasGeradasHidden = document.getElementById(
                "vencimento_parcela_numero" + (i + 1)
            );

            parcelasGeradasHidden.value = "";
            datasParcelasGeradasHidden.value = "";
        }
    } else {
        if (!validaForm()) document.getElementById("form_despesa").submit();
    }
}

function removeItens() {
    $("#parcelas_geradas").empty();
    $("#hidden_inputs_parcelas").empty();
}

function geraDataVencimentoParcelas(parcela) {
    var now = new Date();
    var today = now.toISOString();

    const date = new Date(today);
    return new Date(date.setMonth(date.getMonth() + parcela)).toISOString().split("T")[0];

    //adiciona dias
    //data.setDate(data.getDate() + 0);
}

function getParcelas(object, url) {
    //recebe as informações do href
    var href = object.getAttribute("href");
    //pega as informações de id de dentro do href
    var id = href.substring(href.indexOf("-") + 1);

    let expanded = event.target.getAttribute("aria-expanded");
    event.target.setAttribute("aria-expanded", (expanded == "true") ? "false" : "true");

    let icon = event.target.getAttribute("class");
    event.target.setAttribute("class", (expanded == "true") ? "bi bi-caret-up" : "bi bi-caret-down");
    if (expanded == 'true') {
        $.ajax({
            type: "GET",
            url: `/parcelas/${id}`,
            dataType: "json",
            success: function(response) {
                if (response.length > 0) {
                    for (i = 0; i < response.length; i++) {
                        $(`#parcela_${id}`).append(
                            `<tr class="table-dark tr_generated_${id} ${response[i].de_status_despesa == 'EM ATRASO' ? "font-color-despesa-vencida" : "font-color-despesa"}">` +
                            `<td><input style="margin-right: 5px" type="checkbox" name="ids_despesas" value="${response[i].id_parcela_despesa}">` + response[i].id_parcela_despesa + '</td>' +
                            "<td>" + Intl.NumberFormat('pt-BR', {
                                style: 'currency',
                                currency: 'BRL'
                            }).format(response[i].valor_parcela) + '</td>' +
                            `<td>PARCELA ${response[i].num_parcela}</td>` +
                            "<td>" + Intl.DateTimeFormat('pt-BR').format(new Date(response[i].dt_emissao)) + "</td>" +
                            "<td>" + Intl.DateTimeFormat('pt-BR').format(new Date(response[i].dt_vencimento)) + "</td>" +
                            `<td>${response[i].de_status_despesa}</td>` +
                            `<td><a href="${url + response[i].id_parcela_despesa}" class='btn btn-primary' style='padding: 8px 12px;'><i class='bi bi-eye-fill'></i></a></td>`
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
        expanded = 'true';
        $(`.tr_generated_${id}`).remove();
    }
}
