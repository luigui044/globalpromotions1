const obtenerFechaHoraActual = () => {
    const fecha = new Date();
    const anio = fecha.getFullYear();
    const mes = fecha.getMonth().toString().length == 1 ? `0${fecha.getMonth() + 1}` : fecha.getMonth() + 1;
    const dia = fecha.getDate().toString().length == 1 ? `0${fecha.getDate()}` : fecha.getDate();
    const fechaActual = `${anio}-${mes}-${dia}`;
    const horaActual = new Intl.DateTimeFormat(undefined, { timeStyle: "short" }).format(new Date());
    const fechaHoraActual = `${fechaActual} ${horaActual}`;
    return fechaHoraActual;
}

const guardarClic = (id_evento, urlRedireccion) => {
    fetch(`https://api.ipify.org?format=json`)
      .then((response) => response.json())
      .then((json) => {
        if (json) {
          fetch(route('clic-evento'), {
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
            },
            method: 'POST',
            body: JSON.stringify({
                fecha_hora: obtenerFechaHoraActual(),
                ip: json.ip,
                id_evento: id_evento
            }),
          })
            .then((res) => res.json())
            .catch((error) => {
                console.error("Error:", error);
                window.location.href = urlRedireccion;
            })
            .then((response) => {
                console.log("Success:", response);
                window.location.href = urlRedireccion;
            });
        } else {
            window.location.href = urlRedireccion;
        }
      })
      .catch((err) => {
        console.log(err);
        window.location.href = urlRedireccion;
      });
}






