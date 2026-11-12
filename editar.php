<?php
require_once 'conexion.php';
require_once 'funciones.php';
$matricula = trim($_GET['matricula'] ?? '');
if ($matricula === '') {
    paginaResultado('Matrícula no válida', 'No se indicó qué alumno deseas editar.', 'error', '<a class="button" href="lista.php">Volver a la lista</a>');
    exit;
}
$stmt = $conexion->prepare('SELECT matricula, nombre FROM alumnos WHERE matricula = ? LIMIT 1');
$stmt->bind_param('s', $matricula);
$stmt->execute();
$alumno = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$alumno) {
    paginaResultado('Alumno no encontrado', 'El registro que intentas editar no existe.', 'error', '<a class="button" href="lista.php">Volver a la lista</a>');
    exit;
}
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Editar alumno | Nova Escolar</title><link rel="stylesheet" href="estilos.css"></head><body>
<header class="topbar"><a class="brand" href="index.html"><span class="brand-icon">N</span><span>NOVA <small>GESTIÓN ESCOLAR</small></span></a><a class="top-link" href="lista.php">← Lista de alumnos</a></header>
<main class="container narrow"><div class="breadcrumb">INICIO <span>/</span> EDITAR ALUMNO</div><section class="welcome"><p class="eyebrow">ACTUALIZAR REGISTRO</p><h1>Editar alumno</h1><p class="muted">Modifica la información y guarda los cambios.</p></section>
<section class="panel"><div class="panel-title"><span class="quick-icon">✎</span><div><h2>Información del alumno</h2><p class="muted small">La matrícula identifica el registro.</p></div></div>
<form action="actualizar.php" method="POST" class="form">
<label for="matricula">Matrícula</label><input id="matricula" value="<?php echo e($alumno['matricula']); ?>" disabled>
<input type="hidden" name="matricula" value="<?php echo e($alumno['matricula']); ?>">
<label for="nombre">Nombre completo</label><input id="nombre" name="nombre" value="<?php echo e($alumno['nombre']); ?>" required maxlength="120">
<button class="button" type="submit">Guardar cambios <span>→</span></button>
</form></section></main><footer>Nova Escolar <span>·</span> Sistema de gestión escolar</footer></body></html>
<?php $conexion->close(); ?>
