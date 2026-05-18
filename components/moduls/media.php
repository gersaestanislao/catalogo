<?php edmiss_get_course_image(); ?>

<?php if( !is_single() ) : ?>
    <span class="curso-card__tag-status curso-card__tag-status--<?= $esta_abierto ? 'abierto' : 'cerrado'; ?>">
        <?= $esta_abierto ? 'Abierto' : 'Cerrado'; ?>
    </span>
<?php endif; ?>