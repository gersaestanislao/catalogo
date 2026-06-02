<?php

/**
 * Sincroniza el estado real de los cursos desde la API hacia WordPress.

 */

function edmiss_sync_api_to_posts($post_type = 'cursos_edmiss') {

    $cursos = edmiss_indexar_cursos();

    if (empty($cursos) || !is_array($cursos)) {
        return;
    }

    $today = date('Y-m-d');

    /**
     * 1. Reset preventivo:
     */
    $posts_reset = get_posts([
        'post_type'      => $post_type,
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_query'     => [
            [
                'key'     => 'codigo_api',
                'compare' => 'EXISTS',
            ],
            [
                'key'     => 'codigo_api',
                'value'   => '',
                'compare' => '!=',
            ],
        ],
        'fields' => 'ids',
    ]);

    foreach ($posts_reset as $post_id) {
        update_post_meta($post_id, 'estado_curso', 'cerrado');
        update_post_meta($post_id, 'tiene_vigente', '0');
        update_post_meta($post_id, 'tiene_api', '0');
    }

    /**
     * edmiss_indexar_cursos() ya debe devolver únicamente claves válidas.
     */
    foreach ($cursos as $codigo => $implementaciones) {

        if (empty($codigo) || empty($implementaciones) || !is_array($implementaciones)) {
            continue;
        }

        $posts = get_posts([
            'post_type'      => $post_type,
            'post_status'    => 'publish',
            'meta_key'       => 'codigo_api',
            'meta_value'     => $codigo,
            'posts_per_page' => 1,
            'fields'         => 'ids',
        ]);

        if (empty($posts)) {
            continue;
        }

        $post_id = $posts[0];
        $tiene_abierto = false;

        foreach ($implementaciones as $item) {

            $inicio_raw = $item['iniciopreregistro'] ?? '';
            $fin_raw    = $item['finpreregistro'] ?? '';

            if (empty($inicio_raw) || empty($fin_raw)) {
                continue;
            }

            $inicio = date('Y-m-d', strtotime($inicio_raw));
            $fin    = date('Y-m-d', strtotime($fin_raw));

            if ($inicio <= $today && $fin >= $today) {
                $tiene_abierto = true;
                break;
            }
        }

        update_post_meta($post_id, 'tiene_api', '1');

        update_post_meta(
            $post_id,
            'estado_curso',
            $tiene_abierto ? 'abierto' : 'cerrado'
        );

        update_post_meta(
            $post_id,
            'tiene_vigente',
            $tiene_abierto ? '1' : '0'
        );
    }
}

/**
 * Programar sincronización horaria.
 */
add_action('init', function() {
    if (!wp_next_scheduled('edmiss_sync_event')) {
        wp_schedule_event(time(), 'hourly', 'edmiss_sync_event');
    }
});

/**
 * Ejecutar sincronización automática.
 */
add_action('edmiss_sync_event', function() {
    edmiss_sync_api_to_posts('cursos_edmiss');
    edmiss_sync_api_to_posts('microlecciones');
});

/**
 * Sincronización manual desde admin.
 */
add_action('admin_post_edmiss_sync', function() {

    if (!current_user_can('manage_options')) {
        return;
    }

    $post_type = isset($_GET['post_type'])
        ? sanitize_text_field($_GET['post_type'])
        : 'cursos_edmiss';

    edmiss_sync_api_to_posts('cursos_edmiss');
    edmiss_sync_api_to_posts('microlecciones');

    wp_redirect(admin_url('edit.php?post_type=' . $post_type . '&synced=1'));
    exit;
});

/**
 * Botón en listado admin.
 */
add_action('restrict_manage_posts', function() {

    global $typenow;

    if (!in_array($typenow, ['cursos_edmiss', 'microlecciones'], true)) {
        return;
    }

    $url = admin_url('admin-post.php?action=edmiss_sync&post_type=' . $typenow);
    ?>

    <a href="<?php echo esc_url($url); ?>"
       class="button button-primary"
       style="margin-left:10px;">
        Sincronizar cursos
    </a>

    <?php
});
