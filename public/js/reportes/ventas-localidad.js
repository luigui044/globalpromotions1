const frmEvento = document.querySelector('#frm-evento');
const cuerpoTabla = document.querySelector('#tbody-venta-localidad');
const reporte = document.querySelector('#contenedor-reporte');
const loader = document.querySelector('#contenedor-loader');

const estaVacio = (valor) => {
    if (valor === undefined || valor == null || valor.trim().length == 0) {
        return true;
    }
    return false;
}

const htmlLoader = () => {
    return `<div class="preloader-wrapper active">
        <div class="spinner-layer spinner-blue-only">
        <div class="circle-clipper left">
            <div class="circle"></div>
        </div>
        <div class="gap-patch">
            <div class="circle"></div>
        </div>
        <div class="circle-clipper right">
            <div class="circle"></div>
        </div>
        </div>
    </div>`;
}

const htmlSinResultados = () => {
    return `<td colspan="4">
                <div class="d-flex justify-content-center">
                    <b class="text-danger text-center">SIN RESULTADOS</b>
                </div>
            </td>`;
}

const obtenerVentasPorLocalidad = async (id_evento) => {
    try {
        const response = await fetch(route('reporte.ventas.localidad'), {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
            },
            method: 'POST',
            body: JSON.stringify({
                id_evento: id_evento
            }),
        });

        if (response.status === 200) {
            const data = await response.text();
            console.log(data);
            return data;
        }
        return false;
    } catch(error) {
        console.error(error);
        return false;
    }
}

frmEvento.addEventListener('submit', async (e) => {
    e.preventDefault();

    const id_evento = document.querySelector('#id_evento').value;

    if (!estaVacio(id_evento)) {
        reporte.classList.add('d-none');
        loader.innerHTML = htmlLoader();
        loader.style.display = 'flex';

        const ventas = await obtenerVentasPorLocalidad(id_evento);

        if (ventas) {
            cuerpoTabla.innerHTML = ventas;
        } else {
            cuerpoTabla.innerHTML = htmlSinResultados();
        }

        loader.innerHTML = '';
        loader.style.display = 'none';
        reporte.classList.remove('d-none');
    }
});