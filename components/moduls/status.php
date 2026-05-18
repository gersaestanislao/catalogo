<div class='curso-card__status curso-card__status--<?= $esta_abierto ? 'abierto' : 'cerrado'; ?>'>
    <i class="fa-solid fa-circle"></i>
    <p>
        <?= $esta_abierto ? 'Inscripciones abiertas' : 'Sin inscripciones'; ?>
        
        <?php if(!$esta_abierto && !empty($futuras)): ?> 
            | Próximas fechas disponibles
        <?php endif; ?>
    </p>
</div>

