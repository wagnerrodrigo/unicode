var adicionar_parcela = document.getElementById("adicionar_parcela");
var parcela = document.getElementsByName("tipo_parcela");
var numeroParcelas = document.getElementById("numero_parcelas");
var parcelasGeradas = document.getElementById("parcelas_geradas");
var parcelasGeradasHidden = document.getElementById("hidden_inputs_parcelas");

var now = new Date();
var today = now.toISOString();
var todayWithouthTime = today.split("T")[0];


var valorTotal = document.getElementById("valorTotal");

adicionar_parcela.onclick = () => geraParcelas(valorTotal, numeroParcelas);

function geraParcelas(valorTotal, numeroParcelas) {
    valorTotal = valorTotal.value.replace(/\./g, "").replace(",", ".");
    if (numeroParcelas.value > 0 && valorTotal > 0) {
        for (let i = 0; i < numeroParcelas.value; i++) {
            if (parcela[0].checked) {
                parcelasGeradas.innerHTML += `
                <div class="form-group d-flex">
                    <div>
                        <label for="parcela${i + 1}">Parcela ${i + 1}</label>
                    </div>
                    <input type="text" class="form-control parcela_gerada" id="parcela${i + 1}" name="parcela[]" placeholder="Digite o valor da parcela">
                    <div>
                        <label for="data_vencimento${i + 1}">Data Vencimento ${i + 1}</label>
                    </div>
                    <input type="date" class="form-control vencimento_parcela_gerada" id="vencimento_parcela${i + 1}" name="vencimento_parcela[]" value="${todayWithouthTime}">
                </div>`;
                parcelasGeradasHidden.innerHTML +=
                    `<input type="hidden" name="parcelas[]" id="parcela_numero${i + 1}" value="">` +
                    `<input type="hidden" name="vencimento_parcela[]" id="vencimento_parcela_numero${i + 1}" value="">`;
            } else {
                parcelasGeradas.innerHTML +=
                    `<div class="form-group">
                        <div>
                            <label for="parcela${i + 1}">Parcela ${i + 1}</label>
                        </div>
                        <input type="text" readonly class="form-control parcela_gerada" id="parcela${i + 1}" value="${(valorTotal / numeroParcelas.value).toFixed(2)}" name="parcela[]">` +
                        `<div>
                            <label for="data_vencimento${i + 1}">Data Vencimento ${i + 1}</label>
                        </div>` +
                        `<input type="date" class="form-control vencimento_parcela_gerada" id="vencimento_parcela${i + 1}" name="vencimento_parcela[]" value="${todayWithouthTime}">
                    </div>`;
                parcelasGeradasHidden.innerHTML +=
                    `<input type="hidden" name="parcelas[]"  id="parcela_numero${i + 1}" value="${(valorTotal / numeroParcelas.value).toFixed(2)}">` +
                    `<input type="hidden" name="vencimento_parcela[]" id="vencimento_parcela_numero${i + 1}" value="">`;
            }
        }
    }
}

function atribuiValorAParcelaGerada() {
    let parcelasGeradas = document.getElementsByClassName("parcela_gerada");
    var parcelasGeradasHidden = document.getElementsByClassName("parcelas");
    var datasParcelasGeradas = document.getElementsByClassName("vencimento_parcela_gerada");
    var datasParcelasGeradasHidden = document.getElementsByClassName("vencimento_parcela");
    var valorTotalDespesa = document.getElementById("valorTotal").value;
    valorTotalDespesa = parseFloat(
        valorTotalDespesa.replace(/\./g, "").replace(",", ".")
    );

    var valorTotalParcelas = 0;
    console.log(datasParcelasGeradas);
    console.log(parcelasGeradasHidden);
    console.log(parcelasGeradas);
    console.log(datasParcelasGeradasHidden);
    console.log(valorTotalDespesa);

    for (let i = 0; i < parcelasGeradas.length; i++) {
        parcelasGeradasHidden = document.getElementById(
            "parcela_numero" + (i + 1)
        );
        datasParcelasGeradasHidden = document.getElementById(
            "vencimento_parcela_numero" + (i + 1)
        );

        parcelasGeradasHidden.value = parcelasGeradas[i].value;
        datasParcelasGeradasHidden.value = datasParcelasGeradas[i].value;
        valorTotalParcelas += parseFloat(parcelasGeradas[i].value);
    }
    if (valorTotalParcelas != valorTotalDespesa) {
        console.log(valorTotalParcelas);
        console.log(valorTotalDespesa);
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
        document.getElementById("form_despesa").submit();
    }
}
