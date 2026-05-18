<?php

$resultado = [];

if( !empty($implementaciones_vigentes) ){

    $agrupadas = [];

    foreach($implementaciones_vigentes as $imp){
        $fecha = $imp['iniciopreregistro'];
        $agrupadas[$fecha][] = $imp;
    }

    foreach($agrupadas as $fecha => $grupo){

        usort($grupo, function($a, $b){
            preg_match('/-I(\d+)-/', $a['clavecorta'], $a_match);
            preg_match('/-I(\d+)-/', $b['clavecorta'], $b_match);

            return intval($a_match[1] ?? 0) - intval($b_match[1] ?? 0);
        });

        $seleccion = null;

        foreach($grupo as $imp){
            if($imp['vacantes'] > 0){
                $seleccion = $imp;
                break;
            }
        }

        if(!$seleccion){
            $seleccion = $grupo[0];
        }

        $resultado[] = $seleccion;
    }
}
?>