<?php 
add_theme_support('post-thumbnails');

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



/* =====================================================
   ACF Fields - Main
===================================================== */



add_action('acf/init', function() {

    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key' => 'group_home_main',
        'title' => 'Home - Sección Principal',
        'fields' => [

            [
                'key' => 'field_home_main',
                'label' => 'Contenido principal',
                'name' => 'home_main',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => [

                    [
                        'key' => 'field_main_logo',
                        'label' => 'Logo',
                        'name' => 'logo',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ],

                    [
                        'key' => 'field_main_titulo',
                        'label' => 'Título',
                        'name' => 'titulo',
                        'type' => 'text',
                    ],

                    [
                        'key' => 'field_main_descripcion',
                        'label' => 'Descripción',
                        'name' => 'descripcion',
                        'type' => 'textarea',
                    ],

                    [
                        'key' => 'field_main_texto_boton',
                        'label' => 'Texto botón',
                        'name' => 'texto_boton',
                        'type' => 'text',
                        'default_value' => 'Ver más acerca de la división',
                    ],

                    [
                        'key' => 'field_main_url_boton',
                        'label' => 'URL botón',
                        'name' => 'url_boton',
                        'type' => 'url',
                    ],

                ],
            ],

        ],

        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'home.php',
                ],
            ],
        ],
    ]);
});


/* =====================================================
   ACF Fields - Features
===================================================== */

add_action('acf/init', function() {

    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key' => 'group_home_features',
        'title' => 'Home - Features',
        'fields' => [

            [
                'key' => 'field_home_features',
                'label' => 'Sección Features',
                'name' => 'home_features',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Agregar feature',
                'sub_fields' => [

                    [
                        'key' => 'field_feature_imagen',
                        'label' => 'Imagen',
                        'name' => 'imagen',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ],

                    [
                        'key' => 'field_feature_alt',
                        'label' => 'Alt imagen',
                        'name' => 'alt',
                        'type' => 'text',
                        'instructions' => 'Opcional. Si se deja vacío, se usa el ALT de la imagen',
                    ],

                    [
                        'key' => 'field_feature_titulo',
                        'label' => 'Título',
                        'name' => 'titulo',
                        'type' => 'text',
                    ],

                    [
                        'key' => 'field_feature_descripcion',
                        'label' => 'Descripción',
                        'name' => 'descripcion',
                        'type' => 'textarea',
                    ],

                    [
                        'key' => 'field_feature_texto_btn',
                        'label' => 'Texto botón',
                        'name' => 'texto_boton',
                        'type' => 'text',
                        'default_value' => 'Saber más',
                    ],

                    [
                        'key' => 'field_feature_url_btn',
                        'label' => 'URL botón',
                        'name' => 'url_boton',
                        'type' => 'url',
                    ],

                    [
                        'key' => 'field_feature_layout',
                        'label' => 'Layout',
                        'name' => 'layout',
                        'type' => 'select',
                        'choices' => [
                            'normal' => 'Normal',
                            'reverse' => 'Imagen derecha (reverse)',
                        ],
                        'default_value' => 'normal',
                        'ui' => 1,
                    ],

                ],
            ],

        ],

        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'home.php',
                ],
            ],
        ],
    ]);
});

/* =====================================================
   ACF Fields - Carrusel home
===================================================== */


