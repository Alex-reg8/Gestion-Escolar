<?php
require_once 'conexion.php';
require_once 'funciones.php';
$matricula = trim($_POST['matricula'] ?? '');
$nombre = trim($_POST['nombre'] ?? '');
if ($matricula === '' || $nombre === '') {
    paginaResultado('Datos incompletos', 'No se pudo actualizar porque faltan datos.', 'error', '<a class="button" href="lista.php">Volver a la lista</a>');
    exit;
}
$stmt = $conexion->prepare('UPDATE alumnos SET nombre = ? WHERE matricula = ?');
$stmt->bind_param('ss', $nombre, $matricula);
if ($stmt->execute() && $stmt->affected_rows >= 0) {
    paginaResultado('Registro actualizado', 'Los datos del alumno <strong>'.e($matricula).'</strong> fueron actualizados.', 'success',
        '<a class="button" href="lista.php">Volver a la lista</a>');
} else {
    paginaResultado('No se pudo actualizar', 'Ocurrió un problema al modificar el registro.', 'error', '<a class="button" href="lista.php">Volver a la lista</a>');
}
$stmt->close(); $conexion->close();
?>
