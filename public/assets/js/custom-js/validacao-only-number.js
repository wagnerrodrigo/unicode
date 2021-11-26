function onlynumber(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    //var regex = /^[0-9.,]+$/;
    var regex = /^[0-9.]+$/;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function validateValue(obj) {
    let initial_value = 0;
    let allowed_value = 100;
    if (parseInt(obj.value) < initial_value || parseInt(obj.value) > allowed_value) {
        alert("valor permitido entre 0 e 100");
        obj.value = allowed_value;
        return false;
    }
}
