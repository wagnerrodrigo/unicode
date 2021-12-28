function dataFormatada(data) {
    var dt = new Date(data);
    var dt_formata = dt.toLocaleDateString('pt-br', { timeZone: 'UTC' });
    return dt_formata;
}