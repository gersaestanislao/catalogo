
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


<main class="search">

    <div class="container">


    <!-- breadcrumb  -->
    <?php include get_template_directory() . '/single-parts/breadcrumbs.php'; ?>
 

        <!-- Header -->
        <header class="search__header">


            <div class="search__reuslt">
                <h4 class="search__title mb-0">
                    Resultados para: "<?php echo get_search_query(); ?>"
                </h4>
                <small class="search__count mb-4 d-block">
                        <?php echo $wp_query->found_posts; ?> Cursos EDIMSS encontrados
                </small>
            </div>

                <!-- Buscador WP -->
                <?php include('components/buscador.php'); ?>

        </header>





        <!-- Resultados -->
        <?php if (have_posts()) : ?>

            <?php 
            // 🔥 API indexada
            $cursos_api = edmiss_indexar_cursos();
            ?>

            <div class="catalogo__grid catalogo__grid--search">

                <?php while (have_posts()) : the_post();

                    $post_type = get_post_type();
                    $clave     = get_field('codigo_api');

                    // 
                    if (empty($clave) || empty($cursos_api[$clave])) {
                     
                    }

                    $implementaciones = $cursos_api[$clave];

                    $hoy = strtotime(date('Y-m-d'));

                    $implementaciones_vigentes = [];

                    foreach ($implementaciones as $imp) {

                        $inicio = !empty($imp['iniciopreregistro']) ? strtotime($imp['iniciopreregistro']) : false;
                        $fin    = !empty($imp['finpreregistro']) ? strtotime($imp['finpreregistro']) : false;

                        if ($inicio && $fin && $hoy >= $inicio && $hoy <= $fin) {
                            $implementaciones_vigentes[] = $imp;
                        }
                    }

                    $esta_abierto = !empty($implementaciones_vigentes);
                ?>

                <!-- CARD -->
                <article class="curso-card curso-card--<?= $esta_abierto ? 'abierto' : 'cerrado'; ?>">

                    <div class="curso-card__media">
                        <?php include get_template_directory() . '/components/moduls/media.php'; ?>
                    </div>

                    <a class="curso-card__permalink" href="<?php the_permalink(); ?>">

                        <div class="curso-card__body">

                            <h4 class="curso-card__title"><?php the_title(); ?></h4>

                            <!-- Estado -->
                            <?php include get_template_directory() . '/components/moduls/status.php'; ?>

                            <!-- Datos API -->
                            <?php include get_template_directory() . '/components/moduls/datos_api.php'; ?>

                            <!-- Taxonomías -->
                            <?php include get_template_directory() . '/components/moduls/taxonomias-perfiles.php'; ?>

                        </div>

                    </a>

                </article>

                <?php endwhile; ?>

            </div>

            <!-- Paginación -->
            <div class="catalogo__pagination">
                <?php
                echo paginate_links([
                    'total'   => $wp_query->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'add_args'=> $_GET
                ]);
                ?>
            </div>

        <?php else : ?>

            <div class="search__empty">
                <p>No se encontraron resultados.</p>
            </div>

        <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>