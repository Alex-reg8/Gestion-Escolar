<?php
require_once 'conexion.php';
require_once 'funciones.php';

$matricula = trim($_POST['matricula'] ?? '');
$nombre = trim($_POST['nombre'] ?? '');
if ($matricula === '' || $nombre === '') {
    paginaResultado('Faltan datos', 'La matrícula y el nombre son obligatorios.', 'error',
        '<a class="button" href="registrar.html">Volver al formulario</a>');
    exit;
}
$stmt = $conexion->prepare('INSERT INTO alumnos (matricula, nombre) VALUES (?, ?)');
$stmt->bind_param('ss', $matricula, $nombre);
if ($stmt->execute()) {
    paginaResultado('Alumno registrado', 'Se agregó a <strong>'.e($nombre).'</strong> con la matrícula <strong>'.e($matricula).'</strong>.', 'success',
        '<a class="button" href="lista.php">Ver lista de alumnos</a><a class="button button-secondary" href="registrar.html">Registrar otro</a>');
} elseif ($conexion->errno === 1062) {
    paginaResultado('Matrícula existente', 'Ya hay un alumno registrado con esa matrícula. Utiliza una matrícula diferente.', 'error',
        '<a class="button" href="registrar.html">Volver al formulario</a>');
} else {
    paginaResultado('No se pudo registrar', 'Ocurrió un error al guardar el registro. Revisa la configuración de la base de datos.', 'error',
        '<a class="button" href="registrar.html">Intentar nuevamente</a>');
}
$stmt->close();
$conexion->close();
?>
