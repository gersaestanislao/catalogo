<?php

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
    $codigo = [];

    foreach ($partes as $parte) {

        // Si encontramos la implementación: I1, I2, I10, etc.
        if (preg_match('/^I\d+$/', $parte)) {
            break;
        }

        $codigo[] = $parte;
    }

    return implode('-', $codigo);
}


function edmiss_numero_implementacion($clavecorta){

    if (preg_match('/-I(\d+)-/', $clavecorta, $match)) {
        return 'I' . $match[1];
    }

    return '';
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
        // 'tutorizado' => $item['tutorizado'] ?? null,
        'tipo_formacion' => ($item['tutorizado'] ?? 0) == 1 ? 'Tutorizado' : 'Semitutorizado',
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
