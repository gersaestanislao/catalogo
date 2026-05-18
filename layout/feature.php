<?php if (have_rows('home_features')) : ?>
<section class="features">
  <div class="container">

    <?php while (have_rows('home_features')) : the_row();

      $img        = get_sub_field('imagen');
      $alt_custom = get_sub_field('alt');
      $titulo     = get_sub_field('titulo');
      $desc       = get_sub_field('descripcion');
      $btn_text   = get_sub_field('texto_boton');
      $btn_url    = get_sub_field('url_boton');
      $layout     = get_sub_field('layout');

      $is_reverse = $layout === 'reverse';
      $alt = $alt_custom ?: ($img['alt'] ?? $titulo);
    ?>

    <article class="feature <?php echo $is_reverse ? 'feature--reverse' : ''; ?>">

      <div class="feature__media">
        <?php if ($img): ?>
          <img 
            src="<?php echo esc_url($img['url']); ?>" 
            alt="<?php echo esc_attr($alt); ?>"
          >
        <?php endif; ?>
      </div>

      <div class="feature__content">
        <?php if ($titulo): ?>
          <h4 class="feature__title text-left">
            <?php echo esc_html($titulo); ?>
            <hr class="red">
          </h4>
        <?php endif; ?>

        <?php if ($desc): ?>
          <p class="feature__text">
            <?php echo esc_html($desc); ?>
          </p>
        <?php endif; ?>

        <?php if ($btn_text && $btn_url): ?>
          <p class="mt-1">
            <a href="<?php echo esc_url($btn_url); ?>" 
               class="boton boton--link boton--icon">
              <?php echo esc_html($btn_text); ?>
              <i class="fa-solid fa-arrow-right-long"></i>
            </a>
          </p>
        <?php endif; ?>

      </div>

    </article>

    <?php endwhile; ?>

  </div>
</section>
<?php endif; ?>