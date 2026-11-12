<?php
// Configuración de conexión. Ajusta estos datos si tu servidor utiliza otros valores.
$host = "localhost";
$usuario = "root";
$password = "";
$bd = "escuela";

mysqli_report(MYSQLI_REPORT_OFF);
$conexion = new mysqli($host, $usuario, $password, $bd);

if ($conexion->connect_error) {
    http_response_code(500);
    die("No se pudo conectar con la base de datos. Verifica los datos de conexion en conexion.php.");
}
$conexion->set_charset("utf8mb4");
?>
