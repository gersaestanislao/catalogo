<!-- Todas las fechas  -->

<div class='debug-filtros'>

    <h5>Curso: <?= esc_html($clave); ?></h5>

    <!-- Vigentes -->
    <h6>🟢 Vigentes (<?= count($implementaciones_vigentes); ?>)</h6>

    <?php if(!empty($implementaciones_vigentes)) : ?>
        <?php foreach($implementaciones_vigentes as $imp): ?>
            <div style='border:1px solid green; padding:8px; margin-bottom:8px;'>
                <strong><?= esc_html($imp['clavecorta']); ?></strong><br>
                Inicio: <?= esc_html($imp['iniciopreregistro']); ?><br>
                Fin: <?= esc_html($imp['finpreregistro']); ?><br>
                Vacantes: <?= esc_html($imp['vacantes']); ?><br>
                ID API: <?= esc_html($imp['id']); ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay vigentes</p>
    <?php endif; ?>

    <!-- Futuras -->
    <h6>🟡 Próximas (<?= count($futuras); ?>)</h6>

    <?php if(!empty($futuras)) : ?>
        <?php foreach($futuras as $imp): ?>
            <div style='border:1px solid orange; padding:8px; margin-bottom:8px;'>
                <strong><?= esc_html($imp['clavecorta']); ?></strong><br>
                Inicio: <?= esc_html($imp['iniciopreregistro']); ?><br>
                Vacantes: <?= esc_html($imp['vacantes']); ?><br>
                ID API: <?= esc_html($imp['id']); ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay próximas</p>
    <?php endif; ?>

</div>
