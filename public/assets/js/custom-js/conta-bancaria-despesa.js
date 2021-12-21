function adicionaContaBancaria() {
    var titular = $("#input_razao_social").val();
    var id_titular = $("#fk_empregado_fornecedor").val();

    $("#titular_conta").val(titular);
    $("#titular_conta").attr("value", id_titular);

    $.ajax({
        url: "http://localhost:8000/instituicoes-financeira",
        type: "GET",
        dataType: "json",
        success: function (response) {
            $.each(response, function (key, val) {
                $("#inst_financeiras").append(
                    `<option value="${val.id}">${val.co_banco} - ${val.de_banco} </option>`
                );
            });
        },
        error: function () {
            alert("Erro ao carregar instituições financeiras");
        },
    });
}

function salvaContaBancaria() {
    var banco = $("#inst_financeiras").val();
    var agencia = $("#nu_agencia").val();
    var conta = $("#nu_conta").val();
    var titular = $("#titular_conta").val();
    var id_titular = $("#titular_conta").attr("value");

    $.ajax({
        url: "http://localhost:8000/contas-bancarias",
        type: "POST",
        data: {
            _token: '{{csrf_token()}}', //verificar o token na requisicao
            banco: banco,
            agencia: agencia,
            conta: conta,
            titular: titular,
            id_titular: id_titular,
        },
        dataType: "json",
        success: function (response) {
            console.log({ respose: response });
            $("#inst_financeiras").val("");
            $("#agencia").val("");
            $("#conta").val("");
            $("#titular_conta").val("");
            $("#titular_conta").attr("value", "");
        },
        error: function (data) {
            console.log({ message: "Erro ao salvar conta bancaria", error: data });
        },
    });
}
