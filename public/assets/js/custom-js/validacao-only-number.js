function onlynumber(event) {
    if (isNaN(String.fromCharCode(event.keyCode))) return false;
}

function validateValue(obj) {
    let initial_value = 0;
    let allowed_value = 100;
    if (
        parseInt(obj.value) < initial_value ||
        parseInt(obj.value) > allowed_value
    ) {
        swal({
            title: "Atenção",
            text: "O valor deve ser entre 0 e 100",
            icon: "warning",
            button: "Ok",
        });
        obj.value = allowed_value;
        return false;
    }
}
