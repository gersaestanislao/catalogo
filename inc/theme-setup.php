<?php

/**
 * Configuración base del theme.
 */
add_theme_support('post-thumbnails');

require_once get_template_directory() . '/inc/class-bootstrap-navwalker.php';

function deps_register_menus() {
    register_nav_menus([
        'main-menu' => __('Menú principal', 'deps-imss'),
    ]);
}
add_action('after_setup_theme', 'deps_register_menus');
