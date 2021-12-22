function adicionaContaBancaria() {
    var titular = $("#input_razao_social").val();
    var id_titular = $("#fk_empregado_fornecedor").val();
    var tipo_despesa = $("input[name=tipo_despesa]:checked").val();

    $("#titular_conta").val(titular);
    $("#id_titular_conta").val(id_titular);
    $("#tipo_da_despesa").val(tipo_despesa);

    if (titular == "") {
        alert("Selecione um fornecedor ou um empregado!");
        return false;
    } else {
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
}

$(function () {
    $('form[name="form_conta_bancaria"]').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "http://localhost:8000/store",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (data) {
                alert(data.message.toString())
                $("#inst_financeiras").val("");
                $("#nu_agencia").val("");
                $("#nu_conta").val("");
                $("#co_operacao").val("");
            },
            error: function (data) {
                alert(data.message.toString());
            },
        });
    });
});
