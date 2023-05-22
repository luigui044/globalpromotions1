const estaVacio = (valor) => {
    if (valor.trim() == '' || valor.trim().length == 0) {
        return true;
    }
    return false;
}