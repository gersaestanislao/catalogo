<?php
  $titulo      = get_sub_field('titulo');
  $texto_ayuda = get_sub_field('texto_ayuda');
  ?>

<?php if ($titulo) : ?>
    <h2 class="onsite-health__title onsite-health__title--sm">
        <?php echo esc_html($titulo); ?>
    </h2>
    <?php endif; ?>

    <?php if (have_rows('tarjetas')) : ?>
    <div class="educational-offer__grid">

        <?php
        $modal_index = 0;
        ?>

        <?php while (have_rows('tarjetas')) : the_row(); ?>

        <?php
        $card_titulo       = get_sub_field('titulo');
        $boton_catalogo    = get_sub_field('boton_catalogo');
        $mostrar_modal     = get_sub_field('mostrar_modal');
        $modal_titulo      = get_sub_field('modal_titulo');
        $modal_texto       = get_sub_field('modal_texto');
        $form_action       = get_sub_field('form_action');
        $link_recuperar    = get_sub_field('link_recuperar_password');
        $link_extra        = get_sub_field('link_extra');

        $modal_index++;
        $modal_id = 'modal-oferta-educativa-' . get_the_ID() . '-' . $modal_index;
        ?>

        <article class="educational-offer-card">

            <?php if ($card_titulo) : ?>
            <h3 class="educational-offer-card__title">
                <?php echo esc_html($card_titulo); ?>
            </h3>
            <?php endif; ?>

            <?php if ($boton_catalogo) : ?>
            <a
                href="<?php echo esc_url($boton_catalogo['url']); ?>"
                class="btn boton boton--primario"
                target="<?php echo esc_attr($boton_catalogo['target'] ?: '_self'); ?>"
            >
                <?php echo esc_html($boton_catalogo['title']); ?>
            </a>
            <?php endif; ?>

            <?php if ($mostrar_modal) : ?>
            <button
                class="btn boton boton--transparente"
                type="button"
                data-modal-open="<?php echo esc_attr($modal_id); ?>"
            >
                Ingresa a la Plataforma
            </button>
            <?php endif; ?>

            <?php if ($link_extra) : ?>
            <a
                href="<?php echo esc_url($link_extra['url']); ?>"
                class="boton--link"
                target="<?php echo esc_attr($link_extra['target'] ?: '_self'); ?>"
            >
                <?php echo esc_html($link_extra['title']); ?>
            </a>
            <?php endif; ?>

        </article>

        <?php if ($mostrar_modal) : ?>
            <div
            class="platform-modal"
            id="<?php echo esc_attr($modal_id); ?>"
            role="dialog"
            aria-modal="true"
            aria-labelledby="<?php echo esc_attr($modal_id); ?>-title"
            hidden
            >
            <div class="platform-modal__overlay" data-modal-close></div>

            <div class="platform-modal__content" role="document">
                <button class="platform-modal__close" type="button" data-modal-close aria-label="Cerrar modal">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                </button>

                <?php if ($modal_titulo) : ?>
                <h3 class="platform-modal__title" id="<?php echo esc_attr($modal_id); ?>-title">
                    <?php echo esc_html($modal_titulo); ?>
                </h3>
                <?php endif; ?>

                <?php if ($modal_texto) : ?>
                <p class="platform-modal__text">
                    <?php echo esc_html($modal_texto); ?>
                </p>
                <?php endif; ?>

                <form
                class="platform-modal__form"
                action="<?php echo esc_url($form_action ?: '#'); ?>"
                method="post"
                >
                <label class="sr-only" for="<?php echo esc_attr($modal_id); ?>-usuario">
                    Usuario
                </label>
                <input
                    class="platform-modal__input"
                    id="<?php echo esc_attr($modal_id); ?>-usuario"
                    name="usuario"
                    type="text"
                    placeholder="Ingresa tu usuario"
                    required
                >

                <label class="sr-only" for="<?php echo esc_attr($modal_id); ?>-password">
                    Contraseña
                </label>
                <input
                    class="platform-modal__input"
                    id="<?php echo esc_attr($modal_id); ?>-password"
                    name="password"
                    type="password"
                    placeholder="Ingresa tu contraseña"
                    required
                >

                <input type="submit" value="Entrar" class="btn boton boton--primario">

                <?php if ($link_recuperar) : ?>
                    <a
                    class="boton--link"
                    href="<?php echo esc_url($link_recuperar['url']); ?>"
                    target="<?php echo esc_attr($link_recuperar['target'] ?: '_self'); ?>"
                    >
                    <?php echo esc_html($link_recuperar['title']); ?>
                    </a>
                <?php endif; ?>
                </form>
            </div>
            </div>
        <?php endif; ?>

        <?php endwhile; ?>

    </div>
    <?php endif; ?>

    <?php if ($texto_ayuda) : ?>
    <div class="educational-offer__help">
        <?php echo wp_kses_post($texto_ayuda); ?>
    </div>
    <?php endif; ?>