<?php
// Configuración de la conexión a la base de datos
$servername = "173.201.185.36"; // Cambia esto por el nombre de tu servidor
$username = "adminProyection2"; // Cambia esto por tu nombre de usuario de la base de datos
$password = "Entrada2021."; // Cambia esto por tu contraseña de la base de datos
$dbname = "global_prom"; // Cambia esto por el nombre de tu base de datos

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Ejecutar el procedimiento almacenado
$sql = "CALL pa_prueba()"; // Cambia "nombre_procedimiento" por el nombre de tu procedimiento almacenado

if ($conn->query($sql) === TRUE) {
    echo "El procedimiento almacenado se ejecutó correctamente.";
} else {
    echo "Error al ejecutar el procedimiento almacenado: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
