<?php
require_once 'conexion.php';
require_once 'funciones.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: lista.php');
    exit;
}
$matricula = trim($_POST['matricula'] ?? '');
if ($matricula === '') {
    paginaResultado('Matrícula no válida', 'No se indicó el alumno que deseas eliminar.', 'error', '<a class="button" href="lista.php">Volver a la lista</a>');
    exit;
}
$stmt = $conexion->prepare('DELETE FROM alumnos WHERE matricula = ?');
$stmt->bind_param('s', $matricula);
if ($stmt->execute() && $stmt->affected_rows > 0) {
    paginaResultado('Alumno eliminado', 'El registro con matrícula <strong>'.e($matricula).'</strong> se eliminó correctamente.', 'success',
        '<a class="button" href="lista.php">Volver a la lista</a>');
} else {
    paginaResultado('No se encontró el alumno', 'El registro pudo haber sido eliminado anteriormente o no existe.', 'error',
        '<a class="button" href="lista.php">Volver a la lista</a>');
}
$stmt->close(); $conexion->close();
?>
