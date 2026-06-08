<?php

$args = [
    'post_type'      => 'microlecciones',
    'posts_per_page' => 10,
];

$micro = new WP_Query($args);
$terms = get_the_terms(get_the_ID(), 'tema');
?>

<?php if ($micro->have_posts()) : ?>
<section class="cursos_home cursos_home--micro">

<div class="container">

<div class="cursos_home__head">
    <div class="cursos_home__wrapp">
        <h4 class="text-left">Microlecciones destacadas</h4> 

        <a href="<?php echo esc_url(home_url('/microlecciones')); ?>" 
           class="boton boton--link boton--icon">
            Ver el catálogo completo
            <i class="fa-solid fa-arrow-right-long"></i>
        </a>
    </div>

    <hr class="red">
</div>

<div class="courses">
<div class="courses__wrapper container">
<div class="courses__carousel courses__carousel-micro owl-carousel">

<?php while ($micro->have_posts()) : $micro->the_post(); ?>

<?php
$terms = get_the_terms(get_the_ID(), 'tema');
?>

<!-- Card -->
<article class="curso-card">

    <div class="curso-card__media">
        <?php edmiss_get_course_image(); ?>
    </div>

    <a class="curso-card__permalink" href="<?php the_permalink(); ?>">
        <div class='curso-card__body'>

            <h4 class='curso-card__title curso-card__title--micro '>
                <?php echo wp_trim_words(get_the_title(), 8, '…'); ?>
            </h4> 

            <?php if(!empty($terms) && !is_wp_error($terms)) : ?>
                <div class="curso-card__tags mt-4">
                    <div class="curso-card__tags-content">
                        <?php foreach($terms as $term) : ?>
                            <span class="curso-card__tag curso-card__tag--<?php echo esc_attr($term->slug); ?>">
                                <?php echo esc_html($term->name); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

    

        </div>
    </a>

</article>

<?php endwhile; ?>

</div>

<button class="courses__arrow courses__arrow--prev-sm courses__arrow--next-micro" aria-label="Anterior"></button>
<button class="courses__arrow courses__arrow--next-sm courses__arrow--next-micro" aria-label="Siguiente"></button>

</div>
</div>

</div>

</section>

<?php wp_reset_postdata(); ?>
<?php endif; ?>



