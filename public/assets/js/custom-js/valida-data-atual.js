function validaData(obj) {
    var dateObj = obj.value;
    var id = obj.id;

    var dataDividida = dateObj.split("-");
    var novaData = new Date(
        dataDividida[0],
        dataDividida[1] - 1,
        dataDividida[2]
    );
    var now = new Date();
    var dataAtual = new Date(now.getFullYear(), now.getMonth(), now.getDate());

    if (novaData < dataAtual) {
        $(`#erro_${id}`)
        .html("Data menor que a data atual")
        .css({ color: "red", fontStyle: "italic" });
        $(`#${id}`).css({ color: "red" });
    $(`#${id}`).focus();
    } else {
        $(`#erro_${id}`).html("");
            $(`#${id}`).css({ color: "black" });
    }
}
