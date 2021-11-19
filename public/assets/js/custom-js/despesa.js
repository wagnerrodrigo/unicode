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

$("#busca_empresa").keyup(function () {
    var words = $(this).val();
    if (words != "") {
        $.ajax({
            type: "GET",
            url: `http://localhost:8000/centroCustoEmpresa/nome/${words}`,
            dataType: "json",
        })
            .done(function (response) {
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