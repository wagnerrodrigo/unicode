function validateEmail(email) {
    // verifica se existe o @ no input
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
