<?php

/**
 * Modificar búsqueda principal
 */
add_action('pre_get_posts', function($query){

    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->is_search()) {

        // Solo tus CPTs
        $query->set('post_type', ['cursos_edmiss', 'microlecciones']);

        // Solo publicados (evita attachments, drafts, etc.)
        $query->set('post_status', 'publish');
    }
});


/**
 * Buscar SOLO en el título
 */
add_filter('posts_search', function($search, $query){
    global $wpdb;

    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return $search;
    }

    $term = $query->get('s');

    if (empty($term)) {
        return $search;
    }

    // Sanitizar
    $like = '%' . $wpdb->esc_like($term) . '%';

    //  SOLO título
    $search = $wpdb->prepare(
        " AND {$wpdb->posts}.post_title LIKE %s ",
        $like
    );

    return $search;

}, 10, 2);


/**
 * Evitar duplicados 
 */
add_filter('posts_distinct', function($distinct, $query){
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        return 'DISTINCT';
    }
    return $distinct;
}, 10, 2);
