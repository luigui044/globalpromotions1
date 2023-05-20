<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
</head>
<body>
    <h1>Hola mundo</h1>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        Echo.channel('home').listen('NewMessage', (e) => {
            console.log(e.mensaje)
        })
    </script>
</body>
</html>