function onlynumber(event) {
    if ( isNaN( String.fromCharCode(event.keyCode) )) return false;
}

function validateValue(obj) {
    let initial_value = 0;
    let allowed_value = 100;
    if (
        parseInt(obj.value) < initial_value ||
        parseInt(obj.value) > allowed_value
    ) {
        alert("valor permitido entre 0 e 100");
        obj.value = allowed_value;
        return false;
    }
}
