<?php

$resultado = [];

if (!empty($implementaciones_vigentes)) {

    usort($implementaciones_vigentes, function($a, $b) {
        preg_match('/-I(\d+)-/', $a['clavecorta'], $a_match);
        preg_match('/-I(\d+)-/', $b['clavecorta'], $b_match);

        return intval($a_match[1] ?? 0) - intval($b_match[1] ?? 0);
    });

    $seleccion = null;

    foreach ($implementaciones_vigentes as $imp) {
        $vacantes = isset($imp['vacantes']) ? intval($imp['vacantes']) : 0;

        if ($vacantes > 0) {
            $seleccion = $imp;
            break;
        }
    }

    if (!$seleccion) {
        $seleccion = $implementaciones_vigentes[0];
    }

    $resultado = [$seleccion];
}