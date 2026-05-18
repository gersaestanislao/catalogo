<article class="curso-card curso-card--abierto">

    <div class="curso-card__media"> 
        <!-- img  -->
        <img width="768" height="261" src="http://localhost:8888/cat/wp/wp-content/uploads/2026/03/Ban_EIVRAPP_V1A_1440x490-768x261.png" class="curso-card__image wp-post-image" alt="" decoding="async" srcset="http://localhost:8888/cat/wp/wp-content/uploads/2026/03/Ban_EIVRAPP_V1A_1440x490-768x261.png 768w, http://localhost:8888/cat/wp/wp-content/uploads/2026/03/Ban_EIVRAPP_V1A_1440x490-300x102.png 300w, http://localhost:8888/cat/wp/wp-content/uploads/2026/03/Ban_EIVRAPP_V1A_1440x490-1024x348.png 1024w, http://localhost:8888/cat/wp/wp-content/uploads/2026/03/Ban_EIVRAPP_V1A_1440x490.png 1440w" sizes="(max-width: 768px) 100vw, 768px">                   
    </div>
  
    <!-- Obtener la fecha actual -->
    
    <div class="curso-card__body">
        <h4 class="curso-card__title">PAI código infarto para el personal de Enfermería</h4>
        <ul class="curso-card__list">
            <li class="curso-card__list-item"><i class="fa-regular fa-calendar"></i>Inscripciones: 2026-03-12</li>
            <li class="curso-card__list-item"><i class="fa-regular fa-flag"></i>Vacantes: 437</li>
        </ul>
        <div class="curso-card__perfiles">
            <div class="curso-card__tags-content">
                <span class="curso-card__tag  curso-card__tag--enfermeria">
                        Enfermería
                </span>
            </div>
        </div>
        
    </div>

</article>




<article class="curso-card curso-card--<?php echo esc_attr($estado); ?>">

    <!-- img  -->
    <div class="curso-card__media">
        <?php if(has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium_large', [
                'class' => 'curso-card__image'
            ]); ?>
        <?php endif; ?>
    </div>

    <div class='curso-card__body'>
        <!-- Título del curso  -->
        <h4 class='curso-card__title'>  <?php the_title(); ?></h4>
        <!-- Obtener implementaciones del curso actual -->

        <!-- Obtener la fecha actual -->
        <?php
        $hoy = date('Y-m-d');

        /* Filtrar implementaciones vigentes */
        $implementaciones_vigentes = array_filter($implementaciones, function($imp) use ($hoy){

            return (
                $hoy >= $imp['iniciopreregistro'] &&
                $hoy <= $imp['finpreregistro']
            );

        });
        ?>

        <?php
        echo "<ul class='curso-card__list'>";

        // 👇 SIEMPRE visible
        echo "<li class='curso-card__list-item'>
                <strong>Clave:</strong> {$clave}
            </li>"; 

            echo "<li>ID API: {$imp['id_curso']}</li>";
            echo "<li>Shortname: {$imp['shortname']}</li>";
            
            
            $futuras = array_filter($implementaciones, function($imp) use ($hoy){
                return $imp['iniciopreregistro'] > $hoy;
            });
            
            usort($futuras, function($a, $b){
                return strtotime($a['iniciopreregistro']) - strtotime($b['iniciopreregistro']);
            });
            
            $proxima = $futuras[0] ?? null;
            
            ?>
        

        <?php

                if(!empty($implementaciones_vigentes)){

                    // 🔵 ABIERTO
                    $imp = array_values($implementaciones_vigentes)[0];

                    echo "<li class='curso-card__list-item'>
                            <i class='fa-regular fa-calendar'></i>
                            Inscripciones: {$imp['iniciopreregistro']}
                        </li>";

                    echo "<li class='curso-card__list-item'>
                            <i class='fa-regular fa-flag'></i>
                            Vacantes: {$imp['vacantes']}
                        </li>";

                    echo "<li class='curso-card__list-item'><span class='status status--abierto'>Abierto</span></li>";

                } elseif($proxima){

                    // 🟡 PRÓXIMAMENTE
                    echo "<li class='curso-card__list-item'>
                            <i class='fa-regular fa-calendar'></i>
                            Próxima apertura: {$proxima['iniciopreregistro']}
                        </li>";

                    echo "<li class='curso-card__list-item'><span class='status status--proximo'>Próximamente</span></li>";

                } else {

                    // 🔴 CERRADO
                    echo "<li class='curso-card__list-item'>
                            <span class='status status--cerrado'>Cerrado</span>
                        </li>";
                }

                echo "</ul>";   
        ?>

            <?php if($perfiles) : ?>
            <div class="curso-card__perfiles">
                <div class="curso-card__tags-content">
                    <?php foreach($perfiles as $perfil) : ?>
                        <span class="curso-card__tag  curso-card__tag--<?php echo esc_html($perfil->slug); ?>">
                            <?php echo esc_html($perfil->name); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

    </div>

</article>