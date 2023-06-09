const frmEvento = document.querySelector('#frm-evento');
const cuerpoTabla = document.querySelector('#tbody-venta-localidad');
const reporte = document.querySelector('#contenedor-reporte');
const loader = document.querySelector('#contenedor-loader');
const inputFechas = document.querySelector('#fechas-reporte');
const chkFechas = document.querySelector('#chk-fechas');
const contenedorFechas = document.querySelector('#contenedor-fechas');
const submitFechas = document.querySelector('#submit-fechas');

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

const obtenerVentasPorLocalidad = async (id_evento, fechas) => {
    try {
        const response = await fetch(route('reporte.ventas.localidad'), {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
            },
            method: 'POST',
            body: JSON.stringify({
                id_evento: id_evento,
                fechas_reporte: fechas
            }),
        });

        if (response.status === 200) {
            const data = await response.text();
            return data;
        }
        return false;
    } catch(error) {
        console.error(error);
        return false;
    }
}

const convertirA24Horas = (horaCompleta) => {
    const partes = horaCompleta.split(' ');
    let hora = partes[0].split(':')[0];
    const minutos = partes[0].split(':')[1];
    const formato12 = partes[1];

    if ((hora < 12)&& (formato12.toLowerCase() == 'pm')) {
        hora = parseInt(hora) + 12;
    } else if ((hora == 12) && (formato12.toLowerCase() == 'am')) {
        hora = parseInt(hora) - 12;
    }

    const nuevaHora = `${hora}:${minutos}`;
    return nuevaHora;
}

const convertirFormatoFecha = (fecha) => {
    const partes = fecha.split('/');
    const dia = partes[0];
    const mes = partes[1];
    const anio = partes[2];
    return `${anio}-${mes}-${dia}`;
}

const obtenerFecha = (fechaHora) => {
    const partes = fechaHora.split(' ');
    const fecha = partes[0];
    return fecha;
}

const obtenerHora = (fechaHora) => {
    const partes = fechaHora.split(' ');
    const hora = `${partes[1]} ${partes[2]}`;
    return hora;
}

const obtenerRangoFechasYHoras = (cadena) => {
    const fechaHoraInicialFinal = cadena.split('-');
    const fechaHoraInicial = fechaHoraInicialFinal[0].trim();
    const fechaHoraFinal = fechaHoraInicialFinal[1].trim();
    const fechaInicial = convertirFormatoFecha(obtenerFecha(fechaHoraInicial));
    const fechaFinal = convertirFormatoFecha(obtenerFecha(fechaHoraFinal));
    const horaInicial = convertirA24Horas(obtenerHora(fechaHoraInicial));
    const horaFinal = convertirA24Horas(obtenerHora(fechaHoraFinal));

    return {
        fecha_hora_inicial: `${fechaInicial} ${horaInicial}`,
        fecha_hora_final: `${fechaFinal} ${horaFinal}`
    }
}

// Con esto se instancia el calendario que permite seleccionar rangos de fechas y horas
$('#fechas-reporte').daterangepicker({
    timePicker: true,
    startDate: moment().startOf("hour"),
    endDate: moment().startOf("hour").add(32, "hour"),
    timePicker24Hour: true,
    locale: {
        format: "DD/MM/YYYY hh:mm A",
    },
});

// Ocultando selector de fechas y estableciendo valor de input en vacío, por defecto
contenedorFechas.style.display = 'none';
submitFechas.value = '';

chkFechas.addEventListener('click', () => {
    if (chkFechas.checked) {
        contenedorFechas.style.display = 'block';
    } else {
        contenedorFechas.style.display = 'none';
        submitFechas.value = '';
    }
});

frmEvento.addEventListener('submit', async (e) => {
    e.preventDefault();
    const id_evento = document.querySelector('#id_evento').value;

    if (!estaVacio(id_evento)) {
        // Se guarda en el input oculto una cadena que contiene ya formateada la fecha
        // inicial y final para la consulta solo si está activo el filtro de fecha
        if (chkFechas.checked) {
            const fechas = obtenerRangoFechasYHoras(inputFechas.value);
            submitFechas.value = `${fechas.fecha_hora_inicial};${fechas.fecha_hora_final}`;
        }
        
        reporte.classList.add('d-none');
        loader.innerHTML = htmlLoader();
        loader.style.display = 'flex';

        const ventas = await obtenerVentasPorLocalidad(id_evento, submitFechas.value);

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