<?php
    $terms = [];

    if($post_type === 'cursos_edmiss'){
        $terms = $perfiles;
    }

    if($post_type === 'microlecciones'){
        $terms = $temas;
    }
    ?>

    <?php if(!empty($terms) && !is_wp_error($terms)) : ?>
        <div class="curso-card__tags">
            <div class="curso-card__tags-content">
                <?php foreach($terms as $term) : ?>
                    <span class="curso-card__tag curso-card__tag--<?= esc_attr($term->slug); ?>">
                        <?= esc_html($term->name); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>