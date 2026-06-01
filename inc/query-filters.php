<?php

add_action('pre_get_posts', function($query){

    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | CURSOS EDIMSS
    |--------------------------------------------------------------------------
    */
    if (is_post_type_archive('cursos_edmiss')) {

        $query->set('posts_per_page', 12);
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');

        $tax_query = [];

        if (!empty($_GET['perfil']) && is_array($_GET['perfil'])) {
            $tax_query[] = [
                'taxonomy' => 'perfil',
                'field'    => 'slug',
                'terms'    => array_map('sanitize_text_field', $_GET['perfil']),
                'operator' => 'IN'
            ];
        }

        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }

        $meta_query = [
            'relation' => 'AND',

            [
                'key'     => 'codigo_api',
                'compare' => 'EXISTS'
            ],

            [
                'key'     => 'codigo_api',
                'value'   => '',
                'compare' => '!='
            ]
        ];

        if (!empty($_GET['estado'])) {
            $meta_query[] = [
                'key'     => 'estado_curso',
                'value'   => sanitize_text_field($_GET['estado']),
                'compare' => '='
            ];
        }

        $query->set('meta_query', $meta_query);
    }

    /*
    |--------------------------------------------------------------------------
    | MICROLECCIONES
    |--------------------------------------------------------------------------
    */
    if (is_post_type_archive('microlecciones')) {

        $query->set('posts_per_page', 12);
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');

        $tax_query = [];

        if (!empty($_GET['tema']) && is_array($_GET['tema'])) {
            $tax_query[] = [
                'taxonomy' => 'tema',
                'field'    => 'slug',
                'terms'    => array_map('sanitize_text_field', $_GET['tema']),
                'operator' => 'IN'
            ];
        }

        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }

        $meta_query = [
            'relation' => 'AND',

            [
                'key'     => 'codigo_api',
                'compare' => 'EXISTS'
            ],

            [
                'key'     => 'codigo_api',
                'value'   => '',
                'compare' => '!='
            ]
        ];

        if (!empty($_GET['estado'])) {
            $meta_query[] = [
                'key'     => 'estado_curso',
                'value'   => sanitize_text_field($_GET['estado']),
                'compare' => '='
            ];
        }

        $query->set('meta_query', $meta_query);
    }

});