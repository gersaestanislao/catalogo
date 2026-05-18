<?php

add_action('pre_get_posts', function($query){

    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    // ===============================
    // CURSOS EDIMSS
    // ===============================
    if (is_post_type_archive(['cursos_edmiss'])) {

        $query->set('posts_per_page', 12);
    
        $tax_query  = [];
        $meta_query = [
            'relation' => 'AND'
        ];
    
        // =====================
        // FILTRO POR PERFILES
        // =====================
    
        if (!empty($_GET['perfil'])) {
    
            $tax_query[] = [
                'taxonomy' => 'perfil',
                'field'    => 'slug',
                'terms'    => array_map('sanitize_text_field', $_GET['perfil']),
                'operator' => 'IN'
            ];
        }
    
        // =====================
        // SOLO cursos con API
        // =====================
    
        $meta_query[] = [
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
    
        // =====================
        // FILTRO ESTADO
        // =====================
    
        if (!empty($_GET['estado'])) {
    
            $meta_query[] = [
                'key'     => 'estado_curso',
                'value'   => sanitize_text_field($_GET['estado']),
                'compare' => '='
            ];
            
        }
    
        // =====================
        // aplicar queries
        // =====================
    
        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }
    
        $query->set('meta_query', $meta_query);
    }

    // ===============================
    // MICROCCIONES
    // ===============================
    if (is_post_type_archive('microlecciones')) {

        $query->set('posts_per_page', 12);

        // TAX QUERY
        $tax_query = [];

        if (!empty($_GET['tema'])) {
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

        // META QUERY
        $meta_query = [];

        // Solo cursos con clave API
        $meta_query[] = [
            'key'     => 'codigo_api',
            'value'   => '',
            'compare' => '!='
        ];

        // Filtro por estado
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
