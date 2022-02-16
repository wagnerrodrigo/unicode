$(document).ready(function() {
    //requisição ajax para buscar empresa
    $.ajax({
            type: "GET",
            url: `http://10.175.3.209:8000/extrato/empresa`,
            dataType: "json",
        })
        //caso a requisição seja bem sucedida
        .done(function(response) {
            $("#resultado-inputEmpresa").html("");
            //mostra os resultados da busca em uma div
            $.each(response, function(key, val) {
                console.log(response);
                $("#resultado-inputEmpresa").append(
                    `<option class="item" value="${val.id_empresa}">${val.de_empresa}</option>`
                );
            });
            //seleciona a empresa desejada
            $(".item").click(function() {
                $("#inputEmpresa").val($(this).text());
                $("#resultado-inputEmpresa").html("");
            });
        })
});