add_action('acf/init', function() {

    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key' => 'group_home_hero',
        'title' => 'Home - Hero Slider',
        'fields' => [

            [
                'key' => 'field_hero_slides',
                'label' => 'Slides del Hero',
                'name' => 'hero_slides',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Agregar slide',
                'sub_fields' => [

                    [
                        'key' => 'field_hero_imagen',
                        'label' => 'Imagen de fondo',
                        'name' => 'imagen_fondo',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ],

                    [
                        'key' => 'field_hero_titulo',
                        'label' => 'Título',
                        'name' => 'titulo',
                        'type' => 'text',
                    ],

                    [
                        'key' => 'field_hero_descripcion',
                        'label' => 'Descripción',
                        'name' => 'descripcion',
                        'type' => 'textarea',
                    ],

                    [
                        'key' => 'field_hero_texto_boton',
                        'label' => 'Texto del botón',
                        'name' => 'texto_boton',
                        'type' => 'text',
                        'default_value' => 'Ver el catálogo',
                    ],

                    [
                        'key' => 'field_hero_url_boton',
                        'label' => 'URL del botón',
                        'name' => 'url_boton',
                        'type' => 'url',
                    ],

                    [
                        'key' => 'field_hero_aria',
                        'label' => 'ARIA label (imagen)',
                        'name' => 'aria_label',
                        'type' => 'text',
                        'instructions' => 'Describe la imagen para accesibilidad',
                    ],

                ],
            ],

        ],

        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'home.php',
                ],
            ],
        ],
    ]);

});

/* =====================================================
   ACF Fields - Acceso a cursos por perfil
===================================================== */

add_action('acf/init', function() {

    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key' => 'group_home_accesos_cursos',
        'title' => 'Home - Accesos a cursos',
        'fields' => [

            [
                'key' => 'field_accesos_cursos',
                'label' => 'Accesos a cursos',
                'name' => 'accesos_cursos',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Agregar acceso',
                'sub_fields' => [

                    [
                        'key' => 'field_perfil',
                        'label' => 'Perfil',
                        'name' => 'perfil',
                        'type' => 'select',
                        'choices' => [
                            'enfermeria' => 'Enfermería',
                            'medico' => 'Médico',
                            'multidisciplinario' => 'Multidisciplinario',
                            'directivo' => 'Directivo',
                            'docente' => 'Docente',
                        ],
                        'default_value' => 'enfermeria',
                        'return_format' => 'value',
                    ],

                    [
                        'key' => 'field_descripcion',
                        'label' => 'Descripción',
                        'name' => 'descripcion',
                        'type' => 'text',
                    ],

                    [
                        'key' => 'field_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                    ],

                    [
                        'key' => 'field_icono',
                        'label' => 'Icono (Font Awesome)',
                        'name' => 'icono',
                        'type' => 'text',
                        'default_value' => 'fa-solid fa-user',
                        'instructions' => 'Ejemplo: fa-solid fa-user-nurse'
                    ],

                ],
            ],

        ],

        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'home.php',
                ],
            ],
        ],
    ]);

});

/* =====================================================
   ACF Fields - Cursos EDIMSS
===================================================== */

add_action('acf/init', function() {

    if(function_exists('acf_add_local_field_group')) {

        acf_add_local_field_group([
            'key' => 'group_cursos_edmiss',
            'title' => 'Datos del Curso',
            'fields' => [


                [
                    'key' => 'field_dirigido',
                    'label' => 'Dirigido a',
                    'name' => 'dirigido_a',
                    'type' => 'textarea',
                    'rows' => 2
                ],


                [
                    'key' => 'field_acerca',
                    'label' => 'Acerca',
                    'name' => 'acerca',
                    'type' => 'textarea',
                    'rows' => 2
                ],


                [
                    'key' => 'field_objetivo',
                    'label' => 'Objetivo',
                    'name' => 'objetivo',
                    'type' => 'textarea',
                    'rows' => 2
                ],


                [
                    'key' => 'field_contenido',
                    'label' => 'Conteniddo',
                    'name' => 'contenido',
                    'type' => 'wysiwyg',
                    'rows' => 2
                ],


                [
                    'key' => 'field_estado_curso',
                    'label' => 'Estado del curso (auto)',
                    'name' => 'estado_curso',
                    'type' => 'select',
                    'choices' => [
                        'abierto' => 'Abierto',
                        'cerrado' => 'Cerrado'
                    ]
                ],

                [
                    'key' => 'field_clave',
                    'label' => 'Clave corta',
                    'name' => 'codigo_api',
                    'type' => 'text',
                ],


                [
                    'key' => 'field_img',
                    'label' => 'Imagen directa',
                    'name' => 'image',
                    'type' => 'text',
                ],

            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'cursos_edmiss'
                    ]
                ],
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'microlecciones'
                    ]
                ]
            ]
        ]);

    }

});

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


