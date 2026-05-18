<?php

    if( !empty($implementaciones_vigentes) ){

        // Agrupar por fecha
        $agrupadas = [];

        foreach($implementaciones_vigentes as $imp){
            $fecha = $imp['iniciopreregistro'];
            $agrupadas[$fecha][] = $imp;
        }

        $resultado = [];

        // Grupo
        foreach($agrupadas as $fecha => $grupo){

            // ordenar por número de implementación
            usort($grupo, function($a, $b){

                preg_match('/-I(\d+)-/', $a['clavecorta'], $a_match);
                preg_match('/-I(\d+)-/', $b['clavecorta'], $b_match);

                return intval($a_match[1] ?? 0) - intval($b_match[1] ?? 0);
            });

            // 3. Buscar primera con vacantes
            $seleccion = null;

            foreach($grupo as $imp){
                if($imp['vacantes'] > 0){
                    $seleccion = $imp;
                    break;
                }
            }

            // Si todas están llenas → usar la primera
            if(!$seleccion){
                $seleccion = $grupo[0];
            }

            $resultado[] = $seleccion;
        }

        //  Mostrar resultado final
        foreach($resultado as $imp){

           // Fecha formateda 
          $fecha_raw = $imp['iniciopreregistro'];
          $fecha = DateTime::createFromFormat('Y-m-d', $fecha_raw);

            preg_match('/-I(\d+)-/', $imp['clavecorta'], $match);
            $num_impl = $match[1] ?? '';
            echo "<ul class='curso-card__list'>";
            //echo "<h4>Implementación I{$num_impl} / 2026</h4>";
            echo "
            <li class='curso-card__list-item'>
                <i class='fa-regular fa-calendar'></i>
                Inscrip: " . edmiss_formatear_fecha($imp['iniciopreregistro']) . "
            </li>";
            // echo "Fin: {$imp['nombre']}<br>";
            echo "<li class='curso-card__list-item'>" . "<i class='fa-regular fa-flag'></i>" . "Vacantes: {$imp['vacantes']}</li>";
            //echo "ID: {$imp['id']}<br><br>";
            //echo "horas lectivas: {$imp['horas']}<br><br>";
            //echo "tutorizado: {$imp['tutorizado']}<br><br>";


            echo "</ul>";
        
        }

    }
?>