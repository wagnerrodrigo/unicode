function adicionaContaBancaria() {
    var titular = $("#input_razao_social").val();
    var id_titular = $("#fk_empregado_fornecedor").val();
    var tipo_despesa = $("input[name=tipo_despesa]:checked").val();

    $("#titular_conta").val(titular);
    $("#id_titular_conta").val(id_titular);
    $("#tipo_da_despesa").val(tipo_despesa);

    if (titular == "") {
        swal({
            title: "Atenção",
            text: "Selecione um fornecedor ou um empregado!",
            icon: "warning",
            button: "Ok",
        });
        return false;
    } else {
        $.ajax({
            url: "/instituicoes-financeira",
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
                swal({
                    title: "Erro",
                    text: "Erro ao buscar instituições financeiras!",
                    icon: "error",
                    button: "Ok",
                });
            },
        });
    }
}

$(function () {
    $('form[name="form_conta_bancaria"]').submit(function (e) {
        e.preventDefault();
        if ($("#inst_financeiras").val().trim() == "") {
            $("#inst_financeiras").focus();
            $("#erro_instuicao")
                .html("Selecione uma instituição financeira!")
                .css({ color: "red", fontStyle: "italic" });
            return false;
        } else {
            $("#erro_instuicao").html("");
        }
        if ($("#nu_agencia").val().trim() == "") {
            $("#nu_agencia").focus();
            $("#erro_agencia")
                .html("Informe a agência!")
                .css({ color: "red", fontStyle: "italic" });
            return false;
        } else {
            $("#erro_agencia").html("");
        }
        if ($("#nu_conta").val().trim() == "") {
            $("#nu_conta").focus();
            $("#erro_conta")
                .html("Informe a conta!")
                .css({ color: "red", fontStyle: "italic" });
            return false;
        } else {
            $("#erro_conta").html("");
            $.ajax({
                url: "/contas-bancarias/store",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    swal({
                        title: "Sucesso",
                        text: "Conta bancária cadastrada com sucesso!",
                        icon: "success",
                        button: "Ok",
                    });
                    $("#inst_financeiras").val("");
                    $("#nu_agencia").val("");
                    $("#nu_conta").val("");
                    $("#co_operacao").val("");
                },
                error: function (data) {
                    swal({
                        title: "Erro",
                        text: "Erro ao cadastrar conta bancária!",
                        icon: "error",
                        button: "Ok",
                    })
                },
            });
            $("#condicao_pagamento").val("");
            limpaCamposContaBancariaPix();
        }
    });
});
