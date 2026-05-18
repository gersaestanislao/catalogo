<?php

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
