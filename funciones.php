<?php
function e($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}
function paginaResultado($titulo, $mensaje, $tipo = 'error', $acciones = '') {
    $tituloSeguro = e($titulo);
    $mensajeSeguro = $mensaje; // El mensaje debe construirse con e() para los datos variables.
    echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>'.$tituloSeguro.' | Nova Escolar</title><link rel="stylesheet" href="estilos.css"></head><body>';
    echo '<header class="topbar"><a class="brand" href="index.html"><span class="brand-icon">N</span><span>NOVA <small>GESTIÓN ESCOLAR</small></span></a><a class="top-link" href="index.html">← Panel principal</a></header>';
    echo '<main class="container narrow"><div class="breadcrumb">INICIO <span>/</span> RESULTADO</div><section class="welcome"><p class="eyebrow">SISTEMA ESCOLAR</p><h1>Resultado de la operación</h1></section>';
    echo '<section class="result-card '.$tipo.'"><div class="result-symbol">'.($tipo === 'success' ? '✓' : '!').'</div><p class="eyebrow">'.($tipo === 'success' ? 'OPERACIÓN COMPLETADA' : 'ATENCIÓN').'</p><h2>'.$tituloSeguro.'</h2><p>'.$mensajeSeguro.'</p><div class="actions">'.$acciones.'</div></section></main><footer>Nova Escolar <span>·</span> Sistema de gestión escolar</footer></body></html>';
}
?>
