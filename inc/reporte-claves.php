<?php

add_action('admin_notices', function () {

    if (!current_user_can('manage_options')) {
        return;
    }

    if (empty($_GET['debug_claves'])) {
        return;
    }

    $cursos_api = edmiss_indexar_cursos();

    $posts = get_posts([
        'post_type'      => ['cursos_edmiss', 'microlecciones'],
        'post_status'    => ['publish', 'draft', 'pending'],
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ]);

    $sin_clave = [];
    $clave_invalida = [];
    $sin_match_api = [];

    foreach ($posts as $post) {

        $codigo = get_field('codigo_api', $post->ID);

        if (empty($codigo)) {
            $sin_clave[] = [
                'title' => get_the_title($post),
                'id'    => $post->ID,
                'type'  => get_post_type($post),
            ];
            continue;
        }

        /**
         * Validar formato tipo:
         * CES-IMIHO
         * CES-DAMG-M10
         *
         * Ojo: este valida codigo_api de WordPress,
         * no clavecorta completa de API.
         */
        if (!preg_match('/^CES-[A-Z0-9]+(?:-M\d+)?$/i', $codigo)) {
            $clave_invalida[] = [
                'title' => get_the_title($post),
                'id'    => $post->ID,
                'type'  => get_post_type($post),
                'clave' => $codigo,
            ];
            continue;
        }

        if (empty($cursos_api[$codigo])) {
            $sin_match_api[] = [
                'title' => get_the_title($post),
                'id'    => $post->ID,
                'type'  => get_post_type($post),
                'clave' => $codigo,
            ];
        }
    }

    echo '<div class="notice notice-warning">';
    echo '<h2>Reporte de claves API</h2>';

    echo '<h3>Sin codigo_api (' . count($sin_clave) . ')</h3>';
    echo '<pre>';
    foreach ($sin_clave as $item) {
        echo "[{$item['type']}] ID {$item['id']} - {$item['title']}\n";
    }
    echo '</pre>';

    echo '<h3>Clave con formato incorrecto (' . count($clave_invalida) . ')</h3>';
    echo '<pre>';
    foreach ($clave_invalida as $item) {
        echo "[{$item['type']}] ID {$item['id']} - {$item['title']} | {$item['clave']}\n";
    }
    echo '</pre>';

    echo '<h3>Clave válida pero sin match en API (' . count($sin_match_api) . ')</h3>';
    echo '<pre>';
    foreach ($sin_match_api as $item) {
        echo "[{$item['type']}] ID {$item['id']} - {$item['title']} | {$item['clave']}\n";
    }
    echo '</pre>';

    echo '</div>';
});