// =====================
// Consulta de API
// =====================

function edmiss_consultar_api() {

    // Nombre del cache
    $transient_name = 'edmiss_api_cursos';

    // Revisar si ya existe cache
    $data = get_transient($transient_name);

    if ($data !== false) {
        return $data;
    }

    // Si no hay cache → consultar API
    $response = wp_remote_get('https://innovaedu.imss.gob.mx/app2025/api_cat_sied.php');

    if (is_wp_error($response)) {
        return false;
    }

    $body = wp_remote_retrieve_body($response);

    $body = preg_replace('/^\xEF\xBB\xBF/', '', $body);

    $json = json_decode($body, true);

    if (!$json || !isset($json['data'])) {
        return false;
    }

    $data = array_map('edmiss_normalizar_item', $json['data']);

    // guardar cache por 1 hora
    set_transient($transient_name, $data, HOUR_IN_SECONDS);

    return $data;
}

// =====================
// Extracción de clave corta
// =====================


function edmiss_codigo_curso($clavecorta){

    $partes = explode('-', $clavecorta);
    $codigo = [];

    foreach ($partes as $parte) {

        // Si encontramos la implementación: I1, I2, I10, etc.
        if (preg_match('/^I\d+$/', $parte)) {
            break;
        }

        $codigo[] = $parte;
    }

    return implode('-', $codigo);
}


function edmiss_numero_implementacion($clavecorta){

    if (preg_match('/-I(\d+)-/', $clavecorta, $match)) {
        return 'I' . $match[1];
    }

    return '';
}


// =====================
// Índice de cursos
// =====================

function edmiss_indexar_cursos(){

    $api = edmiss_consultar_api();

    $cursos = [];

    foreach($api as $item){

        $codigo = edmiss_codigo_curso($item['clavecorta']);

        if(!isset($cursos[$codigo])){
            $cursos[$codigo] = [];
        }

        $cursos[$codigo][] = $item;

    }

    return $cursos;

}

function edmiss_normalizar_item($item){

    return [

        //  Id
        'id' => $item['id'] ?? $item['id_curso'] ?? null,

        // clave del curso
        'clavecorta' => $item['clavecorta'] ?? $item['shortname'] ?? '',

        // nombre
        'nombre' => $item['nomcompletocurso'] ?? $item['fullname'] ?? '',

        // fechas del curso
        'fchinic' => $item['fchinic'] ?? $item['fchini'] ?? '',
        'fchfin'  => $item['fchfin']  ?? $item['fchfin'] ?? '',

        //  preregistro
        'iniciopreregistro' => $item['iniciopreregistro'] ?? $item['startdatepre'] ?? '',
        'finpreregistro'    => $item['finpreregistro'] ?? $item['lastdatepre'] ?? '',

        // Lugares
        'cuotacurso' => $item['cuotacurso'] ?? 0,

        // capacidad
        'vacantes' => $item['vacantes'] ?? null,
        'inscritos' => $item['total_preregistrados'] ?? null,

        //  metadata útil
        'horas' => $item['horas'] ?? $item['horascur'] ?? '',
        'tipo'  => $item['tipoproyecto'] ?? '',
        // 'tutorizado' => $item['tutorizado'] ?? null,
        'tipo_formacion' => ($item['tutorizado'] ?? 0) == 1 ? 'Tutorizado' : 'Semitutorizado',
    ];
}


function edmiss_formatear_fecha($fecha_raw){

    if(empty($fecha_raw)) return '';

    $timestamp = strtotime($fecha_raw);
    if(!$timestamp) return '';

    $meses = [
        'Jan' => 'Ene',
        'Feb' => 'Feb',
        'Mar' => 'Mar',
        'Apr' => 'Abr',
        'May' => 'May',
        'Jun' => 'Jun',
        'Jul' => 'Jul',
        'Aug' => 'Ago',
        'Sep' => 'Sep',
        'Oct' => 'Oct',
        'Nov' => 'Nov',
        'Dec' => 'Dic'
    ];

    $mes = date('M', $timestamp);

    return date('d', $timestamp) . ', ' . ($meses[$mes] ?? $mes) . ', ' . date('y', $timestamp);
}


