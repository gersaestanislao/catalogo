<!-- Todas las fechas -->

<?php

global $wp_query;

// ======================================================
// INDEX API
// ======================================================

$cursos_api = edmiss_indexar_cursos();
$hay_cards  = false;

?>

<?php // include get_template_directory() . '/inc/faltantes.php'; ?>

<?php if (have_posts()) : ?>

    <div class="catalogo__grid">

        <?php while (have_posts()) : the_post();

            // ======================================================
            // DATOS WP
            // ======================================================

            $dirigido  = get_field('dirigido_a');
            $perfiles  = get_the_terms(get_the_ID(), 'perfil');
            $temas     = get_the_terms(get_the_ID(), 'tema');
            $clave     = get_field('codigo_api');
            $post_type = get_post_type();

            // ======================================================
            // EVITAR CURSOS SIN API
            // ======================================================

            if (empty($clave) || empty($cursos_api[$clave])) {
                continue;
            }

            // ======================================================
            // IMPLEMENTACIONES
            // ======================================================

            $implementaciones = $cursos_api[$clave];

            // ======================================================
            // FECHAS
            // ======================================================

            $hoy = strtotime(date('Y-m-d'));

            $implementaciones_vigentes = [];
            $futuras = [];

            foreach ($implementaciones as $imp) {

                $inicio = !empty($imp['iniciopreregistro'])
                    ? strtotime($imp['iniciopreregistro'])
                    : false;

                $fin = !empty($imp['finpreregistro'])
                    ? strtotime($imp['finpreregistro'])
                    : false;

                // Ignorar implementaciones inválidas
                if (!$inicio || !$fin) {
                    continue;
                }

                // ======================================================
                // IMPLEMENTACIONES VIGENTES
                // ======================================================

                if ($hoy >= $inicio && $hoy <= $fin) {
                    $implementaciones_vigentes[] = $imp;
                }

                // ======================================================
                // IMPLEMENTACIONES FUTURAS
                // ======================================================

                if ($inicio > $hoy) {
                    $futuras[] = $imp;
                }
            }

            // ======================================================
            // ORDENAR IMPLEMENTACIONES VIGENTES POR I1, I2, I10...
            // ======================================================

            usort($implementaciones_vigentes, function ($a, $b) {

                preg_match('/-I(\d+)-/', $a['clavecorta'], $a_match);
                preg_match('/-I(\d+)-/', $b['clavecorta'], $b_match);

                return intval($a_match[1] ?? 0) - intval($b_match[1] ?? 0);
            });

            // ======================================================
            // ORDENAR FUTURAS POR FECHA DE APERTURA
            // ======================================================

            usort($futuras, function ($a, $b) {

                return strtotime($a['iniciopreregistro'])
                    - strtotime($b['iniciopreregistro']);
            });

            // ======================================================
            // ESTADO DEL CURSO
            // ======================================================

            $esta_abierto = !empty($implementaciones_vigentes);

            // ======================================================
            // SELECCIONAR UNA SOLA IMPLEMENTACIÓN VIGENTE
            // Prioridad:
            // 1. Vigente con vacantes > 0
            // 2. Primera vigente como fallback
            // ======================================================

            $seleccion = null;

            foreach ($implementaciones_vigentes as $imp) {

                $vacantes = isset($imp['vacantes']) ? intval($imp['vacantes']) : 0;

                if ($vacantes > 0) {
                    $seleccion = $imp;
                    break;
                }
            }

            if (!$seleccion && !empty($implementaciones_vigentes)) {
                $seleccion = $implementaciones_vigentes[0];
            }

            // ======================================================
            // VARIABLE PARA datos_api.php
            // ======================================================
            // datos_api.php debe leer $resultado[0]
            // para no pintar todas las implementaciones.

            $resultado = $seleccion ? [$seleccion] : [];

            $hay_cards = true;

        ?>

            <!-- CARD -->
            <article class="curso-card curso-card--<?= esc_attr($esta_abierto ? 'abierto' : 'cerrado'); ?>">

                <!-- Media -->
                <div class="curso-card__media">

                    <!-- Imagen -->
                    <?php include get_template_directory() . '/components/moduls/media.php'; ?>

                </div>

                <!-- Body -->
                <a class="curso-card__permalink" href="<?php the_permalink(); ?>">

                    <div class="curso-card__body">

                        <!-- Título -->
                        <h4 class="curso-card__title">
                            <?php the_title(); ?>
                        </h4>

                        <!-- Status -->
                        <?php include get_template_directory() . '/components/moduls/status.php'; ?>

                        <!-- Datos API -->
                        <?php include get_template_directory() . '/components/moduls/datos_api.php'; ?>

                        <!-- Taxonomías -->
                        <?php include get_template_directory() . '/components/moduls/taxonomias-perfiles.php'; ?>

                    </div><!-- /.curso-card__body -->

                </a>

            </article>

        <?php endwhile; ?>

    </div><!-- /.catalogo__grid -->

    <?php if (!$hay_cards) : ?>

        <p>No hay cursos disponibles con estos filtros.</p>

    <?php endif; ?>

    <hr class="red--simple">

    <!-- Pagination -->
    <div class="catalogo__pagination">

        <?php
        echo paginate_links([
            'total'    => $wp_query->max_num_pages,
            'current'  => max(1, get_query_var('paged')),
            'add_args' => $_GET
        ]);
        ?>

    </div>

<?php else : ?>

    <p>No hay cursos disponibles.</p>

<?php endif; ?>