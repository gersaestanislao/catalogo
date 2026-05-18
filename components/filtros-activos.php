<?php
    // Detectar filtros activos
    $filtros_activos = !empty($_GET['perfil']);
        if ($filtros_activos) :
    ?>

        <div class="filtros-activos">

            <span class="filtros-activos__label">
                Filtros activos:
            </span>

            <div class="filtros-activos__list">

               <?php

                    if (!empty($_GET['perfil'])) {

                        foreach ($_GET['perfil'] as $perfil_slug) {

                            $term = get_term_by('slug', sanitize_text_field($perfil_slug), 'perfil');

                            if ($term) {

                                // construir nueva url quitando este filtro
                                $perfiles = $_GET['perfil'];

                                $perfiles = array_filter($perfiles, function($p) use ($perfil_slug) {
                                    return $p !== $perfil_slug;
                                });

                                $url = remove_query_arg('perfil');

                                if (!empty($perfiles)) {
                                    $url = add_query_arg('perfil', $perfiles, $url);
                                }

                                ?>

                                <a href="<?php echo esc_url($url); ?>" class="filtros-activos__chip">

                                    <?php echo esc_html($term->name); ?>

                                    <span class="filtros-activos__remove">
                                        ✕
                                    </span>

                                </a>

                                <?php
                            }
                        }
                    }

                ?>

            </div>

            <!-- <a href="<?php echo esc_url( remove_query_arg( array_keys($_GET) ) ); ?>" 
                class="filtros-activos__clear">
                Limpiar filtros
            </a> -->

        </div>

<?php endif; ?>