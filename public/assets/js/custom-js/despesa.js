$(document).ready(function () {
    //Seleciona quais campos irão aparecer na tela
    $('input:radio[name="seleciona_tela"]').on("change", function () {
        if (this.checked && this.value == "1") {
            $("#campo_razao_social").show();
            $(
                "#input-custom-field4, #input-custom-field5, #input-custom-field6"
            ).hide();
        } else {
            $(
                "#input-custom-field4, #input-custom-field5, #input-custom-field6"
            ).show();
            $("#campo_razao_social").hide();
        }
    });

    //fazer requisição ajax para buscar classificação contabil
    $.ajax({
        type: "GET",
        url: `http://localhost:8000/classificacao-contabil`,
        dataType: "json",
    })
        .done(function (response) {
            //traz os resultados do banco para uma div hidden
            $.each(response, function (key, val) {
                $("#itens_classificacao")
                    .append(
                        `<div class="classificacao" value="${val.id_clasificacao_contabil}">${val.de_clasificacao_contabil}</div>`
                    )
                    .hide();
            });
            //ao clicar aparece os campos com resultados do banco
            $("#classificacao_con").click(function () {
                $("#itens_classificacao").show();
            });
            //ao clicar em um item da lista, o campo recebe o valor do item
            $(".classificacao").click(function () {
                $("#classificacao_con").val($(this).text());
                $("#itens_classificacao").hide();

                var id_classificacao = $(this).attr("value");
                //a cada nova requisição, limpa o option do select
                $("#tipo_classificacao").html("");
                //faz a requisição ajax para buscar tipo de classificação
                $.ajax({
                    type: "GET",
                    url: `http://localhost:8000/classificacao-contabil/${id_classificacao}`,
                    dataType: "json",
                }).done(function (response) {

                    //mostra os resultados da busca em uma div
                    $.each(response, function (key, val) {
                        $("#tipo_classificacao").append(
                            `<option value="${val.id_plano_contas}">${val.de_plano_contas}</option>`
                        );
                    });
                });
            });
        })
        .fail(function () {
            console.log("erro na requisição Ajax");
        });
});
//função para buscar empresa
$("#busca_empresa").keyup(function () {
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
                $("#results_empresa").html("");
                //mostra os resultados da busca em uma div
                $.each(response, function (key, val) {
                    $("#results_empresa").append(
                        `<div class="item" value="${val.id_empresa}">${val.de_empresa} - ${val.regiao_empresa} </div>`
                    );
                });
                //seleciona a empresa desejada
                $(".item").click(function () {
                    $("#busca_empresa").val($(this).text());
                    $("#empresa").html("");
                    var id_empresa = $(this).attr("value");
                    //console.log(id_empresa);
                    $("#id_busca_empresa").attr("value", id_empresa);
                    //busca centros de custo relacionados com a empresa e mostra no select
                    $("#results_empresa").html("");
                    $.ajax({
                        type: "GET",
                        url: `http://localhost:8000/centroCustoEmpresa/${id_empresa}`,
                        dataType: "json",
                    }).done(function (response) {
                        //mostra os resultados da busca em uma div
                        $.each(response, function (key, val) {
                            $("#empresa").append(
                                `<option value="${val.id_centro_custo}" class="centro_custo_item">${
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
                $("#results_empresa").html("");
            });
    } else {
        $("#results_empresa").html("");
    }
});

//seleciona tipo de despesa
document.getElementById("btnDespesa").onclick = function () {
    var radios = document.getElementsByName("tipo_despesa");
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            if (radios[i].value == "fornecedor") {
                document.getElementById("titulo-modal").innerHTML =
                    "Adicionar Fornecedor";
                document.getElementById("tipo-documento").innerHTML =
                    "CNPJ/CPF";

                // Inico da busca dos cnpj/cpf dos fornecedores
                $("#Cnpj_Cpf").keyup(function() {
                    var digitoCnpjCpf = $(this).val();

                    if (digitoCnpjCpf != '') {

                        $.ajax({
                            url: `/fornecedores/cnpj_cpf/${digitoCnpjCpf}`,
                            type: 'GET',
                            dataType: 'json',
                        }).done(function(response) {
                            $("#ResultadoCnpjCpf").html('');
                            //mostra os resultados da busca em uma div
                            $.each(response, function(key, val) {
                                    $('#ResultadoCnpjCpf').append(
                                        `<div class="item" value="${val.nu_cpf_cnpj}">${val.nu_cpf_cnpj} --- ${val.de_razao_social} </div>`
                                    );
                                })
                                //seleciona o cnpj ou cpf desejada
                            $('.item').click(function() {

                                $('#Cnpj_Cpf').val($(this).text());
                                var idFornecedor = $(this).attr("value");


                                $('#ResultadoCnpjCpf').html('');
                                // preenche o campo de input_cpf_cnpj e o input_razao_social com base no item anterior
                                $.ajax({
                                    type: "GET",
                                    url: `/fornecedores/cnpj_cpf/${idFornecedor}`,
                                    dataType: "json",
                                }).done(function(response) {
                                    $('#btnCnpj_Cpf').click(function() {
                                        $("#input_cpf_cnpj").val(response[0].nu_cpf_cnpj);
                                        $("#input_razao_social").val(response[0].de_razao_social);
                                        $('#Cnpj_Cpf').val("");
                                        $('#modal-busca').modal('hide');
                                    });

                                });
                            })

                        }).fail(function() {
                            $('#Cnpj_Cpf').val("");
                            $('#ResultadoCnpjCpf').html('');
                        });
                    } else {
                        $('#ResultadoCnpjCpf').html('');
                    }

                });
                // fim da busca dos cnpj/cpf dos fornecedores

            }
            if (radios[i].value == "empregado") {
                document.getElementById("titulo-modal").innerHTML =
                    "Adicionar Empregado";
                document.getElementById("tipo-documento").innerHTML = "CPF";

                // Inicio da busca dos cpf dos empregodos
                $("#Cnpj_Cpf").keyup(function() {
                    var digitoCpf = $(this).val();

                    if (digitoCpf != '') {

                        $.ajax({
                            url: `/empregados/cpf/${digitoCpf}`,
                            type: 'GET',
                            dataType: 'json',
                        }).done(function(response) {
                            $("#ResultadoCnpjCpf").html('');
                            //mostra os resultados da busca em uma div
                            $.each(response, function(key, val) {
                                    $('#ResultadoCnpjCpf').append(
                                        `<div class="item" value="${val.nu_cpf_cnpj}">${val.nu_cpf_cnpj} --- ${val.nome_empregado} </div>`
                                    );
                                })
                                //seleciona o cnpj ou cpf desejada
                            $('.item').click(function() {

                                $('#Cnpj_Cpf').val($(this).text());
                                var idEmpregado = $(this).attr("value");


                                $('#ResultadoCnpjCpf').html('');
                                // preenche o campo de input_cpf_cnpj e o input_razao_social com base no item anterior
                                $.ajax({
                                    type: "GET",
                                    url: `/empregados/cpf/${idEmpregado}`,
                                    dataType: "json",
                                }).done(function(response) {
                                    $('#btnCnpj_Cpf').click(function() {
                                        $("#input_cpf_cnpj").val(response[0].nu_cpf_cnpj);
                                        $("#input_razao_social").val(response[0].nome_empregado);
                                        $('#Cnpj_Cpf').val("");
                                        $('#modal-busca').modal('hide');
                                    });

                                });
                            })

                        }).fail(function() {
                            $('#Cnpj_Cpf').val("");
                            $('#ResultadoCnpjCpf').html('');
                        });
                    } else {
                        $('#ResultadoCnpjCpf').html('');
                    }

                });
                // fim da busca dos cpf dos empregados



            }
        }
    }
};

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
                                `<option value="${val.id_centro_custo}" class="centro_custo_item">${
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
