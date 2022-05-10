var adicionar_parcela = document.getElementById("adicionar_parcela");
var parcela = document.getElementsByName("tipo_parcela");
var numeroParcelas = document.getElementById("numero_parcelas");
var parcelasGeradas = document.getElementById("parcelas_geradas");
var parcelasGeradasHidden = document.getElementById("hidden_inputs_parcelas");

var parcelaFixa = parcela[1];

var valorTotal = document.getElementById("valorTotal");

adicionar_parcela.onclick = () => geraParcelas(valorTotal, numeroParcelas);

function geraParcelas(valorTotal, numeroParcelas) {
    valorTotal = valorTotal.value.replace(/\./g, "").replace(",", ".");
    if (numeroParcelas.value > 0 && valorTotal > 0) {
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
                        (valorTotal / numeroParcelas.value).toFixed(2)
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
                    }" value="${(valorTotal / numeroParcelas.value).toFixed(
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
        valorTotalDespesa.replace(/\./g, "").replace(",", ".")
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
                    .replace(",", ".")
            ).toFixed(2)
        );
        datasParcelasGeradasHidden.value = datasParcelasGeradas[i].value;
        valorTotalParcelas += Number(
            parseFloat(
                parcelasGeradas[i].value
                    .replace(/[^0-9,]*/g, "")
                    .replace(",", ".")
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
