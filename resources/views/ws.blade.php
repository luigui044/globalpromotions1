<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba WS</title>
</head>
<body>
    <h2>Prueba WS</h2>
    <p id="mensaje">No hay mensaje</p>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script>
        const mensaje = document.querySelector('#mensaje');
        Echo.channel('PreReservaMesa').listen('NewPreReservaMesa', (e) => {
            const mesa = e.mesa;
            const asiento = e.asiento;
            //mostrarUbicacionPrerreservada(mesa, asiento);
            mensaje.textContent = `La mesa es: ${mesa} el asiento es: ${asiento}`;
        });
    </script>
</body>
</html>