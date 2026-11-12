<?php
require_once 'conexion.php';
require_once 'funciones.php';

$matricula = trim($_POST['matricula'] ?? '');
if ($matricula === '') {
    paginaResultado('Matrícula requerida', 'Escribe una matrícula para realizar la búsqueda.', 'error',
        '<a class="button" href="buscar.html">Volver a buscar</a>');
    exit;
}
$stmt = $conexion->prepare('SELECT matricula, nombre FROM alumnos WHERE matricula = ? LIMIT 1');
$stmt->bind_param('s', $matricula);
$stmt->execute();
$resultado = $stmt->get_result();
if ($alumno = $resultado->fetch_assoc()) {
    $contenido = '<p><strong>Matrícula:</strong> '.e($alumno['matricula']).'</p><p><strong>Nombre:</strong> '.e($alumno['nombre']).'</p>';
    $acciones = '<a class="button" href="editar.php?matricula='.rawurlencode($alumno['matricula']).'">Editar alumno</a><a class="button button-secondary" href="lista.php">Ver lista</a>';
    paginaResultado('Alumno encontrado', $contenido, 'success', $acciones);
} else {
    paginaResultado('Sin resultados', 'No se encontró un alumno con la matrícula <strong>'.e($matricula).'</strong>. Verifica el dato e inténtalo de nuevo.', 'error',
        '<a class="button" href="buscar.html">Intentar nuevamente</a><a class="button button-secondary" href="registrar.html">Registrar alumno</a>');
}
$stmt->close();
$conexion->close();
?>
