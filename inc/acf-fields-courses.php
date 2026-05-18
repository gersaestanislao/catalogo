<?php

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
