<div class="curso-card__status curso-card__status--<?= esc_attr($esta_abierto ? 'abierto' : 'cerrado'); ?>">

  <!-- lista de cerrado  -->
  <ul class="curso-card__list text-left">

        <li class="curso-card__list-item"> 
        <i class="fa-solid fa-calendar-xmark"></i>
            Sin inscripciones
        </li>

        <?php if (!$esta_abierto && !empty($futuras)) : ?> 
            <li class="curso-card__list-item  curso-card__list-item--link "> 
          
                <i class="fa-regular fa-calendar-plus"></i>Con próximas inscrip.
        <?php endif; ?>

    </ul>

</div>