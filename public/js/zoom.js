const scrollable = document.querySelector('.scrollable');
const contenedorUbicaciones = document.querySelector('.area-zoom');
const aumentar = document.querySelector('#aumentar');
const disminuir = document.querySelector('#disminuir');
let contador = 0;
disminuir.disabled = true;

const aumentarZoomConClick = () => {
    contador += 1;

    switch(contador) {
        case 1:
            contenedorUbicaciones.style.transform = 'scale(140%)';
            disminuir.disabled = false;
        break;
        case 2:
            contenedorUbicaciones.style.transform = 'scale(165%)';
        break;
        case 3:
            contenedorUbicaciones.style.transform = 'scale(195%)';
            aumentar.disabled = true;
        break;
        case 4:
            contenedorUbicaciones.style.transform = 'scale(100%)';
            aumentar.disabled = false;
            disminuir.disabled = true;
            contador = 0;
        break;   
    }
}

const aumentarZoomConBoton = () => {
    aumentar.disabled = false;
    contador += 1;

    switch(contador) {
        case 1:
            contenedorUbicaciones.style.transform = 'scale(140%)';
            disminuir.disabled = false;
        break;
        case 2:
            contenedorUbicaciones.style.transform = 'scale(165%)';
        break;
        case 3:
            contenedorUbicaciones.style.transform = 'scale(195%)';
            aumentar.disabled = true;
        break; 
    }
}

const disminuirZoomConBoton = () => {
    disminuir.disabled = false;

    switch(contador) {
        case 1:
            contenedorUbicaciones.style.transform = 'scale(100%)';
            disminuir.disabled = true;
        break;
        case 2:
            contenedorUbicaciones.style.transform = 'scale(140%)';
        break;
        case 3:
            contenedorUbicaciones.style.transform = 'scale(165%)';
            aumentar.disabled = false;
        break;
    }

    contador -= 1;
}

contenedorUbicaciones.addEventListener('dblclick', aumentarZoomConClick);
aumentar.addEventListener('click', aumentarZoomConBoton);
disminuir.addEventListener('click', disminuirZoomConBoton);

/* * Drag and Scroll */
let pos = {
    top: 0,
    left: 0,
    x: 0,
    y: 0
};

const mouseMoveHandler = (e) => {
    const dx = e.clientX - pos.x;
    const dy = e.clientY - pos.y;

    // Hacer scroll hasta elemento
    scrollable.scrollTop = pos.top - dy;
    scrollable.scrollLeft = pos.left - dx;
}

const mouseUpHandler = () => {
    document.removeEventListener('mousemove', mouseMoveHandler);
    document.removeEventListener('mouseup', mouseUpHandler);
    contenedorUbicaciones.style.cursor = 'grab';
    contenedorUbicaciones.style.removeProperty('user-select');
}

const mouseDownHandler = (e) => {
    contenedorUbicaciones.style.cursor = 'grabbing';
    contenedorUbicaciones.style.userSelect = 'none';

    pos = {
       // Obteniendo scroll actual
       top: scrollable.scrollTop,
       left: scrollable.scrollLeft,
       // Obtener la ubicación actual del mouse
       x: e.clientX,
       y: e.clientY,
    };

    document.addEventListener('mousemove', mouseMoveHandler);
    document.addEventListener('mouseup', mouseUpHandler);
}

contenedorUbicaciones.addEventListener('mousedown', mouseDownHandler);