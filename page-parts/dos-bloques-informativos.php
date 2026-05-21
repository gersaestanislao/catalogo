<?php
  $titulo = get_sub_field('titulo');
  ?>


<?php if ($titulo) : ?>
    <h2 class="onsite-health__title onsite-health__title--sm">
        <?php echo esc_html($titulo); ?>
    </h2>
    <?php endif; ?>

    <?php if (have_rows('actividades')) : ?>
    <div class="onsite-activities__grid text-left">

        <?php while (have_rows('actividades')) : the_row(); ?>

        <?php
        $texto             = get_sub_field('texto');
        $fondo_verde_claro = get_sub_field('fondo_verde_claro');

        $card_classes = 'onsite-activities__card';

        if ($fondo_verde_claro) {
            $card_classes .= ' bg-imss--light';
        }
        ?>

        <?php if ($texto) : ?>
            <article class="<?php echo esc_attr($card_classes); ?>">
            <div class="onsite-activities__text">
                <?php echo wp_kses_post($texto); ?>
            </div>
            </article>
        <?php endif; ?>

        <?php endwhile; ?>

    </div>
    <?php endif; ?>
