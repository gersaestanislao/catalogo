<?php

// =============================
// XML Cursos abiertos
// =============================
add_action('init', function () {
    add_rewrite_rule('^cursos-abiertos\.xml$', 'index.php?cursos_abiertos=1', 'top');
});

add_filter('query_vars', function ($vars) {
    $vars[] = 'cursos_abiertos';
    return $vars;
});

add_action('template_redirect', function () {

    if (get_query_var('cursos_abiertos')) {

        header('Content-Type: text/xml; charset=utf-8');

        $cursos_api = edmiss_indexar_cursos();
        $hoy = current_time('Y-m-d');

        $cursos_unicos = [];

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<cursos>';

        foreach ($cursos_api as $codigo => $implementaciones) {

            $vigentes = [];

            foreach ($implementaciones as $imp) {

                $inicio = !empty($imp['iniciopreregistro']) 
                    ? date('Y-m-d', strtotime($imp['iniciopreregistro'])) 
                    : false;

                $fin = !empty($imp['finpreregistro']) 
                    ? date('Y-m-d', strtotime($imp['finpreregistro'])) 
                    : false;

                if ($inicio && $fin && $hoy >= $inicio && $hoy <= $fin) {
                    $vigentes[] = $imp;
                }
            }

            if (empty($vigentes)) continue;

            // Ordenar por implementación
            usort($vigentes, function($a, $b){
                preg_match('/-I(\d+)-/', $a['clavecorta'], $a_match);
                preg_match('/-I(\d+)-/', $b['clavecorta'], $b_match);

                return intval($a_match[1] ?? 0) - intval($b_match[1] ?? 0);
            });

            // Selección inteligente
            $seleccion = null;

            foreach ($vigentes as $imp) {
                if (!empty($imp['vacantes']) && $imp['vacantes'] > 0) {
                    $seleccion = $imp;
                    break;
                }
            }

            if (!$seleccion) {
                $seleccion = $vigentes[0];
            }

            // Extraer número de implementación (I1, I2…)
            preg_match('/-I(\d+)-/', $seleccion['clavecorta'], $match);
            $implementacion = $match[1] ?? '';

            // XML
            echo '<curso>';

            echo '<id>' . esc_html($seleccion['id']) . '</id>';
            echo '<clave>' . esc_html($codigo) . '</clave>';
            echo '<clavecorta>' . esc_html($seleccion['clavecorta']) . '</clavecorta>';
            echo '<implementacion>I' . esc_html($implementacion) . '</implementacion>';

            echo '<nombre>' . esc_html($seleccion['nombre']) . '</nombre>';

            echo '<inicio_inscripcion>' . esc_html($seleccion['iniciopreregistro']) . '</inicio_inscripcion>';
            echo '<fin_inscripcion>' . esc_html($seleccion['finpreregistro']) . '</fin_inscripcion>';

            echo '<vacantes>' . esc_html($seleccion['vacantes']) . '</vacantes>';
            echo '<horas>' . esc_html($seleccion['horas']) . '</horas>';

            echo '</curso>';

            $cursos_unicos[$codigo] = true;
        }

        echo '<total>' . count($cursos_unicos) . '</total>';
        echo '</cursos>';

        exit;
    }
});
