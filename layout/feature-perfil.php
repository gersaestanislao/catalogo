<section class="acces-courses">

    <div class="container">

    <?php if (have_rows('accesos_cursos')): ?>
        <div class="acces-courses__wrapper">


        <?php while (have_rows('accesos_cursos')): the_row(); 
        
            $perfil = get_sub_field('perfil');
            $descripcion = get_sub_field('descripcion');
            $url = get_sub_field('url');
            $icono = get_sub_field('icono');
        ?>

        <article class="acces-courses__item acces-courses__item--<?php echo esc_attr($perfil); ?>">

            <a class="acces-courses__link" href="<?php echo esc_url($url); ?>">

                <div class="acces-courses__wrapp">

                    <div class="acces-courses__icon acces-courses__icon--<?php echo esc_attr($perfil); ?>">
                        <i class="<?php echo esc_attr($icono); ?>"></i>
                    </div>

                    <div class="acces-courses__content">
                        <p class="acces-courses__descript">
                            <?php echo esc_html($descripcion); ?>
                        </p>
                    </div>

                    <i class="acces-courses__arrow fa-solid fa-angle-right"></i>

                </div>

            </a>

        </article>

        <?php endwhile; ?>


        </div>
     <?php endif; ?>
    </div>
</section>

