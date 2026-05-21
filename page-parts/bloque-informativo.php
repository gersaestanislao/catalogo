
<?php
  $titulo    = get_sub_field('titulo');
  $contenido = get_sub_field('contenido');
  ?>

<?php if ($titulo) : ?>
    <h2 class="onsite-health__title onsite-health__title--sm">
      <?php echo esc_html($titulo); ?>
    </h2>
  <?php endif; ?>

  <?php if ($contenido) : ?>
    <article class="onsite-health__info">
      <div class="onsite-health__text">
        <?php echo wp_kses_post($contenido); ?>
      </div>
    </article>
  <?php endif; ?>

