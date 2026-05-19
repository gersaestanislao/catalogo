<?php
    $titulo       = get_sub_field('titulo');
    $descripcion  = get_sub_field('descripcion');
    $boton        = get_sub_field('boton');
    $imagen       = get_sub_field('imagen');
?>

<?php if ($titulo) : ?>
  <h2 class="onsite-health__title">
    <?php echo esc_html($titulo); ?>
  </h2>
<?php endif; ?>

<article class="onsite-health__hero">

  <div class="onsite-health__content">

    <?php if ($descripcion) : ?>
      <div class="onsite-health__text text-left">
      <?php echo wp_kses_post($descripcion); ?>
    </div>
    <?php endif; ?>

    <?php if ($boton) : ?>
      <a 
        class="btn boton boton--primario btn-sm" 
        href="<?php echo esc_url($boton['url']); ?>"
        target="<?php echo esc_attr($boton['target'] ?: '_self'); ?>"
      >
        <?php echo esc_html($boton['title']); ?>
      </a>
    <?php endif; ?>

  </div>

  <?php if ($imagen) : ?>
    <figure class="onsite-health__figure">
      <img
        class="onsite-health__image"
        src="<?php echo esc_url($imagen['url']); ?>"
        alt="<?php echo esc_attr($imagen['alt'] ?: $titulo); ?>"
      >
    </figure>
  <?php endif; ?>

  <?php if (have_rows('descargables')) : ?>
    <div class="onsite-health__downloads">

      <?php while (have_rows('descargables')) : the_row(); ?>

        <?php
        $archivo = get_sub_field('archivo');
        $texto   = get_sub_field('titulo');
        ?>

        <?php if ($archivo && $texto) : ?>
          <a 
            class="onsite-health-card" 
            href="<?php echo esc_url($archivo['url']); ?>" 
            download
          >
            <span class="onsite-health-card__icon" aria-hidden="true">
              <i class="fa-regular fa-file-lines"></i>
            </span>

            <span class="onsite-health-card__text">
              <?php echo esc_html($texto); ?>
            </span>

            <span class="onsite-health-card__download" aria-hidden="true">
              <i class="fa-solid fa-arrow-down"></i>
            </span>
          </a>
        <?php endif; ?>

      <?php endwhile; ?>

    </div>
  <?php endif; ?>

</article>
