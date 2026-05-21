<?php
$cursos_api = edmiss_indexar_cursos();

$args = [
    'post_type'      => 'cursos_edmiss',
    'posts_per_page' => 20,
];

$cursos = new WP_Query($args);
$post_type = 'cursos_edmiss';
?>

<?php if ($cursos->have_posts()) : ?>
<section class="cursos_home">
<div class="container">

<div class="cursos_home__head">
    <div class="cursos_home__wrapp">
        <h4 class="text-left">Cursos Destacados EDIMSS</h4> 
        <a class="boton boton--link boton--icon" type="button">
        Ver el catálogo completo
        <i class="fa-solid fa-arrow-right-long"></i>
    </a>
    </div>
    <hr class="red">
</div>

<div class="courses">
<div class="courses__wrapper container">
<div class="courses__carousel courses__carousel-edimss owl-carousel">

<?php 
$count = 0;

while ($cursos->have_posts()) : $cursos->the_post();

    $clave = get_field('codigo_api');

    if (empty($clave) || empty($cursos_api[$clave])) {
        continue;
    }

    $implementaciones = $cursos_api[$clave];
    $hoy = date('Y-m-d');

    $implementaciones_vigentes = [];

    foreach($implementaciones as $imp){

        $inicio = !empty($imp['iniciopreregistro']) 
            ? date('Y-m-d', strtotime($imp['iniciopreregistro'])) 
            : false;

        $fin = !empty($imp['finpreregistro']) 
            ? date('Y-m-d', strtotime($imp['finpreregistro'])) 
            : false;

        if ($inicio && $fin && $hoy >= $inicio && $hoy <= $fin) {
            $implementaciones_vigentes[] = $imp;
        }
    }

    if (empty($implementaciones_vigentes)) continue;

    // ordenar por implementación
    usort($implementaciones_vigentes, function($a, $b){
        preg_match('/-I(\d+)-/', $a['clavecorta'], $a_match);
        preg_match('/-I(\d+)-/', $b['clavecorta'], $b_match);

        return intval($a_match[1] ?? 0) - intval($b_match[1] ?? 0);
    });

    // seleccionar implementación
    $seleccion = null;

    foreach ($implementaciones_vigentes as $imp) {
        if (!empty($imp['vacantes']) && $imp['vacantes'] > 0) {
            $seleccion = $imp;
            break;
        }
    }

    if (!$seleccion) {
        $seleccion = $implementaciones_vigentes[0];
    }

    //Mod
    $resultado = [$seleccion];

    $esta_abierto = true;

    // límite real
    $count++;
    if ($count > 10) break;

    $perfiles = get_the_terms(get_the_ID(), 'perfil');
    $temas    = get_the_terms(get_the_ID(), 'tema');
?>

<!-- Card -->
<article class="curso-card curso-card--abierto">

    <div class="curso-card__media">
            <?php edmiss_get_course_image(); ?>
    </div>

    <a class="curso-card__permalink" href="<?php the_permalink(); ?>">
        <div class='curso-card__body'>

            <h4 class='curso-card__title'>  <?php echo wp_trim_words(get_the_title(), 7, '…'); ?>    </h4> 

            <!--  Status -->
            <?php include get_template_directory() . '/components/moduls/status.php'; ?>

            <!--  Datos API -->
            <?php include get_template_directory() . '/components/moduls/datos_api.php'; ?>

            <!--  Taxonomías -->
            <?php include get_template_directory() . '/components/moduls/taxonomias-perfiles.php'; ?>
            
        </div>
    </a>

</article>

<?php endwhile; ?>

</div>

<button class="courses__arrow courses__arrow--prev-sm courses__arrow--next-edimss" aria-label="Anterior"></button>
<button class="courses__arrow courses__arrow--next-sm courses__arrow--next-edimss" aria-label="Siguiente"></button>

</div>
</div>

</div>



</section>

<?php wp_reset_postdata(); ?>
<?php endif; ?>