function edmiss_sync_api_to_posts($post_type = 'cursos_edmiss'){

    $api = edmiss_consultar_api();
    if(!$api) return;

    $cursos = edmiss_indexar_cursos();
    $today = date('Y-m-d');

    foreach($cursos as $codigo => $implementaciones){

        $posts = get_posts([
            'post_type' => $post_type,
            'meta_key'  => 'codigo_api',
            'meta_value'=> $codigo,
            'posts_per_page' => 1
        ]);

        if(empty($posts)) continue;

        $post_id = $posts[0]->ID;

        $tiene_abierto = false;

        foreach($implementaciones as $item){

            $inicio = date('Y-m-d', strtotime($item['iniciopreregistro']));
            $fin    = date('Y-m-d', strtotime($item['finpreregistro']));

            if($inicio <= $today && $fin >= $today){
                $tiene_abierto = true;
                break;
            }
        }

        update_post_meta(
            $post_id, 
            'estado_curso', 
            $tiene_abierto ? 'abierto' : 'cerrado'
        );
    }
}



add_action('init', function(){
    if (!wp_next_scheduled('edmiss_sync_event')) {
        wp_schedule_event(time(), 'hourly', 'edmiss_sync_event');
    }
});

add_action('edmiss_sync_event', function(){
    edmiss_sync_api_to_posts('cursos_edmiss');
    edmiss_sync_api_to_posts('microlecciones');
});


add_action('admin_post_edmiss_sync', function(){

    if(!current_user_can('manage_options')) return;

    // Detectar CPT actual (fallback incluido)
    $post_type = isset($_GET['post_type']) 
        ? sanitize_text_field($_GET['post_type']) 
        : 'cursos_edmiss';

    // Sync (puedes mantener ambos o solo uno)
    edmiss_sync_api_to_posts('cursos_edmiss');
    edmiss_sync_api_to_posts('microlecciones');

    // Redirección dinámica
    wp_redirect(admin_url('edit.php?post_type=' . $post_type . '&synced=1'));
    exit;
});


;add_action('restrict_manage_posts', function(){

    global $typenow;

    if(!in_array($typenow, ['cursos_edmiss', 'microlecciones'])) return;

    $url = admin_url('admin-post.php?action=edmiss_sync&post_type=' . $typenow);
    ?>

    <a href="<?php echo esc_url($url); ?>" 
       class="button button-primary"
       style="margin-left:10px;">
        Sincronizar cursos
    </a>

    <?php
});

// imagenes 

function edmiss_get_course_image($args = []){

    $defaults = [
        'size'  => 'medium_large',
        'class' => 'curso-card__image',
        'lazy'  => true
    ];

    $args = wp_parse_args($args, $defaults);

    $post_id = get_the_ID();

    // =====================
    // ALT accesible
    // =====================
    $alt = '';

    if (has_post_thumbnail($post_id)) {
        $alt = get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true);
    }

    if (empty($alt)) {
        $alt = get_the_title($post_id);
    }

    // =====================
    // 1. Imagen destacada (ideal)
    // =====================
    if (has_post_thumbnail($post_id)) {

        echo wp_get_attachment_image(
            get_post_thumbnail_id($post_id),
            $args['size'],
            false,
            [
                'class'    => $args['class'],
                'alt'      => esc_attr($alt),
                'loading'  => $args['lazy'] ? 'lazy' : 'eager',
                'decoding' => 'async'
            ]
        );

        return;
    }

    // =====================
    // 2. Imagen ACF
    // =====================
    $image = get_field('image', $post_id);

    if (!empty($image)) {

        $src = get_template_directory_uri() . '/img/course-img-default/' . $image;

        echo '<img 
            class="'.esc_attr($args['class']).'" 
            src="'.esc_url($src).'" 
            alt="'.esc_attr($alt).'" 
            loading="'.($args['lazy'] ? 'lazy' : 'eager').'"
            decoding="async"
        >';

        return;
    }

    // =====================
    // 3. Fallback genérico
    // =====================
    $fallback = get_template_directory_uri() . '/img/course-img-default/generica.webp';

    echo '<img 
        class="'.esc_attr($args['class']).'" 
        src="'.esc_url($fallback).'" 
        alt="'.esc_attr($alt).'" 
        loading="'.($args['lazy'] ? 'lazy' : 'eager').'"
        decoding="async"
    >';
}

