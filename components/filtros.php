<aside class="catalogo__sidebar filtros">

    <!-- Head de filtros  -->
    <div class="filtros__head" id="trigger-accordion">
        <span>Ver filtros</span> 
        <span>Ocultar filtros</span>
        <i class="fa-solid fa-filter"></i>
        <i class="fa-solid fa-close"></i>
    </div>
     
    <!-- Contendor de filtros  -->
    <div class="filtros__content">  

    <h4 class="filtros__title-head">Filtros</h4>
        <!-- Filtros  -->
        <?php 
        $post_type = get_query_var('post_type'); 
        ?> 

<div class="filtros__group">

    <!-- SOLO PARA cursos_edimss -->
    <?php if ($post_type === 'cursos_edmiss') : ?>

        <h4 class="filtros__titulo">Perfiles</h4>

        <ul class="filtros__lista">
            <?php
            $perfiles = get_terms([
                'taxonomy' => 'perfil',
                'hide_empty' => false
            ]);

            foreach ($perfiles as $perfil) :
            ?>
            <li class="filtros__item">
                <label class="filtros__checkbox">
                    <input type="checkbox"
                        class="filtros__input"
                        name="perfil[]"
                        value="<?php echo esc_attr($perfil->slug); ?>"
                        <?php if(!empty($_GET['perfil']) && in_array($perfil->slug, $_GET['perfil'])) echo 'checked'; ?>>
                    <span class="filtros__box"></span>
                    <span class="filtros__name"><?php echo esc_html($perfil->name); ?></span>
                </label>
            </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>


    <!-- SOLO PARA microlecciones -->
    <?php if ($post_type === 'microlecciones') : ?>

        <h4 class="filtros__titulo">Temas</h4>

        <ul class="filtros__lista">
            <?php
            $temas = get_terms([
                'taxonomy' => 'tema',
                'hide_empty' => false
            ]);

            foreach ($temas as $tema) :
            ?>
            <li class="filtros__item">
                <label class="filtros__checkbox">
                    <input type="checkbox"
                        class="filtros__input"
                        name="tema[]"
                        value="<?php echo esc_attr($tema->slug); ?>"
                        <?php if(!empty($_GET['tema']) && in_array($tema->slug, $_GET['tema'])) echo 'checked'; ?>>
                    <span class="filtros__box"></span>
                    <span class="filtros__name"><?php echo esc_html($tema->name); ?></span>
                </label>
            </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>

</div>

        <!-- Filtros  -->
        <div class="filtros__group filtros__group-filters">

            <h4 class="filtros__titulo filtros__titulo--mt">
                Inscripciones 
            </h4>

            <ul class="filtros__lista">
                <li class="filtros__item">
                    <label class="filtros__checkbox">
                    <input type="radio" 
                            class="filtros__input"
                            name="estado" 
                            value="abierto"
                            <?php if(!empty($_GET['estado']) && $_GET['estado'] === 'abierto') echo 'checked'; ?>
                            >
                    <span class="filtros__box"></span>
                    <span class="filtros__name">Abiertas</span>
                    </label>
                </li>

                <li class="filtros__item">
                    <label class="filtros__checkbox">
                    <input type="radio" 
                            class="filtros__input"
                            name="estado" 
                            value="cerrado"
                            <?php if(!empty($_GET['estado']) && $_GET['estado'] === 'cerrado') echo 'checked'; ?>
                            >
                    <span class="filtros__box"></span>        
                    <span class="filtros__name">Cerradas</span>
                    </label>
                </li>
            </ul>
        </div>

        <!-- Botónes -->
        <div class="filtros__group-filters filtros__content-botons">
            <button class="filtros__boton
            btn btn-primary active"type="submit">Aplicar filtros</button>
            <!-- Botón de limpiar  -->
            <?php if (!empty($_GET)) : ?>

                <a href="<?php echo esc_url( remove_query_arg( array_keys($_GET) ) ); ?>" 
                class="btn btn-primary">
                <i class="fa-solid fa-filter-circle-xmark"></i>
                Limpiar filtros
                </a>
            <?php endif; ?>
        </div>
    </div><!--// Contendor de filtros  -->

</aside>