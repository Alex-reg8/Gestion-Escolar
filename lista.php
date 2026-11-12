<?php
require_once 'conexion.php';
require_once 'funciones.php';
$resultado = $conexion->query('SELECT matricula, nombre FROM alumnos ORDER BY nombre ASC');
if (!$resultado) {
    http_response_code(500);
    die('No se pudo consultar la lista de alumnos.');
}
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Lista de alumnos | Nova Escolar</title><link rel="stylesheet" href="estilos.css"></head>
<body>
<header class="topbar"><a class="brand" href="index.html"><span class="brand-icon">N</span><span>NOVA <small>GESTIÓN ESCOLAR</small></span></a><a class="top-link" href="index.html">← Panel principal</a></header>
<main class="container wide">
<div class="breadcrumb">INICIO <span>/</span> LISTA DE ALUMNOS</div>
<section class="welcome welcome-row"><div><p class="eyebrow">DIRECTORIO ESCOLAR</p><h1>Lista de alumnos</h1><p class="muted">Consulta y administra los registros existentes.</p></div><a class="button" href="registrar.html">＋ Registrar alumno</a></section>
<section class="panel table-panel">
<div class="table-head"><div><h2>Alumnos registrados</h2><p class="muted small">Total de registros: <strong><?php echo $resultado->num_rows; ?></strong></p></div><a class="text-link" href="buscar.html">Buscar por matrícula</a></div>
<?php if ($resultado->num_rows > 0): ?>
<div class="table-wrap"><table><thead><tr><th>MATRÍCULA</th><th>NOMBRE COMPLETO</th><th>ACCIONES</th></tr></thead><tbody>
<?php while ($alumno = $resultado->fetch_assoc()): ?>
<tr><td class="matricula"><?php echo e($alumno['matricula']); ?></td><td><?php echo e($alumno['nombre']); ?></td><td><div class="row-actions"><a class="action-link" href="editar.php?matricula=<?php echo rawurlencode($alumno['matricula']); ?>">Editar</a><form action="eliminar.php" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar a <?php echo e($alumno['nombre']); ?>? Esta acción no se puede deshacer.');"><input type="hidden" name="matricula" value="<?php echo e($alumno['matricula']); ?>"><button class="action-link danger-link" type="submit">Eliminar</button></form></div></td></tr>
<?php endwhile; ?>
</tbody></table></div>
<?php else: ?><div class="empty-state"><span>▤</span><h3>Aún no hay alumnos registrados</h3><p class="muted">Cuando agregues alumnos, aparecerán en esta lista.</p><a class="button" href="registrar.html">Registrar primer alumno</a></div><?php endif; ?>
</section></main><footer>Nova Escolar <span>·</span> Sistema de gestión escolar</footer></body></html>
<?php $resultado->free(); $conexion->close(); ?>
