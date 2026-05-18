<?php 


// Validación base
$item = (!empty($resultado) && isset($resultado[0])) ? $resultado[0] : null;


// Fechas inscripción
$iniciopreregistro = '';
$finpreregistro    = '';

if ($item) {
    if (!empty($item['iniciopreregistro'])) {
        $iniciopreregistro = edmiss_formatear_fecha($item['iniciopreregistro']);
    }

    if (!empty($item['finpreregistro'])) {
        $finpreregistro = edmiss_formatear_fecha($item['finpreregistro']);
    }
}


// Fechas del curso
$fchinic = '';
$fchfin  = '';

if ($item) {
    if (!empty($item['fchinic'])) {
        $fchinic = edmiss_formatear_fecha($item['fchinic']);
    }

    if (!empty($item['fchfin'])) {
        $fchfin = edmiss_formatear_fecha($item['fchfin']); // ← corregido
    }
}

// Datos adicionales

$id         = '';
$vacantes   = '';
$horas      = '';
$tipo_formacion = '';

if ($item) {
    $id         = esc_attr($item['id'] ?? '');
    $vacantes   = esc_attr($item['vacantes'] ?? '');
    $horas      = esc_attr($item['horas'] ?? '');
    $tipo_formacion = esc_attr($item['tipo_formacion'] ?? '');
}

?>