<?php

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
