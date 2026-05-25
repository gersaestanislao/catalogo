<?php if (have_rows('health_areas_items')) : ?>

<section class="health-areas">
  <div class="health-areas__container">

    <?php if (get_field('health_areas_title')) : ?>
      <h2 class="health-areas__title">
        <?php echo esc_html(get_field('health_areas_title')); ?>
      </h2>
    <?php endif; ?>

    <div class="health-areas__grid">

      <?php while (have_rows('health_areas_items')) : the_row(); ?>

        <?php
        $icon  = get_sub_field('icon');
        $title = get_sub_field('title');
        $link  = get_sub_field('link');
        ?>

        <?php if ($link) : ?>
          <a
            class="health-areas-card"
            href="<?php echo esc_url($link['url']); ?>"
            target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
          >
        <?php else : ?>
          <article class="health-areas-card">
        <?php endif; ?>

            <?php if ($icon) : ?>
              <span class="health-areas-card__icon" aria-hidden="true">
                <i class="<?php echo esc_attr($icon); ?>"></i>
              </span>
            <?php endif; ?>

            <?php if ($title) : ?>
              <h3 class="health-areas-card__title">
                <?php echo esc_html($title); ?>
              </h3>
            <?php endif; ?>

        <?php if ($link) : ?>
          </a>
        <?php else : ?>
          </article>
        <?php endif; ?>

      <?php endwhile; ?>

    </div>

  </div>
</section>

<?php endif; ?>