//Seleciona quais campos irão aparecer na tela
$(document).ready(function() {
    $('input:radio[name="seleciona_tela"]').on("change", function() {
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
});

/*$("#busca_empresa").keyup(function () {
    var words = $(this).val();
    if (words != "") {
        $.ajax({
            type: "GET",
            url: `http://localhost:8000/empresas/nome/${words}`,
            dataType: "json",
        })
            .done(function (response) {
                console.log(response);
                $("#results_empresa").html("");
                //mostra os resultados da busca em uma div
                $.each(response, function (key, val) {
                    $("#results_empresa").append(
                        '<div class="item">' + val.de_empresa + "</div>"
                    );
                });
                //seleciona a empresa desejada
                $(".item").click(function () {
                    $("#busca_empresa").val($(this).text());
                    $("#results_empresa").html("");
                });
            })
            .fail(function () {
                $("#results_empresa").html("");
            });
    } else {
        $("#results_empresa").html("");
    }
});*/

$("#busca_empresa").keyup(function() {
    var words = $(this).val();
    if (words != "") {
        $.ajax({
                type: "GET",
                url: `http://localhost:8000/centroCustoEmpresa/nome/${words}`,
                dataType: "json",
            })
            .done(function(response) {
                $("#results_empresa").html("");
                //mostra os resultados da busca em uma div
                console.log(response);
                $.each(response, function(key, val) {
                    $("#results_empresa").append(
                        '<div class="item">' + val.de_empresa + "</div>"
                    );
                });
                //seleciona a empresa desejada
                $(".item").click(function() {
                    $("#busca_empresa").val($(this).text());
                    $("#results_empresa").html("");

                    console.log(response);

                    //console.log(result.id_centro_custo);
                    /*$.each(result, function (key, val) {
                         console.log(val);
                         $("#centro_de_custo").append(
                             `<option value="${val.id_centro_custo}">` + val.de_empresa + "</option>"
                         );
                     });*/
                });
            })
            .fail(function() {
                $("#results_empresa").html("");
            });
    } else {
        $("#results_empresa").html("");
    }
});

//seleciona tipo de despesa
document.getElementById("btnDespesa").onclick = function() {
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