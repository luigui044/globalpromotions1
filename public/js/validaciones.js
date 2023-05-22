const estaVacio = (valor) => {
    if (valor === undefined || valor == null || valor.trim().length == 0) {
        return true;
    }
    return false;
}

const fechaCorrecta = (fecha) => {
    const regex = new RegExp('^[0-9]{2}/[0-9]{2}/[0-9]{4}$');
    return regex.test(fecha);
}

const telefonoSvCorrecto = (telefono) => {
    const regex = new RegExp('^[267][0-9]{3}-[0-9]{4}$');
    return regex.test(telefono);
}

const soloLetras = (e) => {
    const regex = /^[a-zA-Z\u00C0-\u017F\s]+$/;
    const key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (!regex.test(key)) {
        e.preventDefault();
        return false;
    }
}

const soloNumeros = (e) => {
    const code = (e.which) ? e.which : e.keyCode;

    if (code == 8) { // backspace.
        return true;
    } else if (code >= 48 && code <= 57) { // is a number.
        return true;
    } else { // other keys.
        e.preventDefault();
        return false;
    }
}

const esDecimalPositivo = (numero) => {
    if (estaVacio(numero))
        return false;
    n = parseFloat(numero);
    if (isNaN(n))
        return false;
    if (n < 0)
        return false;
    return true;
}   

const minimoUno = (e) => {
    if (e.target.value == 0) {
        e.target.value = 1;
    }
}

const agregarError = (elemento, elementoMensaje, mensaje) => {
    elemento.classList.add("is-invalid");
    elementoMensaje.textContent = mensaje;
};

const limpiarError = (elemento, elementoMensaje) => {
    elemento.classList.remove("is-invalid");
    elementoMensaje.textContent = "";
};

const tamanoMaximoArchivo = (archivo) => {
    // Tamaño maximo 6MB
    const maximo = 6144000;

    if (archivo.size > maximo) {
        return false;
    }
    return true;
}

const tipoArchivo = (inputArchivo) => {
    let extensionesPermitidas = /^(jpg|jpeg|png|gif|svg)$/,
        extension = inputArchivo.value.substring(inputArchivo.value.lastIndexOf('.') + 1).toLowerCase(),
        tipoArchivo = inputArchivo.files[0].type.substring(inputArchivo.files[0].type.lastIndexOf('/') + 1).toLowerCase();

    if (extension == tipoArchivo) {
        return extensionesPermitidas.test(extension);
    }    
    return false;
}

const archivoSeleccionado = (inputFile) => {
    if (inputFile.files.length > 0) {
        return true;
    }
    return false;
}