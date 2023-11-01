<?php
$hostname = 'localhost';
$database = 'blog_database';
$username = 'root';
$password = '';

// Establece la conexión a la base de datos
$conexion = new mysqli($hostname, $username, $password, $database);

// Verifica si hubo un error de conexión
if ($conexion->connect_errno) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configura la codificación de caracteres a UTF-8
if (!$conexion->set_charset("utf8")) {
    echo "Error al configurar la codificación de caracteres: " . $conexion->error;
}

// Si llegas hasta aquí, la conexión fue exitosa
//echo "Conexión exitosa a la base de datos: " . $conexion->host_info;

// No olvides cerrar la conexión cuando hayas terminado de usarla
//$conexion->close();
?>
