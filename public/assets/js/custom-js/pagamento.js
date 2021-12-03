$("#inst_banco").keyup(function() {
    var instBanco = $(this).val();

    if (instBanco != "") {
        $.ajax({
            type: "GET",
            url: `/pagamento/info-conta/${instBanco}`,
            dataType: "json",
        }).done(function(response) {
            $("#Resultado_inst_banco").html("");
            // mostra os resultado do nome do banco e coloca em um div
            $.each(response, function(key, val) {
                $("#Resultado_inst_banco").append(
                    `<div class="item" value="${val.id}" >${val.de_banco} </div>`
                );
            });
            $(".item").click(function() {
                $("#inst_banco").val($(this).text());
                $("#Resultado_inst_banco").html("");
                var id = $(this).attr("value");

                //busca as instituições bancarias relacionados com a agencia e mostra no select
                $("#id_inst_banco").attr("value", id);
                $("#Resultado_inst_banco").html("");
                // a cada nova requisição, limpa o option do select
                $("#agencia").html("");
                $.ajax({
                        type: "GET",
                        url: `/pagamento/info-agencia/${id}`,
                        dataType: "json",
                    })
                    .done(function(response) {
                        //mostra os resultados da busca em um select
                        $.each(response, function(key, val) {
                            $("#agencia").append(
                                `<option selectd class="item" value="${val.nu_agencia}" >${
                                val.nu_agencia !== ""
                                ? val.nu_agencia 
                                : " ---- Número da agência não cadastrado ----"
                            }</option>`
                                // Se a instuição bancaria não possuir um numero de agencia cadastrada informa a mensagem
                            );
                        });

                    });
                $("#conta_banco").html("")
                    // a cada nova requisição, limpa o option do select
                $.ajax({
                    //mostra os resultados da busca em um select
                    type: "GET",
                    url: `/pagamento/info-contaBancaria/${id}`,
                    dataType: "json",
                }).done(function(response) {
                    $.each(response, function(key, val) {
                        $("#conta_banco").append(
                            `<option selectd class="item" value="${val.nu_conta}" >${
                            val.nu_conta !== ""
                            ? val.nu_conta 
                            : " ---- Número da Conta Bancaria não cadastrado ----"
                        }</option>`
                            // Se a agência não possuir um numero de Conta bancaria cadastrada informa a mensagem
                        );
                    })
                })
            });
        });
    }
});






$("#inst_banco_forne_empr").keyup(function() {
    var inst_banco_forne_empr = $(this).val();

    if (inst_banco_forne_empr != "") {
        $.ajax({
            type: "GET",
            url: `/pagamento/info-conta/${inst_banco_forne_empr}`,
            dataType: "json",
        }).done(function(response) {
            $("#Resultado_inst_banco_forn_empr").html("");
            // mostra os resultado do nome do banco e coloca em um div
            $.each(response, function(key, val) {
                $("#Resultado_inst_banco_forn_empr").append(
                    `<div class="item" value="${val.id}" >${val.de_banco} </div>`
                );
            });
            $(".item").click(function() {
                $("#inst_banco_forne_empr").val($(this).text());
                $("#Resultado_inst_banco_forn_empr").html("");
                var id = $(this).attr("value");

                //busca as instituições bancarias relacionados com a agencia e mostra no select
                $("#inst_banco_forne_empr").attr("value", id);
                $("#Resultado_inst_banco_forn_empr").html("");
                // a cada nova requisição, limpa o option do select
                $("#agencia_forne_empr").html("");
                $.ajax({
                        type: "GET",
                        url: `/pagamento/info-agencia/${id}`,
                        dataType: "json",
                    })
                    .done(function(response) {
                        //mostra os resultados da busca em um select
                        $.each(response, function(key, val) {
                            $("#agencia_forne_empr").append(
                                `<option selectd class="item" value="${val.nu_agencia}" >${
                                val.nu_agencia !== ""
                                ? val.nu_agencia 
                                : " ---- Número da agência não cadastrado ----"
                            }</option>`
                                // Se a instuição bancaria não possuir um numero de agencia cadastrada informa a mensagem
                            );
                        });

                    });
                $("#conta_banco_forne_empr").html("")
                    // a cada nova requisição, limpa o option do select
                $.ajax({
                    //mostra os resultados da busca em um select
                    type: "GET",
                    url: `/pagamento/info-contaBancaria/${id}`,
                    dataType: "json",
                }).done(function(response) {
                    $.each(response, function(key, val) {
                        $("#conta_banco_forne_empr").append(
                            `<option selectd class="item" value="${val.nu_conta}" >${
                            val.nu_conta !== ""
                            ? val.nu_conta 
                            : " ---- Número da Conta Bancaria não cadastrado ----"
                        }</option>`
                            // Se a agência não possuir um numero de Conta bancaria cadastrada informa a mensagem
                        );
                    })
                })
            });
        });
    }
});