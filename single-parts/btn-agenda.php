<?php
// Buscar próxima implementación futura
$proxima = null;
$hoy = date('Y-m-d');

if (!empty($futuras)) {

    // Ordenar futuras por fecha de inicio.
    // Si empatan, ordenar por número de implementación.
    usort($futuras, function($a, $b) {

        $fecha_a = !empty($a['iniciopreregistro']) ? strtotime($a['iniciopreregistro']) : PHP_INT_MAX;
        $fecha_b = !empty($b['iniciopreregistro']) ? strtotime($b['iniciopreregistro']) : PHP_INT_MAX;

        if ($fecha_a !== $fecha_b) {
            return $fecha_a - $fecha_b;
        }

        preg_match('/-I(\d+)-/', $a['clavecorta'] ?? '', $a_match);
        preg_match('/-I(\d+)-/', $b['clavecorta'] ?? '', $b_match);

        return intval($a_match[1] ?? 0) - intval($b_match[1] ?? 0);
    });

    $proxima = $futuras[0];
}

// Detectar si existen más próximas inscripciones
// con fecha distinta a la primera.
$tiene_mas_futuras = false;

if (!empty($proxima) && count($futuras) > 1) {

    $fecha_base = $proxima['iniciopreregistro'] ?? '';

    foreach ($futuras as $futura) {

        $fecha_futura = $futura['iniciopreregistro'] ?? '';

        if (!empty($fecha_futura) && $fecha_futura !== $fecha_base) {
            $tiene_mas_futuras = true;
            break;
        }
    }
}

if (!$esta_abierto && !empty($proxima)) :

    $fecha_inicio = date('Ymd', strtotime($proxima['iniciopreregistro']));
    $fecha_fin    = date('Ymd', strtotime($proxima['iniciopreregistro'] . ' +1 day'));

    $titulo = 'Apertura de inscripción: ' . get_the_title();

    $detalle = 'El curso abrirá inscripciones el ' . edmiss_formatear_fecha($proxima['iniciopreregistro']) . '.';
    $url_curso = get_permalink();

    $google_url = add_query_arg([
        'action'  => 'TEMPLATE',
        'text'    => $titulo,
        'dates'   => $fecha_inicio . '/' . $fecha_fin,
        'details' => $detalle . ' ' . $url_curso,
        'ctz'     => 'America/Mexico_City',
    ], 'https://www.google.com/calendar/render');

    $outlook_url = add_query_arg([
        'path'    => '/calendar/action/compose',
        'rrv'     => 'addevent',
        'subject' => $titulo,
        'body'    => $detalle . ' ' . $url_curso,
        'startdt' => date('Y-m-d\T09:00:00', strtotime($proxima['iniciopreregistro'])),
        'enddt'   => date('Y-m-d\T10:00:00', strtotime($proxima['iniciopreregistro'])),
    ], 'https://outlook.office.com/owa/');
?>

<small>
    <strong>Próxima inscripción</strong>
</small>

<ul class="course-form__prox">
    <li class="course-form__prox-item">
        Del <?= esc_html($proxima['iniciopreregistro']); ?>
        al <?= esc_html($proxima['finpreregistro']); ?>
    </li>
</ul>

<div class="calendar-dropdown">

    <button 
        class="calendar-dropdown__trigger"
        type="button"
        aria-expanded="false"
        aria-controls="calendar-dropdown-list"
    >
        <span class="calendar-dropdown__icon">
            <i class="fa-regular fa-calendar-plus"></i>
        </span>

        <span class="calendar-dropdown__text">
            Añadir al calendario
        </span>

        <span class="calendar-dropdown__arrow">
            <i class="fa-solid fa-chevron-down"></i>
        </span>
    </button>

    <ul 
        class="calendar-dropdown__menu"
        id="calendar-dropdown-list"
    >
        <li class="calendar-dropdown__item">
            <a 
                class="calendar-dropdown__link"
                href="<?php echo esc_url($google_url); ?>" 
                target="_blank" 
                rel="noopener noreferrer"
            >
                <i class="fa-brands fa-google"></i>
                Google Calendar
            </a>
        </li>

        <li class="calendar-dropdown__item">
            <a 
                class="calendar-dropdown__link"
                href="<?php echo esc_url($outlook_url); ?>" 
                target="_blank" 
                rel="noopener noreferrer"
            >
                <i class="fa-brands fa-microsoft"></i>
                Outlook 365
            </a>
        </li>

        <li class="calendar-dropdown__item">
            <a 
                class="calendar-dropdown__link"
                href="<?php echo esc_url(str_replace('outlook.office.com', 'outlook.live.com', $outlook_url)); ?>" 
                target="_blank" 
                rel="noopener noreferrer"
            >
                <i class="fa-regular fa-envelope"></i>
                Outlook Live
            </a>
        </li>
    </ul>

</div>

<?php if ($tiene_mas_futuras) : ?>
    <a 
        class="course-form__more-link"
        href="#proximas-inscripciones"
    >
        Ver más próximas inscripciones
    </a>
<?php endif; ?>

<?php endif; ?>