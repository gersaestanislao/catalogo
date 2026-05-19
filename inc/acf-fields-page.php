<?php
/**
 * ACF Flexible Content para Plantilla interna
 */
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
          'layout_educacion_presencial_salud' => [
            'key' => 'layout_educacion_presencial_salud',
            'name' => 'educacion_presencial_salud',
            'label' => 'Educación Presencial en Salud',
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