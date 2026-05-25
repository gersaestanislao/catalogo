<?php

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
   ACF Fields -  Áreas de la División
===================================================== */

add_action('acf/init', 'cat_register_home_health_areas_fields');

function cat_register_home_health_areas_fields() {

  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group([
    'key' => 'group_home_health_areas',
    'title' => 'Home - Áreas de la División',
    'fields' => [
      [
        'key' => 'field_home_health_areas_title',
        'label' => 'Título de la sección',
        'name' => 'health_areas_title',
        'type' => 'text',
        'default_value' => 'Áreas de la División de Educación en Salud',
      ],
      [
        'key' => 'field_home_health_areas_items',
        'label' => 'Áreas',
        'name' => 'health_areas_items',
        'type' => 'repeater',
        'layout' => 'block',
        'button_label' => 'Agregar área',
        'sub_fields' => [
          [
            'key' => 'field_home_health_area_icon',
            'label' => 'Clase de ícono Font Awesome',
            'name' => 'icon',
            'type' => 'text',
            'instructions' => 'Ejemplo: fa-solid fa-book-open',
          ],
          [
            'key' => 'field_home_health_area_title',
            'label' => 'Título del área',
            'name' => 'title',
            'type' => 'text',
          ],
          [
            'key' => 'field_home_health_area_link',
            'label' => 'Enlace',
            'name' => 'link',
            'type' => 'link',
            'return_format' => 'array',
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
}