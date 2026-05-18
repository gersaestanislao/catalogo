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
    // CPT: Microlecciones
    // ======================
    register_post_type('cursos_microlecciones', [
        'labels' => [
            'name'          => 'Cursos Microlecciones',
            'singular_name' => 'Curso Microlecciones',
        ],
        'public' => true,
        'show_in_menu' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'catalogo-microlecciones'],
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true
    ]);

}
add_action('init', 'registrar_cpts_y_taxonomias');

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

            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'cursos_edmiss'
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

    if (is_post_type_archive('cursos_edmiss')) {

        $query->set('posts_per_page', 9);

        $tax_query = [];

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

        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }

        // =====================
        // FILTRO POR ESTADO (ACF) Abierto
        // =====================

        if (!empty($_GET['estado'])) {

            $meta_query = [
                [
                    'key'   => 'estado_curso',
                    'value' => sanitize_text_field($_GET['estado']),
                    'compare' => '='
                ]
            ];
        
            $query->set('meta_query', $meta_query);
        }

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

    return $partes[0] . '-' . $partes[1];

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
        'tutorizado' => $item['tutorizado'] ?? null,
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


function edmiss_sync_api_to_posts(){

    $api = edmiss_consultar_api();
    if(!$api) return;

    $cursos = edmiss_indexar_cursos(); // ya los agrupas por curso

    $today = date('Y-m-d');

    foreach($cursos as $codigo => $implementaciones){

        // Buscar post
        $posts = get_posts([
            'post_type' => 'cursos_edmiss',
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

            // Implementación está abierta → el curso está abierto
            if($inicio <= $today && $fin >= $today){
                $tiene_abierto = true;
                break;
            }
        }

        // Guardar estado derivado
        update_post_meta($post_id, 'estado_curso', $tiene_abierto ? 'abierto' : 'cerrado');
    }
}



add_action('init', function(){
    if (!wp_next_scheduled('edmiss_sync_event')) {
        wp_schedule_event(time(), 'hourly', 'edmiss_sync_event');
    }
});

add_action('edmiss_sync_event', 'edmiss_sync_api_to_posts');




add_action('admin_post_edmiss_sync', function(){

    if(!current_user_can('manage_options')) return;

    edmiss_sync_api_to_posts();

    wp_redirect(admin_url('edit.php?post_type=cursos_edmiss&synced=1'));
    exit;
});


add_action('restrict_manage_posts', function(){

    global $typenow;

    if($typenow !== 'cursos_edmiss') return;
    ?>

    <a href="<?php echo admin_url('admin-post.php?action=edmiss_sync'); ?>" 
       class="button button-primary"
       style="margin-left:10px;">
        Sincronizar cursos
    </a>

    <?php
});


