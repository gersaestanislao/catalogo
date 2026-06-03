
<?php 
// =======================
// CABECERA GLOBAL DEL SITIO
// =======================
include('header.php'); ?>


<?php 
    // =======================
    // CABECERA GLOBAL DEL SITIO
    // =======================
    include('components/navbar.php'); ?>


    <?php   // Indexar cusrso 
        $cursos_api = edmiss_indexar_cursos(); ?>

            <?php if(have_posts()) : ?>
            <?php while(have_posts()) : the_post();
                    
            // Datos WP
            $dirigido  = get_field('dirigido_a');
            $acerca  = get_field('acerca');
            $objetivo  = get_field('objetivo');
            $contenido = get_field('contenido');
            $perfiles  = get_the_terms(get_the_ID(), 'perfil');
            $temas     = get_the_terms(get_the_ID(), 'tema');
            $clave     = get_field('codigo_api');
            $post_type = get_post_type();

            // Implementaciones del curso
            $implementaciones = $cursos_api[$clave] ?? [];


            // Fechas
            $hoy = strtotime(date('Y-m-d'));

            $implementaciones_vigentes = [];
            $futuras = [];

            foreach($implementaciones as $imp){

                $inicio = !empty($imp['iniciopreregistro']) ? strtotime($imp['iniciopreregistro']) : false;
                $fin    = !empty($imp['finpreregistro']) ? strtotime($imp['finpreregistro']) : false;

                if(!$inicio) continue;

                // Vigentes
                if($inicio && $fin && $hoy >= $inicio && $hoy <= $fin){
                    $implementaciones_vigentes[] = $imp;
                }

                // Futuras
                if($inicio > $hoy){
                    $futuras[] = $imp;
                }
            }

            // Ordenar futuras por fecha
            usort($futuras, function($a, $b){
                return strtotime($a['iniciopreregistro']) - strtotime($b['iniciopreregistro']);
            });

            // Estado del curso
            $esta_abierto = !empty($implementaciones_vigentes);
         ?>



            <!--Calculo de las inplemetaciones  -->
            <?php include get_template_directory() . '/inc/calculo.php'; ?>

            <!--Variables de datos API -->
            <?php include get_template_directory() . '/inc/variables-datos.php'; ?>




                <!-- Hero -->
                <div class="container">

                    <!-- wrapp section  -->
                    <div class="wrapp-section">
                    
                        <!-- breadcrumb  -->
                        <?php include get_template_directory() . '/single-parts/breadcrumbs.php'; ?>


                        <!-- Hero  -->
                        <?php include get_template_directory() . '/single-parts/hero.php'; ?>


                        <!-- curso detalle -->
                        <section class="course-content">

                            <!-- Tabs -->
                            <div class="course-tabs">
                                <button class="course-tabs__btn is-active" data-tab="acerca">
                                ACERCA DE CURSO
                                </button>
                                <button class="course-tabs__btn" data-tab="reglas">
                                REGLAS DE INSCRIPCIÓN
                                </button>
                                <button class="course-tabs__btn" data-tab="faq">
                                PREGUNTAS FRECUENTES
                                </button>
                            </div>

                            <div class="course-content__grid">

                                <!-- Contenido -->
                                <div class="course-content__main">

                                    <!-- Acerca -->
                                    <?php include get_template_directory() . '/single-parts/tabs-acerca.php'; ?>

                                    <!-- Reglas -->
                                    <?php include get_template_directory() . '/single-parts/tabs-reglas.php'; ?>
                        
                                    <!--Preguntas F-->
                                    
                                    <?php include get_template_directory() . '/single-parts/tab-faq.php'; ?>

                                    <hr>
                  
                                    <!-- Compartir  -->
                                    <?php include get_template_directory() . '/single-parts/share.php'; ?>
                                

                                </div><!--/// Contenido -->

                                <!-- Sidebar-->
                                <aside class="course-content__sidebar">

                                   
                                    <!-- Iinformación del curso -->
                                    <?php include get_template_directory() . '/single-parts/info-curso.php'; ?>
                                    

                                     <!-- Datos dinámicos  API solo local y QA-->

                                     <?php

                                        if (
                                            current_user_can('manage_options')
                                        ) :

                                            include get_template_directory() . '/components/moduls/implementaciones.php';
                                     
                                        endif;
                                        ?>


                                </aside> <!-- //Sidebar-->

                            </div>

                        </section>

                    </div>
                </div>


<?php endwhile; ?>

<?php else : ?>
        <p>No hay cursos disponibles.</p>
    <?php endif; ?>



<?php 
    // =======================
    // MODAL Microlecciones
    // =======================
    include('single-parts/modal-microlecciones.php'); ?>   

<?php 
// =======================
// FOOTER GLOBAL DEL SITIO
// =======================

include('footer.php'); ?>


