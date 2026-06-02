<?php
/**
 * functions.php
 * Loader principal del theme.
 *
 * La lógica del proyecto se divide en módulos dentro de /inc
 *
 */

$deps_inc_path = get_template_directory() . '/inc';



/**
 * ======================================================
 * CONFIGURACIÓN GENERAL DEL THEME
 * ======================================================
 *
 * Este archivo contiene:
 *
 * - add_theme_support()
 * - soporte para thumbnails
 * - soporte para title-tag
 * - soporte para HTML5
 * - configuraciones generales del theme
 * ======================================================
 */
require_once $deps_inc_path . '/theme-setup.php';





/**
 * ======================================================
 * CUSTOM POST TYPES Y TAXONOMÍAS
 * ======================================================
 *
 * Registro de:
 *
 * - cursos_edmiss
 * - microlecciones
 * - taxonomía perfil
 * - taxonomía tema
 * ======================================================
 */
require_once $deps_inc_path . '/post-types-taxonomies.php';



/**
 * ======================================================
 * CAMPOS PERSONALIZADOS ACF
 * ======================================================
 *
 * Registro de grupos ACF:
 *
 * - Home Hero
 * - Features
 * - Accesos rápidos
 * - Cursos EDIMSS
 * - Campos de cursos
 * ======================================================
 */

require_once $deps_inc_path . '/acf-fields-home.php';
require_once $deps_inc_path . '/acf-fields-courses.php';
require_once $deps_inc_path . '/acf-fields-page.php';



/**
 * ======================================================
 * INTEGRACIÓN API EDIMSS
 * ======================================================
 *
 * Conexión y normalización de la API externa.
 *
 * Contiene:
 *
 * - consumo API
 * - cache/transients
 * - indexado de cursos
 * - normalización de datos
 * - lógica de implementaciones
 * ======================================================
 */

require_once $deps_inc_path . '/api-edimss.php';



/**
 * ======================================================
 * FILTROS Y QUERIES DEL CATÁLOGO
 * ======================================================
 *
 * Lógica de:
 *
 * - filtros por perfil
 * - filtros por tema
 * - filtros por estado
 * - meta_query
 * - tax_query
 * - paginación
 *
 * ======================================================
 */
require_once $deps_inc_path . '/query-filters.php';




/**
 * ======================================================
 * SINCRONIZACIÓN API → WORDPRESS
 * ======================================================
 *
 * Sistema automático de sincronización:
 *
 * - estado abierto/cerrado
 * - sincronización por cron
 * - actualización de metadata
 * - botón manual de sincronización

 * ======================================================
 */
require_once $deps_inc_path . '/sync-cursos.php';


/**
 * ======================================================
 * IMÁGENES Y FALLBACKS
 * ======================================================
 *
 * Helpers para imágenes del catálogo:
 *
 * - featured image
 * - fallback ACF
 * - imagen genérica
 * - atributos accesibles
 * - lazy loading
 */
require_once $deps_inc_path . '/media.php';



/**
 * ======================================================
 * XML / RSS DINÁMICO
 * ======================================================
 *
 * Generación del XML dinámico:
 *
 * /cursos-abiertos.xml
 *
 * Contiene:
 *
 * - rewrite rules
 * - query vars
 * - feeds XML
 * - selección de implementaciones
 * ======================================================
 */
require_once $deps_inc_path . '/xml-feed.php';


/**
 * ======================================================
 * BÚSQUEDA PERSONALIZADA
 * ======================================================
 *
 * Customización del search de WordPress.
 *
 * Contiene:
 *
 * - búsqueda solo por títulos
 * - exclusión de attachments
 * - DISTINCT
 * - optimización de resultados
 
 * ======================================================
 */
require_once $deps_inc_path . '/search.php';


/**
 * ======================================================
 * DEBUG 
 * ======================================================
 */
require_once get_template_directory() . '/inc/reporte-claves.php';