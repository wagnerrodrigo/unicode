$("#inst_banco").keyup(function() {
    var instBanco = $(this).val();

    if (instBanco != "") {
        $.ajax({
            url: `/lancamentos/info-conta/${instBanco}`,
            type: "GET",
            dataType: "json",
        }).done(function(response) {
            // mostra os resultado do nome do banco e coloca em um div
            $("#Resultado_inst_banco").html("");
            $.each(response, function(key, val) {
                $("#Resultado_inst_banco").append(
                    `<div class="item" value="${val.fk_tab_inst_banco_id}" >${val.de_banco} </div>`
                );
            });
            $(".item").click(function() {
                $("#inst_banco").val($(this).text());

            })
        });
    }
});