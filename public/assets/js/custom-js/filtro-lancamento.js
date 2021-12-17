var inputDataInicio;
$("#inputDataInicio").on("change", function() {
    inputDataInicio = $(this).val();
    $("#inputDataFim").prop("min", function() {
        return inputDataInicio;
    })
    console.log(inputDataInicio);

    $.ajax({
        type: "GET",
        url: `/lancamentos/filtro-periodo/${inputDataInicio}`,
        dataType: "json",
    }).done()
})


var inputDataFim;
$("#inputDataFim").on("change", function() {
    inputDataFim = $(this).val();
    $("#inputDataInicio").prop("max", function() {
        return inputDataFim;
    })
})