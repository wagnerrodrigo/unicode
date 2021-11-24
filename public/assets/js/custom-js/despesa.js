//Seleciona quais campos irão aparecer na tela
$(document).ready(function () {
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
});

$("#busca_empresa").keyup(function () {
    var words = $(this).val();
    if (words != "") {
        $.ajax({
            type: "GET",
            url: `http://localhost:8000/empresas/nome/${words}`,
            dataType: "json",
        })
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
                                `<option value="${val.id_centro_custo}">${val.de_carteira == '' ? val.de_departamento : val.de_departamento + ' - ' + val.de_carteira}</option>`
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
            }
            if (radios[i].value == "empregado") {
                document.getElementById("titulo-modal").innerHTML =
                    "Adicionar Empregado";
                document.getElementById("tipo-documento").innerHTML = "CPF";
            }
        }
    }
};

// busca dados do banco pelo cnpj/cpf

$("#Cnpj_Cpf").keyup(function () {
    var digitoCnpjCpf = $(this).val();
    console.log(digitoCnpjCpf + "primeiro");

    if (digitoCnpjCpf != "") {
        $.ajax({
            url: `/fornecedores/cnpj_cpf/${digitoCnpjCpf}`,
            type: "GET",
            dataType: "json",
        })
            .done(function (response) {
                $("#ResultadoCnpjCpf").html("");
                console.log(response);
                //mostra os resultados da busca em uma div
                $.each(response, function (key, val) {
                    $("#ResultadoCnpjCpf").append(
                        '<div class="item">' + val.de_razao_social + "</div>"
                    );
                });
                //seleciona a empresa desejada
                $(".item").click(function () {
                    $("#Cnpj_Cpf").val($(this).text());
                    $("#ResultadoCnpjCpf").html("");
                });
            })
            .fail(function () {
                $("#ResultadoCnpjCpf").html("");
            });
    } else {
        $("#ResultadoCnpjCpf").html("");
    }
});
