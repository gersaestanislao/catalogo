<?php

function registrar_cpts_y_taxonomias() {

    // ======================
    // CPT: Cursos EDIMSS
    // ======================
    register_post_type('cursos_edmiss', [
        'labels' => [
            'name'          => 'Cursos EDIMSS',
            'singular_name' => 'Curso EDIMSS',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'catalogo'],
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true
    ]);

    // ======================
    // TAX: Perfil
    // ======================
    register_taxonomy('perfil', ['cursos_edmiss'], [
        'labels' => [
            'name' => 'Perfiles',
        ],
        'hierarchical' => false,
        'public' => true,
        'rewrite' => ['slug' => 'perfil'],
        'show_in_rest' => true
    ]);

    // ======================
    // TAX: Temas
    // ======================
    register_taxonomy('tema', ['microlecciones'], [
        'labels' => [
            'name' => 'Temas',
        ],
        'hierarchical' => false,
        'public' => true,
        'rewrite' => ['slug' => 'tema'],
        'show_in_rest' => true
    ]);

    // ======================
    // CPT: Microlecciones
    // ======================
    register_post_type('microlecciones', [
        'labels' => [
            'name'          => 'Cursos Microlecciones',
            'singular_name' => 'Curso Microlecciones',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'microlecciones'],
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true
    ]);

}
add_action('init', 'registrar_cpts_y_taxonomias');
