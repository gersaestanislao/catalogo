<section class="hero">
    <div class="container">

        <div class="hero__carousel owl-carousel">

            <?php if (have_rows('hero_slides')): ?>
                <?php while (have_rows('hero_slides')): the_row();

                    $bg = get_sub_field('imagen_fondo');
                    $titulo = get_sub_field('titulo');
                    $desc = get_sub_field('descripcion');
                    $btn_text = get_sub_field('texto_boton');
                    $btn_url = get_sub_field('url_boton');
                    $aria = get_sub_field('aria_label');
                ?>

                <article class="hero__slide">

                    <div 
                        class="hero__bg"
                        style="background-image: url('<?php echo esc_url($bg); ?>');"
                        role="img"
                        aria-label="<?php echo esc_attr($aria); ?>"
                    ></div>

                    <div class="hero__overlay"></div>

                    <div class="hero__content container">

                        <?php if ($titulo): ?>
                            <h1 class="hero__title">
                                <?php echo esc_html($titulo); ?>
                            </h1>
                        <?php endif; ?>

                        <?php if ($desc): ?>
                            <p class="hero__descript">
                                <?php echo esc_html($desc); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($btn_url && $btn_text): ?>
                            <p>
                                <a href="<?php echo esc_url($btn_url); ?>" 
                                   class="btn boton boton--primario btn-sm">
                                    <?php echo esc_html($btn_text); ?>
                                </a>
                            </p>
                        <?php endif; ?>

                    </div>

                </article>

                <?php endwhile; ?>
            <?php endif; ?>

        </div>

        <!-- Controles -->
        <div class="hero__controls">
            <button class="hero__arrow hero__arrow--prev" aria-label="Anterior"></button>
            <div class="hero__dots"></div>
            <button class="hero__arrow hero__arrow--next" aria-label="Siguiente"></button>
        </div>

    </div>
</section>