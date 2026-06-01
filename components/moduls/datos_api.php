<?php
/**
 * Datos dinámicos de la implementación seleccionada.
 *
 * Este módulo espera recibir desde card.php:
 * $resultado = [$seleccion];
 */

if (empty($resultado) || empty($resultado[0])) {
    return;
}

$imp = $resultado[0];

preg_match('/-I(\d+)-/', $imp['clavecorta'] ?? '', $match);
$num_impl = $match[1] ?? '';

$inicio_inscripcion = !empty($imp['iniciopreregistro'])
    ? edmiss_formatear_fecha($imp['iniciopreregistro'])
    : '';

$vacantes = isset($imp['vacantes']) ? intval($imp['vacantes']) : 0;
?>

<ul class="curso-card__list">

    <?php if (!empty($inicio_inscripcion)) : ?>
        <li class="curso-card__list-item">
            <i class="fa-regular fa-calendar" aria-hidden="true"></i>
            Inscrip: <?php echo esc_html($inicio_inscripcion); ?>
        </li>
    <?php endif; ?>

    <li class="curso-card__list-item">
        <i class="fa-regular fa-flag" aria-hidden="true"></i>
        Vacantes: <?php echo esc_html($vacantes); ?>
    </li>

</ul>