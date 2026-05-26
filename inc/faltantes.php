<?php 

echo '<pre>';

$wp_claves = [];

$posts = get_posts([
    'post_type' => 'cursos_edmiss',
    'posts_per_page' => -1
]);

foreach ($posts as $post) {

    $codigo = get_field('codigo_api', $post->ID);

    if ($codigo) {
        $wp_claves[] = $codigo;
    }
}

$wp_claves = array_unique($wp_claves);

foreach ($cursos_api as $codigo => $implementaciones) {

    $abierto = false;

    foreach ($implementaciones as $imp) {

        $inicio = strtotime($imp['iniciopreregistro']);
        $fin    = strtotime($imp['finpreregistro']);

        if ($inicio && $fin && time() >= $inicio && time() <= $fin) {
            $abierto = true;
            break;
        }
    }

    if ($abierto && !in_array($codigo, $wp_claves)) {

        echo "FALTA EN WP: " . $codigo . "\n";
    }
}

echo '</pre>'; ?>