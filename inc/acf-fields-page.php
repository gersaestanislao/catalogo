<?php
 /* =====================================================
 * ACF Flexible Content para Plantilla interna
===================================================== */
add_action('acf/init', 'cat_register_internal_template_fields');

function cat_register_internal_template_fields() {

  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group([
    'key' => 'group_plantilla_interna_modulos',
    'title' => 'Módulos - Plantilla interna',
    'fields' => [
      [
        'key' => 'field_plantilla_interna_modulos',
        'label' => 'Módulos de contenido',
        'name' => 'modulos_plantilla_interna',
        'type' => 'flexible_content',
        'button_label' => 'Agregar módulo',
        'layouts' => [

          //Hero
          'layout_educacion_presencial_salud' => [
            'key' => 'layout_educacion_presencial_salud',
            'name' => 'educacion_presencial_salud',
            'label' => 'Hero',
            'display' => 'block',
            'sub_fields' => [
              [
                'key' => 'field_eps_titulo',
                'label' => 'Título',
                'name' => 'titulo',
                'type' => 'text',
              ],
              [
                'key' => 'field_eps_descripcion',
                'label' => 'Descripción',
                'name' => 'descripcion',
                'type' => 'wysiwyg',  
              ],
              [
                'key' => 'field_eps_boton',
                'label' => 'Botón',
                'name' => 'boton',
                'type' => 'link',
                'return_format' => 'array',
              ],
              [
                'key' => 'field_eps_imagen',
                'label' => 'Imagen',
                'name' => 'imagen',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
              ],
              [
                'key' => 'field_eps_descargables',
                'label' => 'Descargables',
                'name' => 'descargables',
                'type' => 'repeater',
                'button_label' => 'Agregar descargable',
                'layout' => 'block',
                'sub_fields' => [
                  [
                    'key' => 'field_eps_descargable_titulo',
                    'label' => 'Título del archivo',
                    'name' => 'titulo',
                    'type' => 'text',
                  ],
                  [
                    'key' => 'field_eps_descargable_archivo',
                    'label' => 'Archivo',
                    'name' => 'archivo',
                    'type' => 'file',
                    'return_format' => 'array',
                  ],
                ],
              ],
            ],
          ],

          // Bloque informativo
          'layout_bloque_informativo' => [
          'key' => 'layout_bloque_informativo',
          'name' => 'bloque_informativo',
          'label' => 'Bloque informativo',
          'display' => 'block',
          'sub_fields' => [
              [
                'key' => 'field_bloque_info_titulo',
                'label' => 'Título',
                'name' => 'titulo',
                'type' => 'text',
              ],
              [
                'key' => 'field_bloque_info_contenido',
                'label' => 'Contenido',
                'name' => 'contenido',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => 0,
              ],
            ],
          ],

          //Bloque dos secciones
          'layout_principales_actividades' => [
          'key' => 'layout_principales_actividades',
          'name' => 'principales_actividades',
          'label' => 'Dos bloques informativos',
          'display' => 'block',
          'sub_fields' => [
              [
                'key' => 'field_principales_actividades_titulo',
                'label' => 'Título',
                'name' => 'titulo',
                'type' => 'text',
                'default_value' => 'Principales actividades:',
              ],
              [
                'key' => 'field_principales_actividades_items',
                'label' => 'Módulo',
                'name' => 'actividades',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Agregar actividad',
                'min' => 1,
                'sub_fields' => [
                  [
                    'key' => 'field_principales_actividades_texto',
                    'label' => 'Texto',
                    'name' => 'texto',
                    'type' => 'wysiwyg',
                    'tabs' => 'visual',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                  ],
                  [
                    'key' => 'field_principales_actividades_fondo_verde',
                    'label' => 'Fondo verde claro',
                    'name' => 'fondo_verde_claro',
                    'type' => 'true_false',
                    'ui' => 1,
                    'default_value' => 0,
                  ],
                ],
              ],
            ],
          ],

          /// Ingreso a plataformas
          'layout_oferta_educativa' => [
            'key' => 'layout_oferta_educativa',
            'name' => 'oferta_educativa',
            'label' => 'Oferta educativa',
            'display' => 'block',
            'sub_fields' => [
              [
                'key' => 'field_oferta_educativa_titulo',
                'label' => 'Título',
                'name' => 'titulo',
                'type' => 'text',
                'default_value' => 'Oferta Educativa',
              ],
              [
                'key' => 'field_oferta_educativa_tarjetas',
                'label' => 'Tarjetas',
                'name' => 'tarjetas',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Agregar tarjeta',
                'sub_fields' => [
                  [
                    'key' => 'field_oferta_tarjeta_titulo',
                    'label' => 'Título',
                    'name' => 'titulo',
                    'type' => 'text',
                  ],
                  [
                    'key' => 'field_oferta_tarjeta_catalogo',
                    'label' => 'Botón catálogo',
                    'name' => 'boton_catalogo',
                    'type' => 'link',
                    'return_format' => 'array',
                  ],
                  [
                    'key' => 'field_oferta_tarjeta_mostrar_modal',
                    'label' => 'Mostrar botón de plataforma',
                    'name' => 'mostrar_modal',
                    'type' => 'true_false',
                    'ui' => 1,
                    'default_value' => 0,
                  ],
                  [
                    'key' => 'field_oferta_tarjeta_modal_titulo',
                    'label' => 'Título del modal',
                    'name' => 'modal_titulo',
                    'type' => 'text',
                    'conditional_logic' => [
                      [
                        [
                          'field' => 'field_oferta_tarjeta_mostrar_modal',
                          'operator' => '==',
                          'value' => '1',
                        ],
                      ],
                    ],
                  ],
                  [
                    'key' => 'field_oferta_tarjeta_modal_texto',
                    'label' => 'Texto del modal',
                    'name' => 'modal_texto',
                    'type' => 'textarea',
                    'rows' => 2,
                    'conditional_logic' => [
                      [
                        [
                          'field' => 'field_oferta_tarjeta_mostrar_modal',
                          'operator' => '==',
                          'value' => '1',
                        ],
                      ],
                    ],
                  ],
                  [
                    'key' => 'field_oferta_tarjeta_action',
                    'label' => 'Action del formulario',
                    'name' => 'form_action',
                    'type' => 'url',
                    'conditional_logic' => [
                      [
                        [
                          'field' => 'field_oferta_tarjeta_mostrar_modal',
                          'operator' => '==',
                          'value' => '1',
                        ],
                      ],
                    ],
                  ],
                  [
                    'key' => 'field_oferta_tarjeta_recuperar',
                    'label' => 'Link recuperar contraseña',
                    'name' => 'link_recuperar_password',
                    'type' => 'link',
                    'return_format' => 'array',
                    'conditional_logic' => [
                      [
                        [
                          'field' => 'field_oferta_tarjeta_mostrar_modal',
                          'operator' => '==',
                          'value' => '1',
                        ],
                      ],
                    ],
                  ],
                  [
                    'key' => 'field_oferta_tarjeta_extra',
                    'label' => 'Link extra',
                    'name' => 'link_extra',
                    'type' => 'link',
                    'return_format' => 'array',
                  ],
                ],
              ],
              [
                'key' => 'field_oferta_educativa_ayuda',
                'label' => 'Texto de ayuda',
                'name' => 'texto_ayuda',
                'type' => 'wysiwyg',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'default_value' => '<p>Ingresa a nuestra <a href="#">Mesa de Ayuda Virtual</a>,<br>o si lo prefieres puedes comunicarte al 55 5627 6900 extensiones 21146, 21147 y 21148 de 8 a 17 hrs.</p>',
              ],
            ],
          ],

        ],
      ],
    ],
    'location' => [
      [
        [
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page.php',
        ],
      ],
    ],
  ]);
}