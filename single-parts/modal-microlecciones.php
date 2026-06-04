<?php if (get_post_type() === 'microlecciones') : ?>

<div class="micro-modal" id="microModal" aria-hidden="true">

  <div class="micro-modal__overlay"></div>

  <div
    class="micro-modal__dialog"
    role="dialog"
    aria-modal="true"
    aria-labelledby="microModalTitle"
  >

    <button
      class="micro-modal__close"
      type="button"
      aria-label="Cerrar modal"
    >
      <i class="fa-solid fa-xmark"></i>
    </button>

    <div class="micro-modal__icon">
      <i class="fa-regular fa-hand-pointer"></i>
    </div>

    <h3
      class="micro-modal__title"
      id="microModalTitle"
    >
      ¡Recuerda!
    </h3>

    <p class="micro-modal__text">

    Los cursos de Microlecciones ya no requieren pre-registro. <br> A partir de ahora, podrás acceder a este contenido en modalidad on demand, disponible las 24 horas, los 7 días de la semana.

    </p>

    <button
      class="micro-modal__button"
      type="button"
    >
      Continuar
    </button>

  </div>

</div>

<?php endif; ?>