// =============================
// XML Cursos abiertos
// =============================
add_action('init', function () {
    add_rewrite_rule('^cursos-abiertos\.xml$', 'index.php?cursos_abiertos=1', 'top');
});

add_filter('query_vars', function ($vars) {
    $vars[] = 'cursos_abiertos';
    return $vars;
});

add_action('template_redirect', function () {

    if (get_query_var('cursos_abiertos')) {

        header('Content-Type: text/xml; charset=utf-8');

        delete_transient('edmiss_api_cursos'); // opcional

        $cursos_api = edmiss_indexar_cursos();
        $hoy = current_time('Y-m-d');

        $cursos_unicos = [];

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<cursos>';

        foreach ($cursos_api as $codigo => $implementaciones) {

            $vigentes = [];

            foreach ($implementaciones as $imp) {

                $inicio = !empty($imp['iniciopreregistro']) 
                    ? date('Y-m-d', strtotime($imp['iniciopreregistro'])) 
                    : false;

                $fin = !empty($imp['finpreregistro']) 
                    ? date('Y-m-d', strtotime($imp['finpreregistro'])) 
                    : false;

                if ($inicio && $fin && $hoy >= $inicio && $hoy <= $fin) {
                    $vigentes[] = $imp;
                }
            }

            if (empty($vigentes)) continue;

            // Ordenar por implementación
            usort($vigentes, function($a, $b){
                preg_match('/-I(\d+)-/', $a['clavecorta'], $a_match);
                preg_match('/-I(\d+)-/', $b['clavecorta'], $b_match);

                return intval($a_match[1] ?? 0) - intval($b_match[1] ?? 0);
            });

            // Selección inteligente
            $seleccion = null;

            foreach ($vigentes as $imp) {
                if (!empty($imp['vacantes']) && $imp['vacantes'] > 0) {
                    $seleccion = $imp;
                    break;
                }
            }

            if (!$seleccion) {
                $seleccion = $vigentes[0];
            }

            // Extraer número de implementación (I1, I2…)
            preg_match('/-I(\d+)-/', $seleccion['clavecorta'], $match);
            $implementacion = $match[1] ?? '';

            // XML
            echo '<curso>';

            echo '<id>' . esc_html($seleccion['id']) . '</id>';
            echo '<clave>' . esc_html($codigo) . '</clave>';
            echo '<clavecorta>' . esc_html($seleccion['clavecorta']) . '</clavecorta>';
            echo '<implementacion>I' . esc_html($implementacion) . '</implementacion>';

            echo '<nombre>' . esc_html($seleccion['nombre']) . '</nombre>';

            echo '<inicio_inscripcion>' . esc_html($seleccion['iniciopreregistro']) . '</inicio_inscripcion>';
            echo '<fin_inscripcion>' . esc_html($seleccion['finpreregistro']) . '</fin_inscripcion>';

            echo '<vacantes>' . esc_html($seleccion['vacantes']) . '</vacantes>';
            echo '<horas>' . esc_html($seleccion['horas']) . '</horas>';

            echo '</curso>';

            $cursos_unicos[$codigo] = true;
        }

        echo '<total>' . count($cursos_unicos) . '</total>';
        echo '</cursos>';

        exit;
    }
});

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



require_once get_template_directory() . '/inc/class-bootstrap-navwalker.php';

function deps_register_menus() {
    register_nav_menus([
      'main-menu' => __('Menú principal', 'deps-imss'),
    ]);
  }
  add_action('after_setup_theme', 'deps_register_menus');